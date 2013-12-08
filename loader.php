<?php
$url = $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/";

define('ROOT', $url);
define('PLUGINROOT', ROOT."plugins");

include("const.php");
include("backend/mysql.php");
include("backend/errorhandling.php");
include("cache.php");
/*if(DEVELOPMODE){
	include ("backend/debug.php");
}*/
?>