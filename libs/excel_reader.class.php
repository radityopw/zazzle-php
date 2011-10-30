<?php 
require_once('excel/reader.php');

class ExcelReader{


	function __construct($filename,$headers = false){

		$this->filename = $filename;
		$this->have_header = true;
		$this->sheet_index = 0;
		$this->headers = $headers;

		if(!$headers){
			$this->have_header = false;
		}

	}

	function set_header($header){
		$this->headers = $header;
		$this->have_header = true;
	}

	function set_sheet_index($index){
		$this->sheet_index = $index;
	}

	function getAll(){

		$reader=new Spreadsheet_Excel_Reader();
		$reader->setUTFEncoder('iconv');
		$reader->setOutputEncoding('UTF-8');
		$reader->read($this->filename);

		$data = array();

		$index_row = 1;

		if($this->have_header){
			$index_row = 2;
		}

		$iterator = -1;

		for($i=$index_row;$i <= $reader->sheets[$this->sheet_index]['numRows']; $i++){

			$iterator++;

			$data[$iterator] = array();
			
			for($j=1; $j<= $reader->sheets[$this->sheet_index]['numCols']; $j++){

				if($this->have_header){

					$data[$iterator][$this->headers[$j-1]] = $reader->sheets[0]['cells'][$i][$j];

				}else{

					$data[$iterator][$j-1] = $reader->sheets[0]['cells'][$i][$j];
				}

			}

		}

		return $data;

	}

}
