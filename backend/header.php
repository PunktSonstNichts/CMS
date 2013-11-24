<?php
class header{
public $meta = array();
public $metastring = "";
public $title = "";
private $site = "";
private $dbprae = "";

	public function __construct($site = "", $dbprae = ""){
		$this->getmeta();
		$this->gettitle();
		$this->site = $site;
		$this->dbprae = $dbprae;
	}
	
	public function getmeta(){
		$metasql = new mysql();
		$metaresult = $metasql->query("SELECT  `key`, `value`, `not_affected` FROM `".$this->dbprae."globals` WHERE `type` = 'meta';");
		while ($row = $metasql->result($metaresult, "assoc")) {
			if($this->site != $row["not_affected"] && $this->site != "" && $row["not_affected"] != ""){
			
			}else{
				$name = htmlspecialchars($row["key"]);
				$content = htmlspecialchars($row["value"]);
				array_push($this->meta, "<meta name='$name' content='$content'>");				
				$this->metastring =  $this->metastring."<meta name='$name' content='$content'>\n";				
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
			$this->title = "<title>".$title."</title>";
		}
		unset($titlesql);
	}
}
?>