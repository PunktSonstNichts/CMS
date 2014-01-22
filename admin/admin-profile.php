<?php
session_start();
include("admin.php");
include("../loader.php");
if(!isset($admin)){
	$admin = ""; #kein Objekt
}
if(!is_object($admin)){
	$admin = new admin;
}
run_action("admin-dashboard");

function profile_css(){
?>
<link rel="stylesheet" href="scripte/css/sites/profile.css" type="text/css"/>
<?php
}

add_action("admin-head-loading", "profile_css");
$admin->set_title(sprintf(_t("%s > backend"),  _t("user profile")));

include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
<?php
	$user = htmlspecialchars($_GET["user"]);
	$usersql = new mysql();
	$usersqlresult = $usersql->query("SELECT  * FROM `".$usersql->dbprae."users` WHERE `Name` = '$user' LIMIT 1;");
	$user = $usersql->result($usersqlresult, "object");
	if($user != ""){
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

		if($user->social != ""){
		$user_sozial_array = json_decode($user->social, true);
		?>
		<div id="user_social">
		<?php
		foreach($user_sozial_array as $social_platform => $social){
			switch($social_platform){
				case "facebook":
					echo '<a class="social_link" href="'.$social["link"].'" title="'.$social["name"].'" target="_blank"><i class="fa fa-fw fa-facebook fa-border fa-3x"></i></a>';
				break;
				case "github":
					echo '<a class="social_link" href="'.$social["link"].'" target="_blank"><i class="fa fa-fw fa-github fa-border fa-3x"></i></a>';
				break;
				case "youtube":
					echo '<a class="social_link" href="'.$social["link"].'" target="_blank"><i class="fa fa-fw fa-youtube-play fa-border fa-3x"></i></a>';
				break;
				default:
					echo '<a class="social_link" href="'.$social["link"].'" title="'.$social["name"].'" target="_blank"><i class="fa fa-external-link fa-border fa-3x"></i></a>';
				break;
			}
		}
		?>
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
		<?php
		$tasks = array();
		$taskssql = new mysql();
		
		$tasksresult = $taskssql->query("SELECT * FROM  `".$dbprae."tasks` WHERE assigned_toUSERNAME LIKE '%".$user->Name."%';");
		while($tasks[] = $taskssql->result($tasksresult, "assoc"));
		
		$tasks = array_filter($tasks);
		if(!empty($tasks)){
		?>
		<div id="user_tasks">
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
		</div>
		<?php
		}elseif(can_current_user("create_task")){
		?>
		<div id="user_tasks">
			<div id="user_no_task"><?php echo sprintf(_t('%1$s isn\'t assigned to one task yet. <a href=\'%2$s\'>create one for him</a>'), $user->Name, "#"); ?></div>
		</div>
		<?php
		}
		?>
		<hr>
		<div id="last_activity">
			<span class="user_heading"><?php echo _t("last activity"); ?></span></br>
			
			<?php
			$crawlersql = new mysql();
			// To get the column names of the widgets...
			$crawlerresult = $crawlersql->query("SELECT * FROM  `".$dbprae."globals` WHERE `type` = 'search_key';");
			while($crawler = $crawlersql->result($crawlerresult, "assoc")){
			if($crawler != ""){
				$columnnames = json_decode($crawler["value"], true);
				?>
				<div class="well" id="last_activity_<?php echo $crawler["key"];?>">
				<?php
				$objectsql = new mysql();
				$objectresult = $objectsql->query("SELECT * FROM  `".$dbprae.$crawler["key"]."` WHERE ".$columnnames["username"]." = '".$user->Name."' ORDER BY ".$columnnames["date"]." DESC;");
				while($objects[] = $objectsql->result($objectresult, "assoc"));
				if($objects[0] != ""){ // Check if the array contains at least one element
				foreach($objects as $object){
					?>
					<div class="activity_element <?php echo $crawler["key"]; ?>">
						<div class="activity_element_title" style="float:left;"><a href="<?php echo $object[$columnnames["link"]]; ?>"><?php echo $object[$columnnames["title"]]; ?></a></div>
						<div class="activity_element_date" style="width: 100%; text-align: right;"><small style="font-size: 0.8em; color: rgb(66,66,66);"> <?php echo _t("since").date_format(date_create($object[$columnnames["date"]]), 'd.m.y // H:i:s'); ?></small></div><br>
						<div class="activity_element_preview"><?php echo $object[$columnnames["preview"]]; ?></div>
					</div>
					<hr>
					<?php
				}
				}else{
					?>
					<div class="activity_element no_activity">
							<div class="activity_element_title"><?php echo sprintf(_t('%1$s didn\'t have any activity on %2$s'), $user->Name, $crawler["key"] ); ?></div>
					</div>
					<hr>
					<?php				
				}
				?>
				</div>
				<?php
			}
			}
			?>
		</div>
	</div>

</div>
<?php
}else{
?>
<div id="user_frame" class="clearfix">
	<div class="element" id="general_setting" style="float: none;">
		<div class="element-heading">
			<span><?php echo _t("error"); ?></span>
		</div>
		<div class="element-content">
		<?php echo sprintf(_t('user "%1$s" does not exist in database. Check the url or visit your <a href="%2$s">user list</a>.'), htmlspecialchars($_GET["user"]), "XXX"); ?></br>
		</div>
	</div>
</div>
<?php
}
?>
</div>
</div> <!-- #header-fixed-helper -->

</body>