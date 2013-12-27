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
define('PLUGINROOT', ROOT."plugins/");

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

// to add functions to specific actions
# add_action("user-registration", "send_admin_email", array(user-id, user-name));
include("backend/action.php");
// catching all php errors and instead of publishing them write them into log files
include("backend/errorhandling.php");
// mysql-class for an easy way to make querys
// to do: should log every mysql-query and if an DELETE or DROP is the command, should check if user or skript have the rights
# $taskssql = new mysql();
# $tasksresult = $taskssql->query("SELECT * FROM  `".$dbprae."tasks`;");
# while($tasks[] = $taskssql->result($tasksresult, "assoc"));
include("backend/mysql.php");
// translates all texts into selcted language, check if translation exists and get the ressources from different files
# _t("are you sure?", "breadcrumbs/", "widget")
include("backend/language.php");
// chaches all site to speed up server runtime
// to do: better check if site should get cached (eg. different languages)
include("cache.php");

if (defined('DEVELOPMODE')) {
	if(constant('DEVELOPMODE') == true){
		include ("backend/debug.php");
	}
}

if($handle = opendir("plugins/")) {
	while (false !== ($entry = readdir($handle))) {
		if($entry != "." && $entry != "..") {
			if(file_exists("plugins/".$entry."/main.php")){
				include("plugins/".$entry."/main.php");
			}
		}
	}
	closedir($handle);
}

run_action("loader-finished");

chdir( $old_chdir );
?>