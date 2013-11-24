<?php
define('ROOT', dirname(__FILE__));
define('PLUGINROOT', ROOT."\plugins");

include("const.php");
include("backend/mysql.php");
include("backend/errorhandling.php");
include("cache.php");
/*if(DEVELOPMODE){
	include ("backend/debug.php");
}*/
?>