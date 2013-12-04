<?php
$url = $_SERVER['REQUEST_URI'];
$parts = array_filter(explode('/',$url));
$dir = $_SERVER['SERVER_NAME']."/";
$dowhile = true;
$countwhile = 1;
while( $dowhile != false){
	if($parts[$countwhile] == $_GET["site"]){
		$dowhile = false;
	}elseif($countwhile > count($parts) + 2){
		$dowhile = false;
	}else{
	$dir .= $parts[$countwhile] . "/";
	$countwhile++;
	}
}
if($dir[strlen($dir)-1] != "/"){
$dir .= "/";
}

define('ROOT', $dir);
define('PLUGINROOT', ROOT."plugins");

include("const.php");
include("backend/mysql.php");
include("backend/errorhandling.php");
include("cache.php");
/*if(DEVELOPMODE){
	include ("backend/debug.php");
}*/
?>