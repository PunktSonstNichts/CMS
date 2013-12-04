<?php
if(!empty($_GET["site"])){
$actual_site = $_GET["site"];
}else{
$actual_site = "index";
}
$time_start = microtime();


include "loader.php";
//set_error_handler("log_error");
error_reporting(0);

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

$ip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$datetime = date('Y-m-d H:i:s');
$cookie = "superawesomestuff";
$referer = $_SERVER['HTTP_REFERER'];
$domain = parse_url($referer, PHP_URL_HOST);

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
VALUES ( NULL ,  '$ip',  '$browser',  '$useragent',  '$cookie', '$domain',  '$datetime');");
$usertracking->result($query);


$cache = new cache($actual_site, 10);

if(file_exists("const.php")){
	if ((include 'const.php') == true){
		include("backend/websitebuilder.php");
	}else{
		include("install/index.php");
		exit();
	}
}else{
	include("install/index.php");
	exit();
}

$cache->endcache();
echo "</br>Verarbeitungszeit des Skripts: ".sprintf('%.3f', (microtime() - $time_start))." Sekunden";
?>