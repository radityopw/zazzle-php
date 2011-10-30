<?php

class Helper{


	function force_download($filename,$data){

		header("Pragma: public");
        	header("Expires: 0");
        	header("Cache-Control: private");
        	header("Content-type: application/octet-stream");
        	header("Content-Disposition: attachment; filename=$filename");
        	header("Accept-Ranges: bytes");
        	echo $data;
        	exit;

	}

	function get_ext($filename){

		$a_filename = explode(".",$filename);

		return $a_filename[count($a_filename) -1];

	}

	function check_ext($filename,$allowed_ext){

		$ext = strtolower(Helper::get_ext($filename));

		$allowed_ext = strtolower($allowed_ext);

		if($ext != $allowed_ext){

			exit("anda harus mengupload file ".$allowed_ext);

		}



	}

}
