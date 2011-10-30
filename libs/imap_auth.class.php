<?php

/**
*
*
*/

class ImapAuth{

	function __construct(){
		
		$this->server = '{imap.its.ac.id:143}INBOX';
	}

	function set_server($server){
	
		$this->server = $server;

	}	

	function auth($username,$password){

		$mbox = imap_open($this->server,$username,$password);

		if($mbox){
			
			imap_close($mbox);

			return true;

		}
		
		return false;
	}

	


}
