<?php
function get_image($src = "", $size = "1240X720"){
	if(is_array($size)){
		@list($x, $y) = $size;
	}
	if(@!$y){
		@list($x, $y) = array_pad( explode("x", $size), 2, '' );
		if(!$y){
			@list($x, $y) = array_pad( explode("X", $size), 2, '' );
		}
		if(!$y){
			switch($size){
				case "thumbnail":
					$x = 50;
					$y = 50;
					break;
				case "background":
					$x = 1980;
					$y = 1080;
					break;
				default:
					return "error";
					break;
			}
		}
	}
if($src){
$type = pathinfo($src, PATHINFO_EXTENSION);
$data = file_get_contents($src);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
}
return($y);
}
//print_r(get_image());
?>