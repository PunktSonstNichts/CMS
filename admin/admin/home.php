<?php
session_start();
include("../../loader.php");
/* Task
Preparing array for foreach-loop from sql result
*/
$taskssql = new mysql();
$tasksresult = $taskssql->query("SELECT * FROM  `".$dbprae."tasks`;");
while($tasks[] = $taskssql->result($tasksresult, "assoc"));
?>
<div class="row">
<div class="col-8">
	<?php
	include("admin_widgets/statistics.php");
	?>
</br>
	<div class="element" id="quikpost">
		<div class="element-heading">
			<span>Quickpost</span>
		</div>
		<div class="element-content">
			<form method="post" style="margin-left: 5px;" action="publish.php">
				<input type="text"   name="article-title" placeholder="Your title" style="margin-bottom: 5px; width: 364px;"/>
				<?php
				#quikpost
				$default_settings_sql = "SELECT setting, value FROM `widgets_settings` WHERE `widget` = 'quikpost_w'";
				$default_settings_c = new mysql();
				$metaresult = $default_settings_c->query($default_settings_sql);
				while($row = $default_settings_c->result($metaresult, "assoc")){
				?>
					<input type="hidden" name="<?php echo $row["setting"];?>"   value="<?php echo $row["value"];?>"/>
				<?php
				}
				$wysiwygtype = "simple";
				include("../plugins/wysiwyg/editor.php");
				?>
				<input type="submit" class="btn" value="bloggen"/>
				<input type="button" class="btn" value="erweitert"/>
			</form>
		</div>
	</div>
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
<div class="element" style="width: 500px;">
	<div class="element-heading">
		<span>Tasks in Progress</span>
		<div class="box-icon">
			<a href="index.html#" class="btn-setting"><i class="fa fa-wrench"></i></a>
			<a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
			<a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
		</div>
	</div>
	<div class="element-content">
		<table>
		<thead>
			<tr>
			<th tabindex="0" rowspan="1" colspan="1" style="width: 200px;">Task</th>
			<th tabindex="0" rowspan="1" colspan="1" style="width: 170px;">Assigned to</th>
			<th tabindex="0" rowspan="1" colspan="1" style="width: 90px;">Progress</th>
			<th tabindex="0" rowspan="1" colspan="1" style="width: 80px;">Status</th></tr>
		</thead> 
		<tbody>
		<?php
		#quikpost
		$user_sql = "SELECT ID, Name, role, active_Q0 FROM `".$dbprae."users`;";
		$user_c = new mysql();
		$user_result = $user_c->query($user_sql);
		while($user_array[] = $user_c->result($user_result, "assoc"));
		foreach($tasks as $task){
		if($task != ""){
		list($task_name, $task_type) = array_pad(explode("|", $task["status"], 2), 2, null);
			$label = "<span class='label-$task_type'>$task_name</span>";
			$progressbar = "$task_type";
		?>
		<tr>
			<td><?php echo $task["task-name"]; ?></td>
			<td><?php echo $task["assigned_toUSERNAME"]; ?></td>
			<td><div class="progress slim <?php echo $progressbar; ?>"><div class="ui-progressbar-value" style="width: <?php echo $task["progress"]; ?>%;"></div></div></td>
			<td><?php echo $label; ?></td>
		</tr>		
		<?php
		}
		}
		?>
				<tr>
			<td><input type="text" class="slim" placeholder="Task name"></td>
			<td>
				<select width="150" style="width: 150px;" class="slim" name="user">
					<?php
					foreach($user_array as $user){
						if($user != ""){
						echo "<option value='".$user["Name"]."'>".$user["Name"]."</option>";
						}
					}
					?>
				</select>
			</td>
			<td>Deadline</td>
			<td><input type="submit" class="btn slim" value="Add task"></td>
		</tr>	
		</tbody>
		</table> 	
	</div>
</div>
</div>
</div>