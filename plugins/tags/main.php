<?php
function add_tag($tag_name = "", $label = "success"){
	if($tag_name != ""){
		$tag_sql = new mysql();
		$tag_sql->result($tag_sql->query("INSERT INTO `".$tag_sql->dbprae."taglist_p` (`tagname`, `taglabel`) VALUES ('$tag_name', '$label');"));
	}else{
		return _t("no tag name given");
	}
}

function install_tags_plugin(){
	$tag_sql = new mysql();
	$tag_sql->result($tag_sql->query("CREATE TABLE IF NOT EXISTS `".$tag_sql->dbprae."taglist_p` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(64) NOT NULL,
  `taglabel` varchar(64) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;"));
	$tag_sql->result($tag_sql->query("INSERT INTO `".$tag_sql->dbprae."taglist_p` (`ID`, `tagname`, `taglabel`) VALUES
(1, 'new', 'success'),(2, 'hot', 'danger');"));

}

function add_tag_to_table($tablename = ""){
	$tag_sql = new mysql();
	$tag_sql->result($tag_sql->query("ALTER TABLE `".$tag_sql->dbprae.$tablename."` ADD tag VARCHAR(120);"));
}

function read_element_tag($element_id){
$tag_sql = new mysql();
$tag_res = $tag_sql->query("SELECT * FROM `".$tag_sql->dbprae."` WEHRE"); //unfinished
while($tags[] = $tag_sql->result($tag_res, "assoc"));
}

function tag_admin_css(){
?>
.tag-selector-element{
margin: 5px;
float: left;
display: inline-block;
}
<?php
}
add_action("admin-css", "tag_admin_css");

function read_all_tags(){
	$tag_sql = new mysql();
	$tag_query = $tag_sql->query(" SELECT * FROM `".$tag_sql->dbprae."taglist_p`;");
	while( $tags[] = $tag_sql->result($tag_query, "assoc"));
	return $tags;
}
?>