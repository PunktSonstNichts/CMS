<?php
session_start();
include("admin.php");
include("../loader.php");

error_reporting(E_ALL);

switch($_GET["type"]){
	case "enable":
		$old_chdir = getcwd();
		chdir(SERVER_DIR);

		$filename = "plugins/".$_GET["plugin"]."/init.php";

		//get old content
		$file = fread(fopen($filename,"r"), filesize($filename));


		$neu = fopen ($filename,"w");
		print_r($file);
		$zeile_arr = explode("\r\n", $file);
		$target_line = count($zeile_arr) - 2;
		if($_GET["enable"] == "true"){
			$zeile_arr[$target_line] = '$plugin_enabled = true;';
		}else{
			$zeile_arr[$target_line] = '$plugin_enabled = false;';
		}
		implode("\r\n", $zeile_arr);
		fwrite($neu, implode("\r\n", $zeile_arr)); 
		fclose ($neu);

		chdir($old_chdir);
		//return to old address
		header("Status: 301 Moved Permanently"); 
		header("Location:".$_GET["return"]); 
		exit;
	case "edit":

		$admin = new admin("plugin");
		include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
<div class="element" id="general_setting" style="float: none;">
<div class="element-heading">
<span>
<?php
echo sprintf(_t("%s - editor"), (isset($_GET["name"])) ? $_GET["name"] : $_GET["plugin"]);
?>
</span>
</div>
<div class="element-content">
<?php
if($_GET["plugin"] != ""){
	$old_chdir = getcwd();
	chdir(SERVER_DIR);
	if(file_exists("plugins/".$_GET["plugin"]."/setting.php")){
		include("plugins/".$_GET["plugin"]."/setting.php");
	}else{
		 echo _t("ohh, something went horrible wrong.");
	}
}else{
	echo _t("no values transmitted");
}
?>
</div>
</div>
</body>
<?php
	break;
	case "checkifvalid":

		$admin = new admin("plugin");
		include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
<div class="element" style="float: none;">
<div class="element-heading">
<span>
<?php
echo sprintf(_t("%s - check"), (isset($_GET["name"])) ? $_GET["name"] : $_GET["plugin"]);
?>
</span>
</div>
<div class="element-content">
<?php
if($_GET["plugin"] != ""){
	$old_chdir = getcwd();
	chdir(SERVER_DIR);
	if(file_exists("plugins/".$_GET["plugin"]."/main.php")){
		ob_start();
		include("plugins/".$_GET["plugin"]."/main.php"); // not the safiest way - bug!
		$plugin_output = ob_get_contents();
		if($plugin_output != ""){
			echo "<b>".sprintf(_t('danger! The plugin %1$s is returning some content, although the content should only called due to the action handling. For more details view %2$s'), $_GET["plugin"], "<a href='XXX'>"._t("our help")."</a>")."</b>";
		}else{
			echo "<b>"._t('Your Plug-In seem\'s to work fine!')."</b>";
		}
	}else{
		 echo sprintf(_t('no main.php exist in \"%1$s\".'), "plugins/".$_GET["plugin"]."/main.php");
	}
}else{
	echo _t("no values transmitted");
}
?>
</div>
</div>
</body>
<?php
	break;
}
?>