<?php
class body{

public $topelements = array();
public $topelements_string = "";
public $widgets = "";
private $site = "";
private $sqlresult_array_site = array();
private $sqlresult_array_widgets = array();
private $sqlresult_arraywidgets_settings = array();

	public function __construct($sqlsiteresult_row = "", $row_widgets, $widgets_settings){
		$this->sqlresult_array_site = $sqlsiteresult_row;
		$this->sqlresult_array_widgets = $row_widgets;
		$this->sqlresult_arraywidgets_settings = $widgets_settings;
	}

	public function __call($orientation, $fallback){
		foreach($this->sqlresult_array_widgets as $widget){
			if($widget["position"] == $orientation){
				if (file_exists("widgets/".$widget["widget"]."/frontend.php")){
					include("widgets/".$widget["widget"]."/frontend.php");
				}else{
					echo "<p class='error'><b>body.php:</b> widget '"."widgets/".$widget["widget"]."/frontend.php' nicht gefunden!</p>";
				}
			}
		}
	}
}
?>