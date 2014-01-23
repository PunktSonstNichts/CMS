<?php
//Build header
include("backend/header.php");

$index = new mysql();
$result = $index->query("SELECT * FROM  `".$index->dbprae."pages` WHERE `name` = '$actual_site' LIMIT 1");
$pagedata = $index->result($result, "assoc");
$index->free_result(); 
$index->close_connect();
unset($index);
run_action("pagedata", array("pagedata" => $pagedata));

$template_sql = new mysql();
$template_res = $template_sql->query("SELECT `value` FROM `".$template_sql->dbprae."globals` WHERE `key` = 'template' LIMIT 1;");
$template = $template_sql->result($template_res, "assoc");
$template_sql->free_result(); 
$template_sql->close_connect();
unset($template_sql);




$template_path = "templates/".$template["value"]."/".$pagedata["template"].".php";
if (file_exists($template_path)){
//Check if site is published
/*
If a task is assigned to the actual site and its taggeg as "WIP" client gets WIP error page
*/

// Conditions
$wip_condition_sql = new mysql();
$wip_condition_res = $wip_condition_sql->query("SELECT `value` FROM `".$wip_condition_sql->dbprae."globals` WHERE `key` = 'closed-by-wip-contidtion' LIMIT 1;");
$wip_condition = $wip_condition_sql->result($wip_condition_res, "assoc");
$wip_condition_sql->free_result(); 
$wip_condition_sql->close_connect(); 
$wip_condition = $wip_condition["value"];

//check for WIP - sql query
if($wip_condition != ""){

	$task = new mysql();
	$task_result = $task->query("SELECT * FROM `".$task->dbprae."tasks` WHERE `assigned_toSITENAME` = '".htmlspecialchars($_GET["site"])."' AND $wip_condition LIMIT 1;");
	$wip_task_info = $task->result($task_result, "assoc");
	flush();
	if($wip_task_info != ""){
		run_action("wip-site", array("wip-info" => $wip_task_info));
		$_wippage = "templates/".$template["value"]."/error-sites/wip.php";
		if(file_exists($_wippage)){
			include($_wippage);
		}else{
			include("error-sites/wip.php");
		}
		exit();
	}
}
	/*
	Define all important vars and array's
	*/
	//Define other Vars
	define( "TEMPLATE", $template["value"]); // To allow widgets to determine actual template
	define( "ACTUAL_SITE", $actual_site); // Name of actual site
	define( "ACTUAL_SITENAME", $pagedata["visual_name"]); // Visual-Name of actual site
	//widgets that are suppost to show on the side
	$widgets = new mysql();
	$result = $widgets->query("SELECT * FROM `".$widgets->dbprae."pagemeta` WHERE `affected_pageID` = '".$pagedata["ID"]."'");
	while($pagedata_widgets[] = $widgets->result($result, "assoc"));
	$widgets->free_result(); 
	$widgets->close_connect(); 
	unset($widgets);

	//settings for the widgets
	$setting = new mysql();
	$setting_result = $setting->query("SELECT * FROM `".$setting->dbprae."widgets_settings`;");
	while($settings[] = $setting->result($setting_result, "assoc"));
	$setting->free_result(); 
	$setting->close_connect(); 
	unset($setting);
	run_action("after-widget-setting-sql", array("widget-settings" => $settings));


	/*
	Vars for template to get all data
	*/
	//Header for tilte, meta
	$header = new header(ACTUAL_SITE, ACTUAL_SITENAME, $dbprae);
	//Body to call all widgets for a certain position
	include("backend/body.php");
	$body = new body($pagedata, $pagedata_widgets, $settings);

// Including the template
include($template_path);

}else{
	//Throw 404 error
	header('HTTP/1.0 404 Not Found');
	flush();
	$_404page = "templates/".$template["value"]."/error-sites/404.php";
	if(file_exists($_404page)){
		include($_404page);
	}else{
		include("error-sites/404.php");
	}
	exit();
}
?> 