<?php
$time_start = microtime();

if(!empty($_GET["site"])){
$actual_site = $_GET["site"];
}else{
$actual_site = "index";
}

// Definition based on mode
if(!empty($_GET["mode"])){
if($_GET["mode"] == "Admin"){
define("DEVELOPMODE",true);
define("CACHE",false);
}else{
define("DEVELOPMODE",false);
define("CACHE",true);
}
}else{
define("DEVELOPMODE",false);
define("CACHE",true);
}

include "loader.php";

//set_error_handler("log_error");
error_reporting(0);


switch(constant('DEVELOPMODE')){
	case true:
		ini_set('display_error', true);
		//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
		break;

	default:
		ini_set('display_error', false);
		//error_reporting(0);
		break;
}


//start website caching if const is true
run_action("before-cache");
if(CACHE == true){
$cache = new cache($actual_site, 1024);
}

include("backend/websitebuilder.php");


if(CACHE == true){
$cache->endcache();
}

echo "</br>Verarbeitungszeit des Skripts: ".sprintf('%.3f', (microtime() - $time_start))." Sekunden";
?>