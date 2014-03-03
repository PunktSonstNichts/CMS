<?php
session_start();
include("admin.php");
$admin = new admin("home");
include("../loader.php");

run_action("admin-dashboard");

include_once(dirname(__file__)."/backend_UI.php");
?>
<link rel="stylesheet" href="scripte/css/sites/dashboard.css" type="text/css"/>
<div id="contentframe">
	<div class="container" style="display: inline-block;">
		<div id="metabox">
		<?php
		$admin->metabox();
		?>
		</div>
		
		<div id="dashboard-container-column1" class="dashboard-container">
		<?php
		$admin->get_dashboard_elements(1);
		?>
		</div>
		<div id="dashboard-container-column2" class="dashboard-container">
		<?php 
		$admin->get_dashboard_elements(2);
		include("admin_widgets/articlepost.php");
		?>
		</div>
		<div id="dashboard-container-column3" class="dashboard-container">
		<?php
		include("admin_widgets/tasks.php");
		$admin->get_dashboard_elements(3);
		?>
		</div>
	</div>
</div>
</div> <!-- #header-fixed-helper -->
</body>