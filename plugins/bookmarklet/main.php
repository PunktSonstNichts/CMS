<?php
function queue_element_to_dashboard(){
//add the bookmarklet box to the dashboard
global $admin;

$help = array(
	array(
		"id" => 1,
		"title" => _t("What does the bookmarklet?"),
		"content" => _t("The Bookmarklet allows a logged in user to post easely any content he finds on his site, just by pressing one button.")
	),
	array(
		"id" => 2,
		"title" => _t("How you use the bookmarklet?"),
		"content" => _t("To put the \"Press This\"-button into our bookmark-list, simply drag&drop it into there.")
	),
);
$admin->add_dashboard_element("bookmarklet", "Bookmarklet", "dashboard_html", 1, 10, $help);
}
add_action("admin-dashboard", "queue_element_to_dashboard");

function dashboard_html($target){
if($target == "dashboard" && can_current_user("bookmarklet")){
?>
<a href='javascript:var html = "";if (typeof window.getSelection != "undefined"){  var sel = window.getSelection(); if (sel.rangeCount) { var container = document.createElement("div"); for (var i = 0, len = sel.rangeCount; i < len; ++i) {container.appendChild(sel.getRangeAt(i).cloneContents());}html = container.innerHTML;}}else if (typeof document.selection != "undefined"){if (document.selection.type == "Text"){html = document.selection.createRange().htmlText;
						}
					}
					url = "<?php echo "http://localhost/CMS/plugins/bookmarklet/bookmarklet.php?";?>url=" + location.href + "&text=" + html;
					fenster = window.open(url, "Edit Post", "width=400,height=300,resizable=yes");
					fenster.focus();'>Press This</a>
<?php
}else{
echo _t("Cheatin, uh?");
}
}

function installation(){
add_permission("admin", "bookmarklet", "1");
add_permission("content manager", "bookmarklet", "1");
}
?>