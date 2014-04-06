<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $userRole;
	private $hashPassword;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	public function authenticate()
	{
		$this->userRole = 0;
		$people_info = People::model()->find(array("select"=>"people_id,role_id",
			"condition"=>"email_address=:name","params"=>array(":name"=>$this->username)));

		// Check to make sure $people_info became an object.
		// If People()::model()->find(...) doesn't find anything, $people_info can be 'null'
		// causing the statement below $people_info->people_id result in a PHP notice since
		// $people_info isn't an object.
		if (!$people_info)
			return null;

		$login_info = Login::model()->find(array("select"=>"password", 
			"condition"=>"people_id=:id", "params"=>array(":id"=>$people_info->people_id)));

		$this->userRole = $people_info->role_id;
		$this->hashPassword = $login_info->password;

		return $this->userRole;
	}

	public function getUserRole()
	{
		return $this->userRole;
	}

	public function getUserHashPassword()
	{
		return $this->hashPassword;
	}
}
