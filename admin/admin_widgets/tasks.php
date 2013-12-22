<div class="element" style="width: 500px;">
	<div class="element-heading">
		<span><?php echo _t("tasks in progress"); ?></span>
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
			<th tabindex="0" rowspan="1" colspan="1" style="width: 200px;"><?php echo _t("task"); ?></th>
			<th tabindex="0" rowspan="1" colspan="1" style="width: 170px;"><?php echo _t("assigned to"); ?></th>
			<th tabindex="0" rowspan="1" colspan="1" style="width: 90px;"><?php echo _t("progress"); ?></th>
			<th tabindex="0" rowspan="1" colspan="1" style="width: 80px;"><?php echo _t("status"); ?></th></tr>
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
			<td><input type="text" class="slim" placeholder="<?php echo _t("task name"); ?>"></td>
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
			<td><input type="submit" class="btn slim" value="<?php echo _t("add task"); ?>"></td>
		</tr>	
		</tbody>
		</table> 	
	</div>
</div>