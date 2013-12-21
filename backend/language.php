<?php

function _t($text = "", $type = "return"){
	if("" == $text){
		//drop error
		echo "no text";
	}else{
		if("" != $_lang[$text]){
			return $_lang[$text];
		}else{
			return $text;
		}
	}
}

?>