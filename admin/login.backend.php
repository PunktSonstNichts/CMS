<?php
session_start();
define("DEVELOPMODE",false);
include("../loader.php");

$reply = array();

$Name = $_POST["username"]; 
$password = $_POST["userpassw"];
if(isset($_POST["remindme_checkbox"]) && $_POST["remindme_checkbox"]==false){
$remindme_checkbox  = false;
}else{
$remindme_checkbox = true;
}

if($Name != ""){
	if($password != ""){
				$usersql = new mysql();
				$userresult = $usersql->query("SELECT  `Name`, `passw`, `role` FROM `users` WHERE `Name` LIKE '$Name';");
				$row = $usersql->result($userresult, "assoc");
				if(md5($password) == $row["passw"]){
					$_SESSION["user"] = array("name" => $row["Name"], "role" => $row["role"]);
					$reply["error"] = false;
					$reply["location"] = "admin/backend_UI.php";
				}else{
					$reply["error"] = true;
					$reply["location"] = "index.php";
					$reply["msg"] = "Wrong Password";
				}			
	}else{
	$reply["error"] = true;
	$reply["location"] = "index.php";
	$reply["msg"] = "Empty Password field";
	}
}else{
$reply["error"] = true;
$reply["location"] = "index.php";
$reply["msg"] = "Empty User Field";
}
echo json_encode($reply);
?>