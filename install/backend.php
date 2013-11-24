<?php
function __call($method, $values){
	return json_Encode("unknown function ".$method);
}
//set up database
function db(){
	
}
//domain name and title
function name(){

}


switch($_POST["action"]){
case "init":
	
	break;
case "db":
	db($_POST["db_host"], $_POST["db_user"], $_POST["db_passw"]);
	break;
case "name":
	
	break;
}
?>