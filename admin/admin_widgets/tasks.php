<?php
if(!ROOT){ exit; }

/* Task
Preparing array for foreach-loop from sql result
*/
$taskssql = new mysql();
$tasksresult = $taskssql->query("SELECT * FROM  `".$taskssql->dbprae."tasks`;");
while($tasks[] = $taskssql->result($tasksresult, "assoc"));

?>
<div class="element" style="width: 100%;">
	<div class="element-heading">
		<span><?php echo _t("tasks in progress"); ?></span>
	</div>
	<div class="element-content">
		<table>
		<thead>
			<tr>
			<th><?php echo _t("task"); ?></th>
			<th><?php echo _t("assigned to"); ?></th>
			<th style="width: 90px;"><?php echo _t("progress"); ?></th>
			<th><?php echo _t("status"); ?></th></tr>
		</thead> 
		<tbody>
		<?php
		$user_c = new mysql();
		$user_sql = "SELECT ID, Name, role, active_Q0 FROM `".$user_c->dbprae."users`;";
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
		if(can_current_user("create_task")){
		?>
		<tr>
			<td><input type="text" class="slim" placeholder="<?php echo _t("task name"); ?>"></td>
			<td>
				<select width="130" style="width: 130px;" class="slim" name="user">
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
			<td><input type="submit" class="btn slim" value="<?php echo _t("add task"); ?>"></td>
		</tr>
		<?php
		}
		?>
		</tbody>
		</table> 	
	</div>
</div>