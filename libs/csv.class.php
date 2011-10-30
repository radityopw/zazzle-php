<?php 

class Csv{

	function __construct($filename = false){

		$this->filename = $filename;		

	}


	function get_array($headers = array()){

		$result = array();		

		ini_set(‘auto_detect_line_endings’,1);

		$handle = fopen($this->filename, ‘r’);

		while (($data = fgetcsv($handle, 1000, ‘,’)) !== FALSE) {	

			$row = array();
			
			$iterator = 0;

			foreach($headers as $header){
				

				$row[$header] = $data[$iterator];
								
				$iterator++;
			}

			$result[] = $row;
		}

		return $result;
	}

	function generate_from_array($data = array()){

		$string = '';

        	$c=0;

        	foreach($data AS $array) {

            		$val_array = array();

            		$key_array = array();

            		foreach($array AS $key => $val) {

                		$key_array[] = $key;

                		$val = str_replace('"', '""', $val);

                		$val_array[] = "\"$val\"";

            		}

            		if($c == 0) {

                		$string .= implode(",", $key_array)."\n";

            		}

            		$string .= implode(",", $val_array)."\n";

            		$c++;
        	}

		return $string;

	}

}
