<?php
session_start();
include("../loader.php");


$Name = $_POST["username"]; 
$password = $_POST["userpassw"];
$remindme_checkbox = $_POST["remindme_checkbox"];

if($Name != ""){
	if($password != ""){
				$usersql = new mysql();
				$userresult = $usersql->query("SELECT  `Name`, `passw`, `role` FROM `users` WHERE `Name` LIKE '$Name';");
				$row = $usersql->result($userresult, "assoc");
				if(md5($password) == $row["passw"]){
					$_SESSION["user"] = array("name" => $row["Name"], "role" => $row["role"]);
					include("backend_UI.php");
				}else{
					$_SESSION["error"] = "Wrong Password";
					header("Location: ".ROOT."/admin/index.php");
					exit;
				}			
	}else{
	$_SESSION["error"] = "Empty Password field";
	header("Location: ".ROOT."/admin/index.php");
	exit;
	}
}else{
$_SESSION["error"] = "Empty User Field";
header("Location: ".ROOT."/admin/index.php");
exit;
}
?>