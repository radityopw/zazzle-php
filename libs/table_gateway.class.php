<?php 

class TableGateway{


	function __construct($table,$conf = false){
		global $opts;


		$this->table = $table;
		
		$this->server = $opts['hn'];
		$this->username = $opts['un'];
		$this->password = $opts['pw'];
		$this->database = $opts['db'];

		if($conf){

			$this->server = $conf['server'];

			$this->username = $conf['username'];

			$this->password = $conf['password'];

			$this->database = $conf['database'];


		}
	
		

	}


	function open(){

		$this->con = false;

		$this->con = mysql_pconnect($this->server,$this->username,$this->password);

		if($this->con){
			mysql_select_db($this->database,$this->con);
		}

	}

	function close(){
		if($this->con){

			mysql_close($this->con);
			$this->con = false;

		}
	}

	function get($string_params = "1=1"){
	
		return $this->get_select(array("*"),$string_params);

	}

	function get_select($select = array(), $string_params = "1=1"){

		$this->open();

		$s_select = implode(",",$select);
		
		$sql = "SELECT ".$s_select." FROM ".$this->table." WHERE ".$string_params;

		//var_dump($sql);


		$res = mysql_query($sql,$this->con);

		$data = array();

		if($res){

			while($row = mysql_fetch_assoc($res)){

				$data[] = $row;
			
			}

			return $data;
			

		}

		$this->close();

		return false;
		
	}


	function push($data = array(),$params = false){

		if($params){
			
			$sql = $this->build_sql_update($this->table,$data,$params);
		
		}else{

			$sql = $this->build_sql_insert($this->table,$data);
		}

		$this->open();


		mysql_query($sql,$this->con);

		$this->close();


	}

	function remove($params = false){

		$this->open();

		$sql = "DELETE FROM ".$this->table." WHERE 1=1 ";

		if($params){

			$sql = $sql." AND ".$params;

		}

		mysql_query($sql,$this->con);
		$this->close();
	}

	function build_sql_insert($table, $data){
		$key = array_keys($data);
    
		$val = array_values($data);
		$sql = "INSERT INTO $table (`" . implode('`, `', $key) . "`) "
		. "VALUES ('" . implode("', '", $val) . "')";
 
		return($sql);
	}
 
	/* function to build SQL UPDATE string */
	function build_sql_update($table, $data, $where){
		$cols = array();
		foreach($data as $key=>$val) {
			
			$cols[] = "`$key` = '$val'";
			
		}
		$sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";
 
		return($sql);
	}


}
