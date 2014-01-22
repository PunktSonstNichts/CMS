<?php
session_start();
include("admin.php");
$admin = new admin("settings");
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

run_action("admin-dashboard");


include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
<div class="element" id="general_setting" style="float: none;">
<div class="element-heading">
<span><?php echo _t("general settings"); ?></span>
</div>
<div class="element-content">
<form action="setting_change.php" method="post" style="float: left;">
<table>
	<thead>
		<tr>
			<th><b><?php echo _t("name"); ?></b></th>
			<th style="width: 65%;"><b><?php echo _t("value"); ?></b></th>
		</tr>
	</thead> 
	<tbody>
<?php
$settingssql = new mysql();
$settingsresult = $settingssql->query("SELECT * from ".$dbprae."globals  WHERE `user_editable` = 1;");
while($setting = $settingssql->result($settingsresult, "assoc")){
?>
<tr>
	<td><label class="setting_label" for="setting_<?php echo $setting["ID"]; ?>"><?php echo $setting["key"]; ?></label></td>
	<td><input type="text" style="width: 100%;" class="setting_input" title="<?php echo $setting["description"]; ?>" value="<?php echo $setting["value"]; ?>" id="setting_<?php echo $setting["ID"]; ?>" name="<?php echo $setting["key"]; ?>" <?php echo ($setting["type"] == "info") ? "disabled" : ""; ?>/></td>
</tr>
<?php
}
?>
<tr>
	<td><input type="submit" class="btn" value="<?php echo _t("save edited settings"); ?>"/></td>
	<td><input type="button" class="btn-danger" value="<?php echo _t("cancel editing"); ?>"/></td>
</tr>
</tbody>
</table>
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