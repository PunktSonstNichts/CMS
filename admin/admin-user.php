<?php
session_start();
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

//put javascript to other javascript for a cleaner html output
add_action("admin-css", "user_css");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<meta charset="utf-8">
<title><?php echo sprintf(_t("%s > backend"), _t("users")); ?></title>
</head>
<body>
<?php
include_once(dirname(__file__)."/backend_UI.php");
?>
<div id="contentframe">
<div class="element">
	<div class="element-heading">
		<span><?php echo _t("users"); ?></span>
	</div>
	<div class="element-content">
		<?php
			$user_sql = "SELECT * FROM `".$dbprae."users`;";
			$user_c = new mysql();
			$user_result = $user_c->query($user_sql);
			while($user = $user_c->result($user_result, "assoc")){
		?>
		<div class="element">
			<div class="element-heading">
				<span><?php echo $user["Name"]; ?></span>
			</div>
			<div class="element-content">
				<table>
					<thead>
						<tr>
							<th tabindex="0" rowspan="1" colspan="1" ><b><?php echo _t("role"); ?></b></th>
							<th tabindex="0" rowspan="1" colspan="1" ><?php echo _t("dexcription"); ?></th>
						</tr>
					</thead> 
					<tbody>
						<tr>
							<td tabindex="0" rowspan="1" colspan="1" ><?php echo _t($user["role"]); ?></td>
							<td tabindex="0" rowspan="1" colspan="1" ><?php echo $user["description"]; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</div>
</div>
</body>
</html>