<div class="well" style="text-align: left;">	<h3 style="text-align: center;">Recommended</h3>	<p>CMS // Blog is the number 1 for good textes combinded with design: <a href="blog">Blog</a></p>	<p>Hakuna Matata; or the life of monkeys in natural habbits: <a href="blog">Life of Monkeys</a></p></div><div class="well" style="text-align: left;">	<h3 style="text-align: center;">Our Publisher</h3>	<?php	$user_sql = "SELECT ID, Name, role, active_Q0 FROM `".$dbprae."users`;";	$user_c = new mysql();	$user_result = $user_c->query($user_sql);	while($user = $user_c->result($user_result, "assoc")){	?>	<p>	<?php	switch($user["role"]){	case "":	break;	case "admin":	?>	<a href="<?php echo ROOT_URL."user/".$user["Name"]; ?>"><?php echo $user["Name"]; ?></a> | <span class="label label-danger"><?php echo _t("admin"); ?></span>	<?php	break;	case "moderator":	?>	<a href="<?php echo ROOT_URL."user/".$user["Name"]; ?>"><?php echo $user["Name"]; ?></a> | <span class="label label-warning"><?php echo _t("moderator"); ?></span>	<?php		break;	case "designer":	?>	<a href="<?php echo ROOT_URL."user/".$user["Name"]; ?>"><?php echo $user["Name"]; ?></a> | <span class="label label-success"><?php echo _t("designer"); ?></span>	<?php		break;	case "content manager":	default:	?>	<a href="<?php echo ROOT_URL."user/".$user["Name"]; ?>"><?php echo $user["Name"]; ?></a> | <span class="label label-primary"><?php echo _t("content manager"); ?></span>	<?php		break;	}	?>	</p>	<?php	}	?></div><?phpif(TEMPLATE == "bootstrap"){?><div class="well" style="text-align: left;">	<h3 style="text-align: center;">CMS | Bootstrap</h3>	<p>Do you like that bootstrap theme? We have this and many other <b>for free</b>!</p>	<p><a class="btn btn-success btn-medium" href="http://templateworld123.funpic.de" target="_blank">Visit tdesk.com</a></p></div><?php}?>