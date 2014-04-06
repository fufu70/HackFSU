<?php

define("PBKDF2_HASH_ALGORITHM", "sha256");
define("PBKDF2_ITERATIONS", 1000);
define("PBKDF2_SALT_BYTES", 24);
define("PBKDF2_HASH_BYTES", 24);

define("HASH_SECTIONS", 4);
define("HASH_ALGORITHM_INDEX", 0);
define("HASH_ITERATION_INDEX", 1);
define("HASH_SALT_INDEX", 2);
define("HASH_PBKDF2_INDEX", 3);

class PP
{
    public static function create_hash($password)
    {
        // format: algorithm:iterations:salt:hash
        $salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTES, MCRYPT_DEV_URANDOM));
        return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  $salt . ":" . 
            base64_encode(PP::pbkdf2(
                PBKDF2_HASH_ALGORITHM,
                $password,
                $salt,
                PBKDF2_ITERATIONS,
                PBKDF2_HASH_BYTES,
                true
            ));
    }

    public static function validate_password($password, $good_hash)
    {
        $params = explode(":", $good_hash);
        if(count($params) < HASH_SECTIONS)
           return false; 
        $pbkdf2 = base64_decode($params[HASH_PBKDF2_INDEX]);
        return PP::slow_equals(
            $pbkdf2,
            PP::pbkdf2(
                $params[HASH_ALGORITHM_INDEX],
                $password,
                $params[HASH_SALT_INDEX],
                (int)$params[HASH_ITERATION_INDEX],
                strlen($pbkdf2),
                true
            )
        );
    }

    // Compares two strings $a and $b in length-constant time.
    public static function slow_equals($a, $b)
    {
        $diff = strlen($a) ^ strlen($b);
        for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
        {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $diff === 0; 
    }

    /*
     * PBKDF2 key derivation function as defined by RSA's PKCS #5: https://www.ietf.org/rfc/rfc2898.txt
     * $algorithm - The hash algorithm to use. Recommended: SHA256
     * $password - The password.
     * $salt - A salt that is unique to the password.
     * $count - Iteration count. Higher is better, but slower. Recommended: At least 1000.
     * $key_length - The length of the derived key in bytes.
     * $raw_output - If true, the key is returned in raw binary format. Hex encoded otherwise.
     * Returns: A $key_length-byte key derived from the password and salt.
     *
     * Test vectors can be found here: https://www.ietf.org/rfc/rfc6070.txt
     *
     * This implementation of PBKDF2 was originally created by https://defuse.ca
     * With improvements by http://www.variations-of-shadow.com
     */
    public static function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
    {
        $algorithm = strtolower($algorithm);
        if(!in_array($algorithm, hash_algos(), true))
            die('PBKDF2 ERROR: Invalid hash algorithm.');
        if($count <= 0 || $key_length <= 0)
            die('PBKDF2 ERROR: Invalid parameters.');

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for($i = 1; $i <= $block_count; $i++) {
            // $i encoded as 4 bytes, big endian.
            $last = $salt . pack("N", $i);
            // first iteration
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            // perform the other $count - 1 iterations
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if($raw_output)
            return substr($output, 0, $key_length);
        else
            return bin2hex(substr($output, 0, $key_length));
    }
}

function assert_true($result, $msg)
{
    if($result === true)
        echo "PASS: [$msg]\n</br>";
    else
        echo "FAIL: [$msg]\n</br>";
}

// The following test vectors were taken from RFC 6070.
// https://www.ietf.org/rfc/rfc6070.txt

// $pbkdf2_vectors = array(
//     array(
//         'algorithm' => 'sha1', 
//         'password' => "password", 
//         'salt' => "salt", 
//         'iterations' => 1, 
//         'keylength' => 20, 
//         'output' => "0c60c80f961f0e71f3a9b524af6012062fe037a6" 
//         ),
//     array(
//         'algorithm' => 'sha1', 
//         'password' => "password", 
//         'salt' => "salt", 
//         'iterations' => 2, 
//         'keylength' => 20, 
//         'output' => "ea6c014dc72d6f8ccd1ed92ace1d41f0d8de8957"
//         ),
//     array(
//         'algorithm' => 'sha1', 
//         'password' => "password", 
//         'salt' => "salt", 
//         'iterations' => 4096, 
//         'keylength' => 20, 
//         'output' => "4b007901b765489abead49d926f721d065a429c1"
//         ),
//     array(
//         'algorithm' => 'sha1', 
//         'password' => "passwordPASSWORDpassword", 
//         'salt' => "saltSALTsaltSALTsaltSALTsaltSALTsalt", 
//         'iterations' => 4096, 
//         'keylength' => 25, 
//         'output' => "3d2eec4fe41c849b80c8d83662c0e44a8b291a964cf2f07038"
//         ), 
//     array(
//         'algorithm' => 'sha1', 
//         'password' => "pass\0word", 
//         'salt' => "sa\0lt", 
//         'iterations' => 4096, 
//         'keylength' => 16, 
//         'output' => "56fa6aa75548099dcc37d7f03425e0c3"
//         ),            
// );

// foreach($pbkdf2_vectors as $test) {
//     $realOut = pbkdf2(
//         $test['algorithm'],
//         $test['password'],
//         $test['salt'],
//         $test['iterations'],
//         $test['keylength'],
//         false
//     );

//     assert_true($realOut === $test['output'], "PBKDF2 vector");
// }


$good_hash = PP::create_hash("rahkeem");
// assert_true(validate_password("foobar", $good_hash), "Correct password");
// assert_true(validate_password("foobar2", $good_hash) === false, "Wrong password");

// $h1 = explode(":", create_hash(""));
// $h2 = explode(":", create_hash(""));
// assert_true($h1[HASH_PBKDF2_INDEX] != $h2[HASH_PBKDF2_INDEX], "Different hashes");
// assert_true($h1[HASH_SALT_INDEX] != $h2[HASH_SALT_INDEX], "Different salts");

// assert_true(slow_equals("",""), "Slow equals empty string");
// assert_true(slow_equals("abcdef","abcdef"), "Slow equals normal string");

// assert_true(slow_equals("aaaaaaaaaa", "aaaaaaaaab") === false, "Slow equals different");
// assert_true(slow_equals("aa", "a") === false, "Slow equals different length 1");
// assert_true(slow_equals("a", "aa") === false, "Slow equals different length 2");

echo "Example hash: $good_hash\n</br>";
var_dump(PP::validate_password('rahkeem', $good_hash));
// echo "Example hash: ".(PP::validate_password('kyle', $good_hash))."</br>";


?>
