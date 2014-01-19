<?php
if(!ROOT){
exit;
}
?>
<link rel="stylesheet" href="<?php echo ROOT_URL;?>plugins/wysiwyg/css/wysiwyg.css" type="text/css"/>
<script src="<?php echo ROOT_URL;?>plugins/wysiwyg/js/wysiwyg.js"></script>
<div class="wysiwygeditor-editor">
<input type="hidden" name="form_inhalt" id="form_inhalt" value="">
<div class="wysiwygeditor-toolbar">
<?php
$wysiwygtype = "simple";
if($wysiwygtype){
switch($wysiwygtype){
case "simple":
?>
<style type="text/css">
.wysiwygeditor-content{
margin-top: 40px !important;
}
</style>
<script type="javascript">
$(document).ready( function(){
if(jQuery().dialog) {
    //run plugin dependent code
}else{
	$.getScript('scripts/js/dialog.js', function(){
		$('div').dialog('init');
	});
}

});
</script>
<button type="button" class="wysiwyg first" onclick="format('insertparagraph','<p>');" title="Textabsatz"><i class="fa">¶</i></button>
<ul class="wysiwyg" title="Textabsatz">
<span>h</span>
<div class="wysiwyg-submenu">
<button class="wysiwyg" type="button" onclick="format('formatblock','<h1>');" title="Überschrift 1. Ordnung">h1</button>
<button class="wysiwyg" type="button" onclick="format('formatblock','<h2>');" title="Überschrift 2. Ordnung">h2</button>
<button class="wysiwyg" type="button" onclick="format('formatblock','<h3>');" title="Überschrift 3. Ordnung">h3</button>
</div>
</ul>
<button class="wysiwyg" type="button" onclick="format('insertunorderedlist','');" title="Unsortierte Liste"><i class="fa fa-list-ul"></i></button>
<button class="wysiwyg" type="button" onclick="format('insertorderedlist','');"   title="Sortierte Liste"><i class="fa fa-list-ol"></i></button>
<button class="wysiwyg" type="button" onclick="format('bold','');"><i class="fa fa-bold"></i></button>
<button class="wysiwyg" type="button" onclick="format('italic','');"><i class="fa fa-italic"></i></button>
<ul class="wysiwyg last" title="Ausrichtung">
<span><i class="fa fa-align-center"></i></span>
<div class="wysiwyg-submenu">
<button class="wysiwyg" type="button" onclick="format('justifyleft','');"><i class="fa fa-align-left"></i></button>
<button class="wysiwyg" type="button" onclick="format('justifyright','');"><i class="fa fa-align-right"></i></button>
<button class="wysiwyg" type="button" onclick="format('justifycenter','');"><i class="fa fa-align-center"></i></button>
<button class="wysiwyg" type="button" onclick="format('justifyfull','');"><i class="fa fa-align-justify"></i></button>
</div>
</ul>
<?php
break;
default:
?>
<button class="wysiwyg" type="button" class="first" onclick="format('insertparagraph','<p>');" title="Textabsatz">¶</button>
<button class="wysiwyg" type="button" onclick="format('formatblock','<h1>');" title="Überschrift 1. Ordnung">H1</button>
<button class="wysiwyg" type="button" onclick="format('formatblock','<h2>');" title="Überschrift 2. Ordnung">H2</button>
<button class="wysiwyg" type="button" onclick="format('formatblock','<h3>');" title="Überschrift 3. Ordnung">H3</button>
<button class="wysiwyg" type="button" onclick="format('formatblock','<h4>');" title="Überschrift 4. Ordnung">H4</button>
<button class="wysiwyg" type="button" onclick="format('insertunorderedlist','');" title="Unsortierte Liste"><i class="fa fa-list-ul"></i></button>
<button class="wysiwyg" type="button" onclick="format('insertorderedlist','');"   title="Sortierte Liste"><i class="fa fa-list-ol"></i></button>
<button class="wysiwyg" type="button" onclick="format('inserthorizontalrule','');"title="Trennlinie">&mdash;</button>
<button class="wysiwyg" type="button" onclick="format('bold','');"><i class="fa fa-bold"></i></button>
<button class="wysiwyg" type="button" onclick="format('italic','');"><i class="fa fa-italic"></i></button>
<button class="wysiwyg" type="button" onclick="format('subscript','');"><span style="font-size: 65%;"><sub>X</sub></span></button>
<button class="wysiwyg" type="button" onclick="format('superscript','');"><span style="font-size: 65%;"><sup>X</sup></span></button>
<button class="wysiwyg" type="button" onclick="document.execCommand('createlink');"><span style="text-decoration: underline;">link</span></button>
<button class="wysiwyg" type="button" onclick="format('justifyleft','');"><i class="fa fa-align-left"></i></button>
<button class="wysiwyg" type="button" onclick="format('justifyright','');"><i class="fa fa-align-right"></i></button>
<button class="wysiwyg" type="button" onclick="format('justifycenter','');"><i class="fa fa-align-center"></i></button>
<button class="wysiwyg" type="button" class="last" onclick="format('justifyfull','');"><i class="fa fa-align-justify"></i></button>
<?php
break;
}
}
?>
</div>
<div contenteditable="true" class="wysiwygeditor-content" id="wysiwygeditor-content"></div>
</div>