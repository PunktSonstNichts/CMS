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
$admin->set_title(sprintf(_t("%s > backend"), _t("New")));
include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
	<div class="container" style="display: inline-block;">
		<div id="metabox">

		</div>

	</div>
</div>
</div> <!-- #header-fixed-helper -->
</body>