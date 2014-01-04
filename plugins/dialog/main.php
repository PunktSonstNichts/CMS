<?php
$old_chdir = getcwd();
chdir(SERVER_DIR);

function dialog_css(){
	echo '<link rel="stylesheet" href="http://'.PLUGINROOT.'dialog/dialog.css" type="text/css"/>';
}
add_action("admin-head-loading", "dialog_css");

function dialog_js(){
	echo '<script type="text/javascript" src="http://'.PLUGINROOT.'dialog/dialog.js"></script>';
}
add_action("admin-head-loading", "dialog_js");
chdir($old_chdir);
?>