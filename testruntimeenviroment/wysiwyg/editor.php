<?php
define('ROOT', dirname(__FILE__));
?>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo BACKEND_ROOT;?>css/main.css" type="text/css"/>
<script src="http://code.jquery.com/jquery-latest.min.js "></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready( function(){
$(".wysiwygeditor-content").each( function() {
this.addEventListener("paste", function(e) {
    e.preventDefault();
    var text = e.clipboardData.getData("text/plain");
    document.execCommand("insertHTML", false, text);
});
});
});
function postEdit() {
	alert(document.getElementById("wysiwygeditor-content").innerHTML);
   document.getElementById("form_inhalt").value =  document.getElementById("wysiwygeditor-content").innerHTML;
   return true;
}
function format(command_name, command_value) {
   document.execCommand(command_name, false, command_value);
}
</script> 
<div class="wysiwygeditor-editor">
<input type="hidden" name="form_inhalt" id="form_inhalt" value="">
<div class="wysiwygeditor-toolbar">
<?php
if(empty($wysiwygtype)){
$wysiwygtype = "default";
}
switch($wysiwygtype){
case "simple":
?>
<button type="button" class="first" onclick="format('insertparagraph','<p>');" title="Textabsatz">¶</button>
<button type="button" onclick="format('formatblock','<h1>');" title="Überschrift 1. Ordnung">H1</button>
<button type="button" onclick="format('formatblock','<h2>');" title="Überschrift 2. Ordnung">H2</button>
<button type="button" onclick="format('formatblock','<h3>');" title="Überschrift 3. Ordnung">H3</button>
<button type="button" onclick="format('insertunorderedlist','');" title="Unsortierte Liste">●</button>
<button type="button" onclick="format('insertorderedlist','');"   title="Unsortierte Liste">1.</button>
&nbsp;
<button type="button" onclick="format('bold','');"><b>B</b></button>
<button type="button" onclick="format('italic','');"><i>I</i></button>
&nbsp;
<button type="button" onclick="format('justifyleft','');">|= </button>
<button type="button" onclick="format('justifyright','');"> =|</button>
<button type="button" onclick="format('justifycenter','');">)=(</button>
<button type="button" onclick="format('justifyfull','');">|=|</button>
<?php
break;
default:
?>
<button type="button" class="first" onclick="format('insertparagraph','<p>');" title="Textabsatz">¶</button>
<button type="button" onclick="format('formatblock','<h1>');" title="Überschrift 1. Ordnung">H1</button>
<button type="button" onclick="format('formatblock','<h2>');" title="Überschrift 2. Ordnung">H2</button>
<button type="button" onclick="format('formatblock','<h3>');" title="Überschrift 3. Ordnung">H3</button>
<button type="button" onclick="format('formatblock','<h4>');" title="Überschrift 4. Ordnung">H4</button>
<button type="button" onclick="format('insertunorderedlist','');" title="Unsortierte Liste">●</button>
<button type="button" onclick="format('insertorderedlist','');"   title="Unsortierte Liste">1.</button>
<button type="button" onclick="format('inserthorizontalrule','');"title="Trennlinie">&mdash;</button>
&nbsp;
<button type="button" onclick="format('bold','');"><b>B</b></button>
<button type="button" onclick="format('italic','');"><i>I</i></button>
<button type="button" onclick="format('subscript','');">
        <span style="font-size: 65%;"><sub>X</sub></span></button>
<button type="button" onclick="format('superscript','');">
        <span style="font-size: 65%;"><sup>X</sup></span></button>
<button type="button" onclick="document.execCommand('createlink');"><span style="text-decoration: underline;">link</span></button>
&nbsp;
<button type="button" onclick="format('justifyleft','');">|= </button>
<button type="button" onclick="format('justifyright','');"> =|</button>
<button type="button" onclick="format('justifycenter','');">)=(</button>
<button type="button" onclick="format('justifyfull','');">|=|</button>
<?php
break;
}
?>
</div>
<div contenteditable="true" class="wysiwygeditor-content" id="wysiwygeditor-content"></div>
<p><input type="submit" value="SAVE" onclick="return postEdit();"></p>
</div>