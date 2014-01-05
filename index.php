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

// user-log
$cookie = "superawesomestuff";
$useragent = $_SERVER['HTTP_USER_AGENT'];

if(strpos($useragent, 'MSIE') !== FALSE)
   $browser =  "Internet Explorer";
 elseif(strpos($useragent, 'Firefox') !== FALSE)
   $browser =  "Mozilla Firefox";
 elseif(strpos($useragent, 'Chrome') !== FALSE)
   $browser =  "Google Chrome";
 elseif(strpos($useragent, 'Opera Mini') !== FALSE)
   $browser =  "Opera Mini";
 elseif(strpos($useragent, 'Opera') !== FALSE)
   $browser =  "Opera";
 elseif(strpos($useragent, 'Safari') !== FALSE)
   $browser =  "Safari";
 else
   $browser =  "Other";


$usertracking = new mysql();
$query = $usertracking->query("INSERT INTO `".$dbprae."client_demograohy`  ( `ID` ,`IP` ,`Browser` ,`User Agent` ,`cookie` ,`Referrer` ,`accesstimestamp` )
VALUES ( NULL ,  '".$_SERVER['REMOTE_ADDR']."',  '$browser',  '$useragent',  '$cookie', '".parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)."',  '".date('Y-m-d H:i:s')."');");
$usertracking->result($query);
unset($usertracking);
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