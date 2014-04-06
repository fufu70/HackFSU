<?php
/*
 * Password hashing with PBKDF2.
 * Author: havoc AT defuse.ca
 * www: https://defuse.ca/php-pbkdf2.htm
 */

// These constants may be changed without breaking existing hashes.

class RSSFeed
{
    /*
     * 
     */
    public static function getRssFeed($feed_url)
    {
        $content = file_get_contents($feed_url);
        $x = json_decode($content, true);
        $rssfeed = "";

        for($i = 0; $i < sizeof($x['results']); $i ++) 
        {
            $stuff = "";
            if($x['results'][$i]['media'] != '')
            {
                if($x['results'][$i]['media'][0]['type'] == 'image')
                {
                    $stuff = $x['results'][$i]['media'][0]['media-metadata'][0]['url'];
                }
            }

            $rssfeed .= "
                <div class='col-lg-12'>
                        <div class='media'>
                            <a class='pull-left' href='/index.php/RSSFeed/getarticle/?url_feed=".$x['results'][$i]['url']."'>
                                <img class='media-object' src='".$stuff."' style='width:75px; height:75px;'>
                            </a>
                            <a class='pull-right btn btn-success' href='#'>
                                :)
                            </a>
                            <div class='media-body'>
                                <h4 class='media-heading'>".$x['results'][$i]['title']."</h4>
                                ".$x['results'][$i]['abstract']."
                                </br>
                                <div class='fb-share-button' data-href='".$x['results'][$i]['url']."' data-type='icon_link'></div>
                              <a href='".$x['results'][$i]['url']."'><i class='fa fa-external-link'></i> Original</a>
                            </div>
                        </div>
                </div>";
        }

        return $rssfeed;
    }

    public static function getEmailAndFacebookFromDescription($description)
    {
        // echo $description;
        // $desc_split = explode('<div', $description);
        // $description_text = $desc_split[0];

        // $desc_split = explode('href="', $description);
        // $desc_return = explode('"', $desc_split[1]);
        // $email_link = $desc_return[0];

        // $desc_return = explode('"', $desc_split[4]);
        // $facebook_link = $desc_return[0];

        // $link_array = array('email'=>$email_link, 'facebook'=>$facebook_link, 'description'=>$description_text);
        // return $link_array;
    }
}
