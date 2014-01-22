<?php
session_start();
include("admin.php");
include("../loader.php");
if(!isset($admin)){
	$admin = ""; #kein Objekt
}
if(!is_object($admin)){
	$admin = new admin;
}
run_action("admin-dashboard");

$admin->set_title(sprintf(_t("%s > backend"), _t("tasks")));

include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
	<div class="element">
		<div class="element-heading">
			<span><?php echo _t("tasks"); ?></span>
		</div>
		<div class="element-content">
			
		</div>
	</div>
</div>
</div>
</div> <!-- #header-fixed-helper -->
</body>