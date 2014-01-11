<?php
session_start();
include("../loader.php");

function setting_javascript(){
?>
	$(".setting_input").click( function(){
		$("#general_setting_desription").html($(this).attr("title"));
	});
<?php
}

//put javascript to other javascript for a cleaner html output
add_action("admin-javascript", "setting_javascript");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<meta charset="utf-8">
<title><?php echo sprintf(_t("%s > backend"), _t("settings")); ?></title>
</head>
<body>
<?php
include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
<div class="element" id="general_setting" style="float: none;">
<div class="element-heading">
<span><?php echo _t("general settings"); ?></span>
</div>
<div class="element-content">
<form action="setting_change.php" method="post" style="float: left;">
<?php
$settingssql = new mysql();
$settingsresult = $settingssql->query("SELECT * from ".$dbprae."globals;");
while($setting = $settingssql->result($settingsresult, "assoc")){
?>
<label class="setting_label" for="setting_<?php echo $setting["ID"]; ?>"><?php echo $setting["key"]; ?></label>
<input type="text" class="setting_input" title="<?php echo $setting["description"]; ?>" value="<?php echo $setting["value"]; ?>" id="setting_<?php echo $setting["ID"]; ?>" name="<?php echo $setting["key"]; ?>" <?php echo ($setting["type"] == "info") ? "disabled" : ""; ?>/>
<?php
}
?>
<input type="submit" class="btn" value="<?php echo _t("save edited settings"); ?>"/>
<input type="button" class="btn-danger" value="<?php echo _t("cancel editing"); ?>"/>
</form>
<div id="general_setting_desription" style="padding: 5px; float: right; margin-right: 10px; width: 330px;">
<?php echo _t("Click on a input field to see what is it about"); ?>
</div>
<br style="clear: both;">
</div>
</div>
<hr>
<div class="element" id="widget_setting" style="float: none;">
<div class="element-heading">
<span><?php echo _t("settings for widgets"); ?></span>
</div>
<div class="element-content">

</div>
</div>
</div>
</body>