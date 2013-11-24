<?php
class Cache{

	public function __construct(){
		if ( func_num_args() > 0 ){
			var_dump(func_get_args());
		}
	}

	public function check(){
		//detect if a specific site or all get checked
		if ( func_num_args() > 0 ){
			foreach (func_get_args() as $key => $value){
				echo "$value</br>";
			}
		}else{
			echo "Yolo";
		}
	return true;
	}
	public function buildsite(){
	
	}
	public function putincache(){

	}
	public function deletecache(){

	}
}
?>