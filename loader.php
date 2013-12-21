<?php
#ROOT
/*
The ROOT definition need to take place in loader, cause loader gets called from different subfolders,
so const.php can't get called
*/
//$url = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"; // http should get changed
define('ROOT_URL', "http://localhost/CMS/");
define('SERVER_DIR', "C:/Users/Till/Desktop/xampp/htdocs/CMS");
define('ROOT', "localhost/CMS/");
define('PLUGINROOT', ROOT."plugins");

$old_chdir = getcwd();
chdir(SERVER_DIR);

#if inclusion fail, call installation
if(file_exists("const.php")){
	if((include 'const.php') !== true){
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

if (defined('DEVELOPMODE')) {
	if(constant('DEVELOPMODE') == true){
		include ("backend/debug.php");
	}
}

chdir( $old_chdir );
?>