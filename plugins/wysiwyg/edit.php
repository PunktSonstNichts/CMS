<?php
include("../../loader.php");

$type = $_GET["type"];
switch ($type){
case "img":
?>
	<div id="dialog-heading">
		<span><?php echo _t("Editor for images");?></span>
		<div id="dialog-settings"><div class="close">x</div></div>
	</div>
	<div id="dialog-content">
		<span><?php echo _t("<small>Please be sure to don't violant any copyright laws. Unless the picture is yours or you have the lizence to show it on your website, link the original source to the image.</small>"); ?></span>
		<div class="dialog-divider"></div>
		<div class="input-element">
			<label for="source"><?php echo _t("Copyright source"); ?></label>
			<div class="label-helper">
				<input type="text" class="elem-edit" name="source" id="source" data-effected_attribut="data-copyright" placeholder="<?php echo _t("Copyright source"); ?>"/>
			</div>
		</div>
		<div class="dialog-divider"></div>
		<div class="input-element small">
			<label for="width" class="small"><?php echo _t("width"); ?></label>
			<div class="label-helper">
				<input type="text" name="width" id="width" class="append-info elem-edit" data-effected_attribut="width" placeholder="<?php echo _t("width"); ?>" value="<?php echo $_GET["x-size"]; ?>"/>
				<div class="right-info"><span>px</span></div>
			</div>
		</div>
		<div class="input-element small">
			<label for="height"><?php echo _t("height"); ?></label>
			<div class="label-helper">
				<input type="text" name="height" id="height" class="append-info elem-edit" data-effected_attribut="height" placeholder="<?php echo _t("height"); ?>" value="<?php echo $_GET["y-size"]; ?>"/>
				<div class="right-info"><span>px</span></div>
			</div>
		</div></br>
		
		<div id="dialog-handler">
			<button class="btn-success"><?php echo _t("Save edited image"); ?></button>
			<button class="btn-danger"><?php echo _t("cancel editing"); ?></button>
		</div>
	</div>
<?php
break;
case "a":	
?>
	<div id="dialog-heading">
		<span><?php echo _t("Edit this shit");?></span>
		<div id="dialog-settings"><div class="close">x</div></div>
	</div>
	<div id="dialog-content">
		<div class="input-element">
			<label for="source"><?php echo _t("anchor"); ?></label>
			<div class="label-helper">
				<input type="text" name="source" data-special-type="copyright" data-effected_attribut="data-special" id="source" placeholder="<?php echo _t("anchor"); ?>"/>
			</div>
		</div></br>
		<div class="input-element">
			<label for="source"><?php echo _t("link name"); ?></label>
			<div class="label-helper">
				<input type="text" name="source" data-special-type="html" data-effected_attribut="data-special" id="source" placeholder="<?php echo _t("link name"); ?>"/>
			</div>
		</div></br>
		<div class="input-element small">
			<label for="source">Title:</label>
			<div class="label-helper">
				<input type="text" name="source" data-effected_attribut="title" id="source" placeholder="Title..."/>
			</div>
		</div>

		
		<div id="dialog-handler">
			<button class="btn-success">Save edited link</button>
			<button class="btn-danger"><?php echo _t("cancel editing"); ?></button>
		</div>
	</div>
<?php
break;
}
?>