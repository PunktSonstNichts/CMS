<?php
session_start();
include("../loader.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<!-- <link rel="stylesheet" href="scripte/css/sites/pages.css" type="text/css"/> -->
<title><?php echo sprintf(_t("%s > backend"), _t("tasks")); ?></title>
</head>
<body>
<?php
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