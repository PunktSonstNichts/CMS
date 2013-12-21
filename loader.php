<?php
#ROOT
/*
The ROOT definition need to take place in loader, cause loader gets called from different subfolders,
so const.php can't get called

#in furture set_environmet will handle this problem
*/
//$url = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"; // http should get dynamically added
define('ROOT-URL', "http://localhost/CMS/");
define('ROOT', "localhost/CMS/");
define('PLUGINROOT', ROOT."plugins");

include ROOT.'backend/const.php';
#if inclusion fail, call installation
if(file_exists(ROOT."backend/const.php")){
	if((include ROOT.'backend/const.php') !== true){
		include("install/index.php");
		exit();
	}
}else{
	include("install/index.php");
	exit();
}

include("backend/mysql.php");
include("backend/errorhandling.php");
include("backend/language.php");
include("cache.php");

if(constant('DEVELOPMODE') == true){
	include ("backend/debug.php");
}

function set_environment($page = ""){

}
?>