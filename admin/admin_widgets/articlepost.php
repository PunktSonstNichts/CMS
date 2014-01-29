<?php
if(can_current_user("publish_post")){
?>
<div class="element" id="quikpost" style="width: 100%;">
	<div class="element-heading">
		<span><?php echo _t("quikpost");?></span>
	</div>
	<div class="element-content">
		<form method="post" data-type="new-content" style="margin-left: 5px; margin-right: 5px;" action="publish.php">
			<div>
				<input type="text" name="article-title" placeholder="<?php echo _t("your title");?>" style="margin-bottom: 5px; width: 100%;"/>
			</div>
			<?php
			#quikpost
		
			$default_settings_c = new mysql();
			$default_settings_sql = "SELECT setting, value FROM `".$default_settings_c->dbprae."widgets_settings` WHERE `widget` = 'quikpost_w'";
			$metaresult = $default_settings_c->query($default_settings_sql);
			// putting all pre-defined settings into hidden input fields,
			// so that the client can change these in modal dialog
			while($row = $default_settings_c->result($metaresult, "assoc")){
			?>
				<input type="hidden" name="<?php echo $row["setting"];?>"   value="<?php echo $row["value"];?>"/>
			<?php
			}
			run_action("wysiwyg", array("type" => "simple"));
			?>
			<input type="submit" class="btn" value="<?php echo _t("publish");?>"/>
			<input type="button" class="btn btn-warning" value="<?php echo _t("save draft");?>"/>
			<input type="button" class="btn" value="<?php echo _t("extend");?>"/>
		</form>
	</div>
</div>
<?php
}else{
?>
<div class="element" id="quikpost">
	<div class="element-heading">
		<span><?php echo _t("access denied");?></span>
	</div>
	<div class="element-content">
		<?php echo _t("you have to be an admin to use the quikpost tool"); ?>
	</div>
</div>
<?php
}
?>