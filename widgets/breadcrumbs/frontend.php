<?php
	$breadcrumb_sqlresult = explode("/", $this->sqlresult_array_site["visual_path"]);
	$breadcumb_elements = array();

	foreach($breadcrumb_sqlresult as $breadcrumb){
	list($link, $name) = explode("-", $breadcrumb);
		array_push($breadcumb_elements, "<li><a href='$link'>$name</a></li>");
	}
	if($_GET["get"] != ""){
		array_push($breadcumb_elements, "<li><a href='".$_GET["get"]."'>".$_GET["get"]."</a></li>");
	}
	
	foreach($this->sqlresult_arraywidgets_settings as $widget_setting){
	if($widget_setting["widget"] == "Breadcrumb"){
		$breadcrumb_devider = " ".$widget_setting["value"]." ";
	}
	}
	
	$breadcrumbs = implode( $breadcrumb_devider, $breadcumb_elements);
	echo '<ol class="breadcrumb" style="margin-top: 5px; margin-bottom: 5px; margin-left: 5px;">You are here:  '.$breadcrumbs.'</ol>';
?>
