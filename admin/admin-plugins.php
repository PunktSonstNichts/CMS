<?php
session_start();
include("admin.php");
$admin = new admin("plugins");
include("../loader.php");

run_action("admin-dashboard");

include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
<div class="element" id="general_setting" style="float: none;">
<div class="element-heading">
<span><?php echo _t("plugins"); ?></span>
</div>
<div class="element-content">
	<table>
	<thead>
		<tr>
			<th tabindex="0" rowspan="1" colspan="1" style="width: 350px;"><?php echo _t("plugin"); ?></th>
			<th tabindex="0" rowspan="1" colspan="1" ><?php echo _t("description"); ?></th>
		</tr>
	</thead> 
	<tbody>
	<?php
	$old_chdir = getcwd();
	chdir(SERVER_DIR);
	if($handle = opendir("plugins/")) {
	while (false !== ($entry = readdir($handle))) {
		if($entry != "." && $entry != "..") {
			if(file_exists("plugins/".$entry."/init.php")){
				$plugin_name = "";
				$plugin_author = "";
				$plugin_description = "";
				$plugin_installed = false;
				include("plugins/".$entry."/init.php");
	?>
	<tr>			
		<td>
			<b><?php echo (($plugin_name) ? $plugin_name : $entry); ?></b></br>
			<small>
			<?php
			if(file_exists("plugins/".$entry."/setting.php")){
			?>
				<a href="plugins-edit.php?plugin=<?php echo $entry;?>&name=<?php echo $plugin_name; ?>&type=edit"><?php echo _t('edit'); ?></a> | 
			<?php
			}
			?>
			<span class="label-danger"><?php echo _t('remove it'); ?></span> | 
			<a href="plugins-edit.php?plugin=<?php echo $entry;?>&enable=<?php echo ($plugin_enabled == true) ? "false" : "true"; ?>&return=<?php echo $_SERVER["PHP_SELF"]; ?>&type=enable" ><span class="plugin_enable"><?php echo ($plugin_enabled == true) ? _t("disable plugin") : _t("enable plugin"); ?></span></a> | 
			<a href="plugins-edit.php?plugin=<?php echo $entry;?>&name=<?php echo $plugin_name; ?>&type=checkifvalid" ><span class="plugin_enable"><?php echo _t("check plugin"); ?></span></a>
			
			</small>
		</td>
		<td>
		<?php
		echo ($plugin_description != "") ? $plugin_description : _t("undefined");
		echo ($plugin_author != "") ? ' <small><span class="label-success">'.sprintf( _t('by %s'), $plugin_author).'</span></small>' : '<small><span class="label-warning">'._t("no author").'</span></small>';
		if(!$plugin_installed){
		?>
		<hr style="margin: 5px;">
		<span class="warning"><?php echo sprintf(_t('%1$s isn\'t installed. The plug-in may not work correct. Fix it %2$s'), (($plugin_name) ? $plugin_name : $entry), "<a href='XXX'>"._t("now")."</a>"); ?></span>
		<?php
		}
		?>
		</td>
	</tr>
	<?php
			}else{
	?>
		<tr>
			<td>
			<b><?php echo $entry; ?></b></br>
			<small><span class="label-danger"><?php echo _t('remove it'); ?></span> | <a href="http://cms.de/plug-in/report?name=<?php echo $entry; ?>"><?php echo _t("report plugin"); ?></a></small>
			</td>
			<td>
			<?php
			echo sprintf( _t('%1$s has no <b>init.php</b>. This plugin won\'t work. <br>Fix it by re-installing the plugin or creating a new init.php with its content. For more details visit %2$s.'), $entry, "<a href='cms.de/plugins/init'>"._t("help")."</a>");
			?>
			</td>
		</tr>	
	<?php		
			}
		}
	}
	closedir($handle);
	}
	chdir($old_chdir);
	?>
	</tbody>
	</table> 

</div>
</div>
</div> <!-- #header-fixed-helper -->
</body>