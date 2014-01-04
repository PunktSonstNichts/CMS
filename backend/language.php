<?php
function _t($text = "", $specific_lang_folder = "", $cms_type = ""){
	if("" == $text){
		return "no text"; //drop error
	}else{
		if(@get_translation($text, $specific_lang_folder, $cms_type) !== false){
			return get_translation($text, $specific_lang_folder, $cms_type);
		}else{
			if(DEVELOPMODE){
				if($specific_lang_folder != ""){
					//lang related to current .php file
					switch($cms_type){
						case "widget":
							$file = "widgets/".$specific_lang_folder."lang/lang_DE.php";
						break;
						case "plugin":
							$file = "plugins/".$specific_lang_folder."lang/lang_DE.php";
						break;
						default:
							$file = $specific_lang_folder."lang/lang_DE.php";
					}
				}else{
					$file = "lang/lang_DE.php";
				}
				$lang_error_string = "$file|$text\n";
				$lang_error_file = "export/lang.txt";
				$lang_handle = fopen($lang_error_file, "a");
				fwrite($lang_handle, $lang_error_string);

				
				new error("[lang] $text could not been found in lang databases / $specific_lang_folder - $cms_type");
			}
			return $text;
		}
	}
}

function get_translation($text, $specific_lang_folder, $cms_type){
	//get standard lang package
	$old_chdir = getcwd();
	chdir(SERVER_DIR);
		include "lang/lang_DE.php";
		//get personal language package, if php file support it
		if($specific_lang_folder != ""){
		//lang related to current .php file
			switch($cms_type){
				case "widget":
					if(file_exists("widgets/".$specific_lang_folder."lang/lang_DE.php")){
						include "widgets/".$specific_lang_folder."lang/lang_DE.php";
					}
				break;
				case "plugin":
					if(file_exists("plugins/".$specific_lang_folder."lang/lang_DE.php")){
						include "plugins/".$specific_lang_folder."lang/lang_DE.php";
					}
				break;
				default:
					if(file_exists($specific_lang_folder."lang/lang_DE.php")){
						include $specific_lang_folder."lang/lang_DE.php";
					}
			}
		}
	chdir( $old_chdir );
	
	
	
	if($_lang[$text] != ""){
		return $_lang[$text];
	}else{
		return false;
	}
}
?>