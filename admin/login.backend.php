<?php

session_start();
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
				$userresult = $usersql->query("SELECT  `Name`, `passw`, `role` FROM `".$dbprae."users` WHERE `Name` LIKE '$Name';");
				$row = $usersql->result($userresult, "assoc");
				if(md5($password) == $row["passw"]){
				
					if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
						$ip = $_SERVER['HTTP_CLIENT_IP'];
					} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
						$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					} else {
						$ip = $_SERVER['REMOTE_ADDR'];
					}
					
					$_SESSION["user"] = array("name" => $row["Name"], "role" => $row["role"], "ip" => $ip, "is_disabled" => false);
					$reply["error"] = false;
					$reply["location"] = "admin-home.php";
				}else{
					$reply["error"] = true;
					$reply["location"] = "index.php";
					$reply["msg"] = _t("Wrong Password");
				}			
	}else{
	$reply["error"] = true;
	$reply["location"] = "index.php";
	$reply["msg"] = _t("Empty Password field");
	}
}else{
$reply["error"] = true;
$reply["location"] = "index.php";
$reply["msg"] = _t("Empty User Field");
}
echo json_encode($reply);
?>