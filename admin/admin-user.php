<?php
session_start();
include("admin.php");
$admin = new admin("users");
include("../loader.php");


function user_css(){
?>
.user-label{
width: 150px;
display: inline-block;
margin-bottom: 5px;
}
.user-content{
margin-right: 5px;
margin-bottom: 5px;
}
<?php
}

//put css to other css for a cleaner html output
add_action("admin-css", "user_css");

run_action("admin-dashboard");

include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
<div class="element">
	<div class="element-heading">
		<span><?php echo _t("users"); ?></span>
	</div>
	<div class="element-content">
		<table>
			<thead>
				<tr>
					<th><b><?php echo _t("user"); ?></b></th>
					<th><b><?php echo _t("role"); ?></b></th>
					<th><?php echo _t("description"); ?></th>
				</tr>
			</thead> 
			<tbody>
			<?php
			$usersql = new mysql();
			$user_result = $usersql->query("SELECT * FROM `".$usersql->dbprae."users`;");
			while($user = $usersql->result($user_result, "assoc")){
			?>
				<tr>
					<td><?php echo $user["Name"]; ?></td>
					<td><?php echo _t($user["role"]); ?></td>
					<td><?php echo $user["description"]; ?></td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
</div>
</div>
</body>
</html>