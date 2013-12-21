<?php
function _s($text = "", $type = "return"){
	if("" == $text){
		//drop error
		echo "no text";
	}else{
		if(@get_translation($text) !== false){
			return get_translation($text);
		}else{
			return $text;
		}
	}
}

function get_translation($text){
	include "lang_DE.php";
	if($_lang[$text] != ""){
		return $_lang[$text];
	}else{
		return false;
	}
}
?>
Hier die Tests:
<?php
echo sprintf( _s('welcome back %s!'), "PunktSonstNichts");
?>