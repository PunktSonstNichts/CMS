<?phpif(can_current_user("comment_box_manage")){?><form action="" method="post"><label for="max_result"><?php echo _t("max. comments by page");?></label><input type="text" id="max_result" placeholder="<?php echo _t("max. comments by page");?>"/></form><?php}else{echo _t("Cheatin, uh?");}?>