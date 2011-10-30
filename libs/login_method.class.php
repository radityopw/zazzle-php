<?php 

require_once('imap_auth.class.php');
require_once('manual_auth.class.php');

class LoginMethod{

	function __construct(){

		$this->methods = array(
				'ImapAuth' => new ImapAuth(),
				'ManualAuth' => new ManualAuth()
				);
	}

	function auth($username,$password){

		foreach($this->methods as $name => $method){

			if($method->auth($username,$password)){
				
				return true;

			}
			
		}
		
		return false;

	}	 

}
