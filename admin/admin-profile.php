<?php
session_start();
include("../loader.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="scripte/css/sites/profile.css" type="text/css"/>
<meta charset="utf-8">
<title><?php echo sprintf(_t("%s > backend"),  _t("user profile")); ?></title>
</head>
<body>
<?php
include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
<?php
	$user = htmlspecialchars($_GET["user"]);
	$usersql = new mysql();
	$usersqlresult = $usersql->query("SELECT  * FROM `".$usersql->dbprae."users` WHERE `Name` = '$user' LIMIT 1;");
	$user = $usersql->result($usersqlresult, "object");
?>
<div id="user_frame" class="clearfix">
	<div id="user_auth">
		<div id="avatar">
			<img src="" width="160" height="160"/>
		</div>
		<div id="user_name">
			<span><?php echo $user->Name; ?></span>
			
				<?php
				switch($user->role){
				case "":
				break;
				case "admin":
				?>
					<span class="label label-danger"><?php echo _t("admin"); ?></span>
				<?php
				break;
				case "moderator":
				?>
					<span class="label label-warning"><?php echo _t("moderator"); ?></span>
				<?php	
				break;
				case "designer":
				?>
					<span class="label label-success"><?php echo _t("designer"); ?></span>
				<?php	
				break;
				case "content manager":
				default:
				?>
					<span class="label label-primary"><?php echo _t("content manager"); ?></span>
				<?php	
				break;
				}
				?>
		</div>
		<?php
		if($user->Name == $_SESSION["user"]["name"]){
		?>
		<div id="user_action">
			<a href="#"><span><?php echo _t("edit"); ?></span></a> | 
			<a href="#"><span><?php echo _t("log out"); ?></span></a>
		</div>	
		<?php
		}
		?>
	</div>
	<div id="user_info">
		<div id="user_description">
			<span class="user_heading"><?php echo _t("about"); ?></span>
			<p><?php echo $user->description; ?></p>
		</div>
		<hr>
		<div id="user_tasks">
		<?php
		$tasks = array();
		$taskssql = new mysql();
		
		$tasksresult = $taskssql->query("SELECT * FROM  `".$dbprae."tasks` WHERE assigned_toUSERNAME LIKE '%".$user->Name."%';");
		while($tasks[] = $taskssql->result($tasksresult, "assoc"));
		
		$tasks = array_filter($tasks);
		if(!empty($tasks)){
		?>
			<span class="user_heading"><?php echo _t("task assigned"); ?></span>
				<table>
					<thead>
						<tr>
							<th tabindex="0" rowspan="1" colspan="1" style="width: 200px;"><?php echo _t("task"); ?></th>
							<th tabindex="0" rowspan="1" colspan="1" style="width: 90px;"><?php echo _t("progress"); ?></th>
							<th tabindex="0" rowspan="1" colspan="1" style="width: 80px;"><?php echo _t("status"); ?></th>
						</tr>
					</thead> 
					<tbody>
					<?php

					
					foreach($tasks as $task){
						if($task != ""){
							list($task_name, $task_type) = array_pad(explode("|", $task["status"], 2), 2, null);
							$label = "<span class='label-$task_type'>$task_name</span>";
							$progressbar = "$task_type";
						?>
						<tr>
							<td><?php echo $task["task-name"]; ?></td>
							<td><div class="progress slim <?php echo $progressbar; ?>"><div class="ui-progressbar-value" style="width: <?php echo $task["progress"]; ?>%;"></div></div></td>
							<td><?php echo $label; ?></td>
						</tr>		
						<?php
						}
					}
					?>
					</tbody>
				</table>
			<?php
			}elseif(can_current_user("create_task")){
			?>
			<div id="user_no_task"><?php echo sprintf(_t("%1$s isn't assigned to one task yet. <a href='%2$s'>create one for him</a>"), $user->Name, "#"); ?></div>
			<?php
			}
			?>
		</div>
	</div>
</div>

</body>