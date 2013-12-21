<?php
session_start();

include("../loader.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title>Backend</title>
<meta charset="utf-8">
<link rel="stylesheet" href="scripte/css/main.css" type="text/css"/>
<link rel="stylesheet" href="scripte/css/blue.css" type="text/css"/>
<link rel="stylesheet" href="../plugins/dialog/dialog.css" type="text/css"/>
<script src="scripte/js/jquery.min.js"></script>
<script src="scripte/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripte/js/javascript.php"></script>
<script type="text/javascript" src="../plugins/dialog/dialog.js"></script>
<script type="text/javascript" src="../plugins/wysiwyg/js/wysiwyg.js"></script>
<script type="text/javascript">
$(document).ready( function(){

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

$(".sidebar_ajax").click( function(event){
console.log($(this).attr("href"));
event.preventDefault();
$("#contentframe").load( $(this).attr("href") );
});

$("#contentframe").load("<?php echo $_SESSION["user"]["role"]."/home.php"; ?>");

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
<?php echo sprintf( _t('Welcome back, %s'), '<a href="#">'.$_SESSION["user"]["name"].'</a>');?>
</div>
</div>
<!-- Sidebar -->
<div id="sidebar">
<div id="sidebar-heading">
<span>My CMS SYSTEM</span>
</div>
<ul id="admin-sidebar-panel">
<li href="<?php echo $_SESSION["user"]["role"]."/home.php"; ?>" class="sidebar_ajax"><span>Home</span></li>
<div class="submenu-group">
<li href="<?php echo $_SESSION["user"]["role"]."/new.php"; ?>" class="sidebar_ajax"><span>New</span></li>
<ul style="display: none;" class="submenu">
<div class="submenu-connector"></div>
      <li href="<?php echo $_SESSION["user"]["role"]."/new.php?type=post"; ?>" class="sidebar_ajax">Post</li>
      <li href="<?php echo $_SESSION["user"]["role"]."/new.php?type=site"; ?>" class="sidebar_ajax">Site</li>
      <li href="<?php echo $_SESSION["user"]["role"]."/new.php?type=directory"; ?>" class="sidebar_ajax">Directory</li>
      <li href="<?php echo $_SESSION["user"]["role"]."/new.php?type=widget"; ?>" class="sidebar_ajax">widget</li>
</ul>
</div>
<li href="<?php echo $_SESSION["user"]["role"]."/design.php"; ?>" class="sidebar_ajax"><span>Designs</span></li>
<li href="<?php echo $_SESSION["user"]["role"]."/widget.php"; ?>" class="sidebar_ajax"><span>Widgets</span></li>
<li href="<?php echo $_SESSION["user"]["role"]."/setting.php"; ?>" class="sidebar_ajax"><span>Settings</span></li>
<li href="<?php echo $_SESSION["user"]["role"]."/user.php"; ?>" class="sidebar_ajax last-li"><span>Users</span></li>
</ul>
</div>
<div id="contentframe"  style="overflow: auto;">
%
</div>
<div id="footer"></div>
</body>
</html>