<?php
session_start();
include("../loader.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title>Backend</title>
</head>
<body>
<?php
include_once(dirname(__file__)."/backend_UI.php");

//Add securitycheck here


/* Task
Preparing array for foreach-loop from sql result
*/
$taskssql = new mysql();
$tasksresult = $taskssql->query("SELECT * FROM  `".$dbprae."tasks`;");
while($tasks[] = $taskssql->result($tasksresult, "assoc"));
?>
<div id="contentframe">
	<div class="container" style="display: inline-block;">
		<div class="row">
			<div class="col-8">
				<?php
				include("admin_widgets/statistics.php");
				?>
			</br>
				<?php
				include("admin_widgets/articlepost.php");
				?>
			</div>
		<div class="col-4">
			<div class="element" id="bookmarklet" style="width: 225px;">
				<div class="element-heading">
					<span>Bookmarklet</span>
				</div>
				<div class="element-content">
				<a href='javascript:var html = "";if (typeof window.getSelection != "undefined"){  var sel = window.getSelection(); if (sel.rangeCount) { var container = document.createElement("div"); for (var i = 0, len = sel.rangeCount; i < len; ++i) {container.appendChild(sel.getRangeAt(i).cloneContents());
							}
							html = container.innerHTML;
						}
					} else if (typeof document.selection != "undefined") {
						if (document.selection.type == "Text") {
							html = document.selection.createRange().htmlText;
						}
					}
					alert(html);
					url = "<?php echo "http://localhost/CMS/plugins/bookmarklet/index.php?";?>url=" + location.href + "&text=" + html;
					fenster = window.open(url, "Edit Post", "width=400,height=300,resizable=yes");
					fenster.focus();'>Press This</a>
				</div>
			</div>
			</br>
			 <?php include("admin_widgets/tasks.php"); ?>
		</div>
		</div>
	</div>
</div>
</body>