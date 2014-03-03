<?php
session_start();
include("../loader.php");

$reply = array();

if($_SESSION["user"]){
	$_SESSION["user"]["is_disabled"] = true;
	$reply["error"] = false;
	$reply["location"] = "admin-home.php";
}

echo json_encode($reply);
?>