<?php
if(!ROOT){
exit;
}

#init of the widget
$widget_path = "breadcrumbs/";
$cms_type = "widget";

global $breadcrumb_already_called; // Additional, can removed (hopefully)
?>
<ol class="breadcrumb" style="margin-top: 5px; margin-bottom: 5px; margin-left: 5px;">
<?php
	if($breadcrumb_already_called == true){
		echo  _t("breadcrumb widget should only get called once", $widget_path, $cms_type);
	}else{
		$breadcrumb_already_called = true;
		
		$breadcrumb_sqlresult = explode("/", $this->sqlresult_array_site["visual_path"]);
		$breadcumb_elements = array();

		foreach($breadcrumb_sqlresult as $breadcrumb){
		list($link, $name) = explode("-", $breadcrumb);
			array_push($breadcumb_elements, "<li><a href='".ROOT_URL."$link'>$name</a></li>");
		}
		if($_GET["get"] != ""){
			array_push($breadcumb_elements, "<li title='".sprintf(_t("this is a function, to remove it click on (%s)", $widget_path, $cms_type), $name)."'><a href='".ROOT_URL.$name."/".$_GET["get"]."'>".$_GET["get"]."</a></li>");
		}
		if($_GET["mode"] != ""){
			array_push($breadcumb_elements, "<li title='".sprintf(_t("this is a function, to remove it click on (%s)", $widget_path, $cms_type), $_GET["get"])."'>".$_GET["mode"]."</li>");
		}
		
		foreach($this->sqlresult_arraywidgets_settings as $widget_setting){
		if($widget_setting["widget"] == "Breadcrumb"){
			$breadcrumb_devider = " ".$widget_setting["value"]." ";
		}
		}
		
		$breadcrumbs = implode( $breadcrumb_devider, $breadcumb_elements);
		
		if(DEVELOPMODE == true && ($orientation != "top" )){
			echo  sprintf( _t("breadcrumb widget should be assigned to the orientation 'top', not %s!", $widget_path, $cms_type), $orientation);
		}else{
			echo sprintf( _t('You are here: %s', $widget_path, $cms_type), $breadcrumbs);
		}
	}
?>
</ol>