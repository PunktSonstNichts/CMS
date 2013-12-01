<?php
//Build header
include("backend/header.php");

$index = new mysql();
$result = $index->query("SELECT * FROM  `".$dbprae."pages` WHERE `name` = '$actual_site' LIMIT 1");
$pagedata = $index->result($result, "assoc");
$index->free_result(); 
$index->close_connect(); 

$template_sql = new mysql();
$template_res = $template_sql->query("SELECT `value` FROM `".$dbprae."globals` WHERE `key` = 'template' LIMIT 1;");
$template = $template_sql->result($template_res, "assoc");
$template_sql->free_result(); 
$template_sql->close_connect(); 


//Define other Vars
define("TEMPLATE", $template["value"]); // To allow widgets to determine actual template
define( "ACTUAL_SITE", $actual_site); // Name of actual site
define( "ACTUAL_SITENAME", $pagedata["visual_name"]); // Visual-Name of actual site

$file = "templates/".$template["value"]."/".$pagedata["template"].".php";
if (file_exists($file)){
/*
Define all important vars and array's
*/
//widgets that are suppost to show on the side
$widgets = new mysql();
$result = $widgets->query("SELECT * FROM `".$dbprae."pagemeta` WHERE `affected_pageID` = '".$pagedata["ID"]."'");
while($pagedata_widgets[] = $widgets->result($result, "assoc"));

$setting = new mysql();
$setting_result = $setting->query("SELECT * FROM `".$dbprae."widgets_settings`;");
while($settings[] = $setting->result($setting_result, "assoc"));


/*
Vars for template to get all data
*/
//Header for tilte, meta
$header = new header(ACTUAL_SITE, ACTUAL_SITENAME, $dbprae);
//Body to call all widgets for a certain position
include("backend/body.php");
$body = new body($pagedata, $pagedata_widgets, $settings);


// Including the template
include($file);
}else{
echo " <p class='error'><b>websitebuilder.php</b> template '".$file."' nicht gefunden</p>";
}
?> 