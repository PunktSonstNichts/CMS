<?php
if($_SESSION["user"]["role"] == "admin"){
?>
<div class="element" id="quikpost">
	<div class="element-heading">
		<span><?php echo _t("quikpost");?></span>
	</div>
	<div class="element-content">
		<form method="post" style="margin-left: 5px;" action="publish.php">
			<input type="text" name="article-title" placeholder="<?php echo _t("your title");?>" style="margin-bottom: 5px; width: 364px;"/>
			<?php
			#quikpost
			$default_settings_sql = "SELECT setting, value FROM `widgets_settings` WHERE `widget` = 'quikpost_w'";
			$default_settings_c = new mysql();
			$metaresult = $default_settings_c->query($default_settings_sql);
			// putting all pre-defined settings into hidden input fields,
			// so that the client can change these in modal dialog
			while($row = $default_settings_c->result($metaresult, "assoc")){
			?>
				<input type="hidden" name="<?php echo $row["setting"];?>"   value="<?php echo $row["value"];?>"/>
			<?php
			}
			$wysiwygtype = "simple";
			chdir(SERVER_DIR);
			include("plugins/wysiwyg/editor.php");
			chdir( $old_chdir );
			?>
			<input type="submit" class="btn" value="<?php echo _t("publish");?>"/>
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