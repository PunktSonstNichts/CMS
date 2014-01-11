<?php
//user_auth_check
if(!isset($_SESSION["user"])){
	echo "please log in";
	exit;
}

include("permission.php");

$admin_sidebar = array(
array( ROOT_URL."admin/admin-home.php", _t("home")),
array( ROOT_URL."admin/admin-new.php", _t("new"), array(
	ROOT_URL."admin/admin-new.php?type=post" => _t("post"),
	ROOT_URL."admin/admin-new.php?type=site" => _t("site"),
	ROOT_URL."admin/admin-new.php?type=directory" => _t("directory"),
	ROOT_URL."admin/admin-new.php?type=widget" => _t("widget"),
)),
array( ROOT_URL."admin/admin-design.php", _t("designs")),
array( ROOT_URL."admin/admin-widget.php", _t("widgets")),
array( ROOT_URL."admin/admin-plugins.php", _t("plugins")),
array( ROOT_URL."admin/admin-setting.php", _t("settings")),
array( ROOT_URL."admin/admin-user.php", _t("users"))
);
?>
<link rel="stylesheet" href="scripte/css/main.css" type="text/css"/>
<link rel="stylesheet" href="scripte/css/blue.css" type="text/css"/>

<script src="scripte/js/jquery.min.js"></script>
<script src="scripte/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripte/js/javascript.php"></script>
<?php
run_action("admin-head-loading");
?>
<script type="text/javascript" src="../plugins/wysiwyg/js/wysiwyg.js"></script>
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

$('form').submit(function(e){
	var form = $(this);
	e.preventDefault();
	$.ajax({
		type: $(this).attr("method"),
		url: $(this).attr("action"),
		data: $(this).serialize(),
		success: function(data){
			console.log(data);
			var obj = JSON.parse(data);
			if(obj.error == false){
				$('div').dialog('success', obj.msg);
				if(obj.location){
					location.replace(obj.location);
				}else{
					form.children('input[type=text]').val("");
					form.find('div[contenteditable=true]').html("");		
				}
			}else{
				$('div').dialog('error', obj.msg);
			}
		}
	});
});

});



function isValidDate(date){
    var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(date);
    if (matches == null) return false;
    var d = matches[2];
    var m = matches[1] - 1;
    var y = matches[3];
    var composedDate = new Date(y, m, d);
    return composedDate.getDate() == d &&
            composedDate.getMonth() == m &&
            composedDate.getFullYear() == y;
}
console.log(isValidDate('10-12-1961'));
console.log(isValidDate('12/11/1961'));
console.log(isValidDate('02-11-1961'));
console.log(isValidDate('12/01/1961'));
console.log(isValidDate('13-11-1961'));
console.log(isValidDate('11-31-1961'));
console.log(isValidDate('11-31-1061'));
</script>
</head>
<body>
<div id="header">
<div id="sidebar-toggleview" class="header-element">Sidebar</div>
<div class="divider"></div>
<div id="notifications" class="header-element">
			<div id="active_notification">
			<div class="icon"><!-- EDIT IMG HERE --></div><span>activity</span>
			</div>
		</div>
<div id="user_control">
<?php echo sprintf( _t('Welcome back, %s'), '<a href="admin-profile.php?user='.$_SESSION["user"]["name"].'" title="'.$_SESSION["user"]["ip"].'">'.$_SESSION["user"]["name"].'</a>');?>
</div>
</div>
<!-- Sidebar -->
<div id="sidebar">
<div id="sidebar-heading">
<span>My haramboy</span>
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