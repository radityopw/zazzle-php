<?php 

class ManualAuth{

	function __construct(){
		
		//require_once('../connections/local_auth.php');

		global $opts;

		$this->server = $opts['hn'];
		$this->username = $opts['un'];
		$this->password = $opts['pw'];
		$this->database = $opts['db'];
		
		
	}

	function auth($username,$password){

		$con = mysql_pconnect($this->server,$username,$password);

		if($con){

			mysql_select_db($this->database,$con);

			$sql = "SELECT COUNT(*) as jumlah FROM local_auth WHERE email='".$username."' AND password = '".$password."'";
			$res = mysql_query($sql,$con);

			if($res){
			
				$row = mysql_fetch_assoc($res);

				if($row['jumlah'] > 0 ){
					
					mysql_close($con);

					return true;

				}

			}
			

		}

		if($con){

			mysql_close($con);

		}

		return false;

	}

}
