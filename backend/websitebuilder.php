<?php

//Build header
include("backend/header.php");

$index = new mysql();
$result = $index->query("SELECT * FROM  `".$dbprae."pages` WHERE `name` = '$actual_site' LIMIT 1");
$pagedata = $index->result($result, "assoc");

$template_sql = new mysql();
$template_res = $template_sql->query("SELECT `value` FROM `".$dbprae."globals` WHERE `key` = 'template' LIMIT 1;");
$template = $template_sql->result($template_res, "assoc");

define("TEMPLATE", $template["value"]); // To allow widgets to determine actual template


$file = "templates/".$template["value"]."/".$pagedata["template"].".php";
if (file_exists($file)){
$header = new header($actual_site, $dbprae);
/*
Define all important vars and array's
*/
$widgets = new mysql();
$result = $widgets->query("SELECT * FROM `".$dbprae."pagemeta` WHERE `affected_pageID` = '".$pagedata["ID"]."'");
while($pagedata_widgets[] = $widgets->result($result, "assoc"));

$setting = new mysql();
$setting_result = $setting->query("SELECT * FROM `".$dbprae."widgets_settings`;");
while($settings[] = $setting->result($setting_result, "assoc"));


include("backend/body.php");

$body = new body($pagedata, $pagedata_widgets, $settings);
// Including the template
include($file);
}else{
echo " <p class='error'><b>websitebuilder.php</b> template '".$file."' nicht gefunden</p>";
}
$index->free_result(); 
$index->close_connect(); 

?> 