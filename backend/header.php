<?php
class header{
public $meta = array();
public $metastring = "";
public $title = "";
private $site = "";
private $sitename = "";
private $dbprae = "";

	public function __construct($site = "", $sitename = "", $dbprae = ""){
		$this->site = $site;
		$this->sitename = $sitename; // used for title
		$this->dbprae = $dbprae;
		$this->getmeta();
		$this->gettitle();
		run_action("header-prepared", array("page-meta" => $this->meta, "page-title" => $this->title));
	}
	
	public function getmeta(){
		$metasql = new mysql();
		$metaresult = $metasql->query("SELECT  `key`, `value`, `not_affected` FROM `".$this->dbprae."globals` WHERE `type` = 'meta';");
		while ($row = $metasql->result($metaresult, "assoc")) {
			if($this->site != $row["not_affected"]){
				$name = htmlspecialchars($row["key"]);
				$content = htmlspecialchars($row["value"]);
				array_push($this->meta, "<meta name='$name' content='$content'>");				
				$this->metastring .= "<meta name='$name' content='$content'>\n";					
			}
		}
		unset($metasql);
	}
	
	public function seo(){
		
	}
	
	public function gettitle(){
		$titlesql = new mysql();
		$titleresult = $titlesql->query("SELECT  `key`, `value`, `not_affected` FROM `".$this->dbprae."globals` WHERE `type` = 'title';");
		$row = $titlesql->result($titleresult, "assoc");

		if($this->site != $row["not_affected"] && $this->site != "" && $row["not_affected"] != ""){
			return false;
		}else{
			$title = htmlspecialchars($row["value"]);
			$this->title = "<title>".$title." &raquo; ".$this->sitename."</title>";
		}
		unset($titlesql);
	}
}
?>