<?php
function _t($text = "", $type = "return"){
	if("" == $text){
		return "no text"; //drop error
	}else{
		if(@get_translation($text) !== false){
			return get_translation($text);
		}else{
			return $text;
		}
	}
}

function get_translation($text){
	$old_chdir = getcwd();
	chdir(SERVER_DIR);
	include "lang/lang_DE.php";
	chdir( $old_chdir );
	
	if($_lang[$text] != ""){
		return $_lang[$text];
	}else{
		return false;
	}
}

?>