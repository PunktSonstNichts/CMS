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
	/*
	2 fallbacks are implemented, one database-side and one template-side:
	
	#server-side->   a colloum "fallback_position", with get checked the same the orientation gets checked
	#template-side-> if no widget is found with the orientation, the transmitted parameter is the fallback, secound foreach-loop
	*/
	
	
		$widget_found = false;
		$passed_widget_names = array();
		
		foreach($this->sqlresult_array_widgets as $widget){
			if($widget != ""){
				if(($widget["position"] == $orientation) || (($widget["fallback_position"] == $orientation) && (array_search($widget["widget"], $passed_widget_names) === false))){
					if (file_exists("widgets/".$widget["widget"]."/frontend.php")){					
						$passed_widget_names[] = $widget["widget"];
						print_r($passed_widget_names);
					
						if((array_search($widget["widget"], $passed_widget_names) === true)){
							if(DEVELOPMODE){
								echo '<p class="error"><b>body.php:</b> '.sprintf( _t("widget '%s' already called!"), $widget["widget"]).'</p>';
							}
						}else{
							include("widgets/".$widget["widget"]."/frontend.php");						
						}
						$widget_found = true;
					}else{
						if(DEVELOPMODE){
							echo '<p class="error"><b>body.php:</b> '.sprintf( _t("widget %s not found!"), "'widgets/".$widget["widget"]."/frontend.php'").'</p>';
						}
						//Add error log here
					}
				}
			}
		}
		//fallback
		if($widget_found == false){
		$fallback = $fallback[0]; // silly fallback bug on magic __call function
			foreach($this->sqlresult_array_widgets as $widget){
				if($widget != ""){
					if(($widget["position"] == $fallback) || ($widget["fallback_position"] == $fallback)){
						if (file_exists("widgets/".$widget["widget"]."/frontend.php")){
							include("widgets/".$widget["widget"]."/frontend.php");
							$widget_found = true;
						}else{
							if(DEVELOPMODE){
								echo '<p class="error"><b>body.php:</b> '.sprintf( _t("widget %s not found!"), "'widgets/".$widget["widget"]."/frontend.php'").'</p>';
							}
							//Add error log here
						}
					}
				}
			}
		}
		if($widget_found == false){
			if(DEVELOPMODE){
				echo sprintf( _t('<p class="error"><b>body.php:</b> no widget found for %1$s or %2$s!</p>'), $orientation, $fallback );
			}
			//Add error log here
		}
	}
}
?>