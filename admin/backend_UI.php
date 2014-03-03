<?php
//user_auth_check
if(!isset($_SESSION["user"]) || !isset($_SESSION["user"]["name"])){
	echo "please log in";
	exit;
}


$admin_sidebar = array(
array( ROOT_URL."admin/admin-home.php", '<i class="fa fa-tachometer"></i> '._t("home")),
array( ROOT_URL."admin/admin-new.php", '<i class="fa fa-pencil"></i> '._t("new"), array(
	ROOT_URL."admin/admin-new.php?type=post" => _t("post"),
	ROOT_URL."admin/admin-new.php?type=site" => _t("site"),
	ROOT_URL."admin/admin-new.php?type=directory" => _t("directory"),
	ROOT_URL."admin/admin-new.php?type=widget" => _t("widget"),
)),
array( ROOT_URL."admin/admin-sites.php", '<i class="fa fa-files-o"></i> '._t("sites")),
array( ROOT_URL."admin/admin-design.php", '<i class="fa fa-magic"></i> '._t("designs")),
array( ROOT_URL."admin/admin-widgets.php", '<i class="fa fa-desktop"></i> '._t("widgets")),
array( ROOT_URL."admin/admin-plugins.php", ''._t("plugins")),
array( ROOT_URL."admin/admin-setting.php", '<i class="fa fa-wrench"></i> '._t("settings")),
array( ROOT_URL."admin/admin-user.php", '<i class="fa fa-user"></i> '._t("users"))
);

@header('Content-Type: ' . 'text/html' . '; charset=' . get_charset());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="scripte/css/main.css" type="text/css"/>
<link rel="stylesheet" href="scripte/css/blue.css" type="text/css"/>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<title><?php echo $admin->get_title(); ?></title>
<script src="scripte/js/jquery.min.js"></script>
<script src="scripte/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripte/js/javascript.php"></script>
<?php
run_action("admin-head-loading");
?>
<style type="text/css">
<?php
run_action("admin-css");
?>
</style>
<script type="text/javascript">
$(document).ready( function(){

<?php
run_action("admin-javascript");
?>

$('div').dialog('init');

	$("#help_toggle").click(function() {
		showOrHide = new Boolean();
		$("#help_content").toggle( showOrHide );
		if( showOrHide === true ){
			$("#help_content").slideDown(140);
		}else if( showOrHide === false ){
			$("#help_content").slideUp(140);
		}
	});
	
	$(".help-sitebar-list").click(function(){
	$(".help-sitebar-list").removeClass("active");
	$(this).addClass("active");
	$(".help_box").hide();
	$(".help_box#" + $(this).attr("data-target")).fadeIn();
	});
});
</script>
</head>
<body>
<div id="header">
<div id="sidebar-toggleview" class="header-element"><?php echo _t("Sidebar"); ?></div>
<div class="divider"></div>
<div id="notifications" class="header-element">
			<div class="btn slim btn-primary" style="height: 21px;">
			<span><i class="fa fa-cogs"></i> <?php echo _t("activity"); ?></span>
			</div>
		</div>
<div id="user_control">
<?php echo sprintf( _t('Welcome back, %s'), '<a href="admin-profile.php?user='.$_SESSION["user"]["name"].'">'.$_SESSION["user"]["name"].'</a>');?>
</div>
</div>
<div id="header-fixed-helper">
<div id="sidebar">
<div id="sidebar-heading">
<span>My CMS</span>
</div>
<ul id="admin-sidebar-panel">
<?php
run_action("before-adminsidebar");

foreach($admin_sidebar as $element_link => $element){

?>

<?php
	if(isset($element[2]) && is_array($element[2])){
		
		echo "<div class=\"submenu-group\">";
		echo "<li><a href='".$element[0]."'><span>".$element[1]."</span></a></li>";
		echo "<ul style=\"display: none;\" class=\"submenu\">";
		echo "<div class=\"submenu-connector\"></div>";


		foreach($element[2] as $link => $submenu){
			echo "<li><a href=".$link.">".$submenu."</a></li>";
		}

		echo "</ul>";
		echo "</div>";

	}else{
		echo "<li><a href='".$element[0]."'><span>".$element[1]."</span></a></li>";
	}

}
?>
</ul>
</div>
<div id="help" class="clearfix">
<?php $admin->get_help(); ?>
</div>
<div id="help_toggle"><?php echo _t("Help"); ?></div>

