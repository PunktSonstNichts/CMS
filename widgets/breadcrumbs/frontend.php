<ol class="breadcrumb" style="margin-top: 5px; margin-bottom: 5px; margin-left: 5px;">
<?php
	$breadcrumb_sqlresult = explode("/", $this->sqlresult_array_site["visual_path"]);
	$breadcumb_elements = array();

	foreach($breadcrumb_sqlresult as $breadcrumb){
	list($link, $name) = explode("-", $breadcrumb);
		array_push($breadcumb_elements, "<li><a href='".ROOT_URL."$link'>$name</a></li>");
	}
	if($_GET["get"] != ""){
		array_push($breadcumb_elements, "<li title='this is a function, to remove it click on ($name)'><a href='".ROOT_URL.$_GET["site"]."/".$_GET["get"]."'>".$_GET["get"]."</a></li>");
	}
	if($_GET["mode"] != ""){
		array_push($breadcumb_elements, "<li title='this is a function, to remove it click on (".$_GET["get"].")'>".$_GET["mode"]."</li>");
	}
	
	foreach($this->sqlresult_arraywidgets_settings as $widget_setting){
	if($widget_setting["widget"] == "Breadcrumb"){
		$breadcrumb_devider = " ".$widget_setting["value"]." ";
	}
	}
	
	$breadcrumbs = implode( $breadcrumb_devider, $breadcumb_elements);
	
	if(DEVELOPMODE == true && $orientation != "top"){
		echo _t('breadcrumb widget have to be assigned to the orientation "top"!');
	}else{
		echo sprintf( _t('You are here: %s'), $breadcrumbs);
	}
?>
</ol>