<?php

class GuiHelper{

	function array_is_assoc($arr){
		return array_keys($arr) !== range(0, count($arr) - 1);
	}

	function combobox($id = "noname",$data = array(),$default = ''){

		$return = "";

		$return.="<select id='$id' name='$id'>";

		if(GuiHelper::array_is_assoc($data)){
	
			foreach($data as $key => $value){

				if($key == $default){

					$return.="<option value='$key' selected=true>$value</option>";

				}else{
	
					$return.="<option value='$key'>$value</option>";
				}

			}
		}else{

			foreach($data as $row){

				if($row == $default){

					$return.="<option value='$row' selected=true>$row</option>";
				}else{

					$return.="<option value='$row'>$row</option>";
				}

			}

		}		

		$return.="</select>";
		return $return;

	}

	function text_field($id = "noname",$default = ''){

		$return = "";

		$return.= "<input type='text' id='$id' name='$id' value='$default' />";

		return $return;

	}

	function submit_button($value = "submit", $name = ""){

		$return = "";

		$return.="<input type='submit' name='$name' value='$value' />";

		return $return;
	}

	function checkbox($id = "noid",$checked = false, $value = ""){

		$return = "";

		if($checked){	
			$return.="<input type='checkbox' id='$id' name='$id' value='$value' checked = true />";
		}else{
			$return.="<input type='checkbox' id='$id' name='$id' value='$value'/>";
		}
		return $return;

	}

	function textarea($name = "",$value = ""){
		
		$return = "";


		$return.= "<textarea name='$name' id='$name' rows='10' cols='50'>";

		$return.="$value";
	
		$return.="</textarea>";


		return $return;

	}

	function simple_table($header = array(), $data = array()){
		
		$return = "<table>";

		$return.="<tr>";

		foreach($header as $key=>$value){
		
			$return.="<td>".$key."</td>";

		}

		$return.="</tr>";

		foreach($data as $row){

			$return.="<tr>";

			foreach($header as $key=>$value){

				$return.="<td>".$row[$key]."</td>";

			}

			$return.="</tr>";

		}

		$return.="</table>";

		return $return;

	}

	function table_with_form($action = "", $header = array(), $data = array(), $u_id = "u_id"){
		
		$return = "<form action='$action' method='POST'>";
		
		$return.= "<table>";

		$return.= "<tr>";

		foreach($header as $key=>$value){

			if($key == $u_id){

				continue;

			}
		
			$return.= "<td>".$key."</td>";

		}

		$return.= "</tr>";

		foreach($data as $row){

			$return.= "<tr>";

			foreach($header as $key=>$value){

				if($key == $u_id){

					continue;

				}

				if(strtolower($value) == "check"){

					$return.="<td>".GuiHelper::checkbox("check[]",$row[$key],$row[$u_id])."</td>";

				}
				if(strtolower($value) == "text"){
					$return.="<td>".$row[$key]."</td>";
				}

			}

			$return.="</tr>";

		}

		$return.="</table>";

		$return.=GuiHelper::submit_button();
		
		$return.="</form>";

		return $return;

	}


	function link($name,$dest){

		$return = "<a href='".$dest."'>".$name."</a>";

		return $return;

	}

}
