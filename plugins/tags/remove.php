<?php
$tag_sql = new mysql();
$tag_sql->result($tag_sql->query("ALTER TABLE `".$tag_sql->dbprae."text_w` DROP tag;"));
?>