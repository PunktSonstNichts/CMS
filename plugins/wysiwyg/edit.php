<?php
$_GET["x-size"];
$_GET["y-size"];
$type = $_GET["type"];
switch ($type){
case "img":
?>
	<div id="dialog-heading">
		<span>Editor for images</span>
		<div id="dialog-settings"><div class="close">x</div></div>
	</div>
	<div id="dialog-content">
		<span><small>Please be sure to don't violant any copyright laws. Unless the picture is yours or you have the lizence to show it on your website, link the original source to the image.</small></span>
		<div class="dialog-divider"></div>
		<div class="input-element">
			<label for="source">Copyright source:</label>
			<div class="label-helper">
				<input type="text" class="elem-edit" name="source" id="source" data-effected_attribut="data-copyright" placeholder="Copyright source..."/>
			</div>
		</div>
		<div class="dialog-divider"></div>
		<div class="input-element small">
			<label for="width" class="small">width: </label>
			<div class="label-helper">
				<input type="text" name="width" id="width" class="append-info elem-edit" data-effected_attribut="width" placeholder="width..." value="<?php echo $_GET["x-size"]; ?>"/>
				<div class="right-info"><span>px</span></div>
			</div>
		</div>
		<div class="input-element small">
			<label for="height">height: </label>
			<div class="label-helper">
				<input type="text" name="height" id="height" class="append-info elem-edit" data-effected_attribut="height" placeholder="height..." value="<?php echo $_GET["y-size"]; ?>"/>
				<div class="right-info"><span>px</span></div>
			</div>
		</div></br>
		
		<div id="dialog-handler">
			<button class="btn-success">Save edited image</button>
			<button class="btn-danger">cancel editing</button>
		</div>
	</div>
<?php
break;
case "a":	
?>
	<div id="dialog-heading">
		<span>Edit this shit.</span>
		<div id="dialog-settings"><div class="close">x</div></div>
	</div>
	<div id="dialog-content">
		<span>You really want to change something, also after this box appears and singnals you there could be danger?</span>
		<div class="dialog-divider"></div>
		<div class="input-element">
			<label for="source">Copyright source:</label>
			<div class="label-helper">
				<input type="text" name="source" data-special-type="copyright" data-effected_attribut="data-special" id="source" placeholder="Copyright source..."/>
			</div>
		</div></br>
		<div class="input-element">
			<label for="source">Link name:</label>
			<div class="label-helper">
				<input type="text" name="source" data-special-type="html" data-effected_attribut="data-special" id="source" placeholder="Link name..."/>
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
			<button class="btn-danger">cancel editing</button>
		</div>
	</div>
<?php
break;
}
?>