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
		$widget_found = false;
		foreach($this->sqlresult_array_widgets as $widget){
			if($widget != ""){
				$widget_name = $widget["widget"];
				if($widget["position"] == $orientation){
					if (file_exists("widgets/".$widget["widget"]."/frontend.php")){
						include("widgets/".$widget["widget"]."/frontend.php");
						$widget_found = true;
					}else{
						echo "<p class='error'><b>body.php:</b> widget 'widgets/".$widget_name."/frontend.php' nicht gefunden!</p>";
					}
				}
			}
		}
		if($widget_found == false){
			foreach($this->sqlresult_array_widgets as $widget){
				if($widget != ""){
				$widget_name = $widget["widget"];
					if($widget["position"] == $fallback){
						if (file_exists("widgets/".$widget["widget"]."/frontend.php")){
							include("widgets/".$widget["widget"]."/frontend.php");
							$widget_found = true;
						}else{
							print_r($widget);
							echo "<p class='error'><b>body.php:</b> widget 'widgets/".$widget_name."/frontend.php' nicht gefunden!</p>";
						}
					}
				}
			}
		}
	}
}
?>