<?php

function _t($text = ""){
	if("" == $text){
		//drop error
		echo "no text";
	}else{
		echo $text;
	}
}

?>