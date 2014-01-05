<?php
session_start();
include("../loader.php");
$title = htmlspecialchars($_POST["article-title"]);
$default_siteID = htmlspecialchars($_POST["default_siteID"]);
$default_siteNAME = htmlspecialchars($_POST["default_siteNAME"]);
$default_keywords = htmlspecialchars($_POST["default_keywords"]);

// ADD security checks here
if($title == ""){
	$response["error"] = true;
	$response["msg"] = _t("no title selected");
}elseif($default_siteID == "" || $default_siteNAME == ""){
	$response["error"] = true;
	$response["msg"] = _t("no linked site to article");
}elseif($_SESSION["user"]["name"] == ""){
	$response["error"] = true;
	$response["msg"] = _t("you stayed too long inactiv");
}else{

$update_textdb = new mysql();
$metaresult = $update_textdb->query("INSERT INTO `cms_cms`.`text_w` (`ID`, `Heading`, `author`, `publishdate`, `lasteditdate`, `label`, `affected_pageID`, `affect_pageNAME`, `content`, `preview`, `keywords`) VALUES (NULL, '$title', '".$_SESSION["user"]["name"]."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', 'hot', '$default_siteID', '$default_siteNAME', '".$_POST["form_inhalt"]."', 'no time for a preview text :(', '$default_keywords');");
echo "INSERT INTO `cms_cms`.`text_w` (`ID`, `Heading`, `author`, `publishdate`, `lasteditdate`, `label`, `affected_pageID`, `affect_pageNAME`, `content`, `preview`, `keywords`) VALUES (NULL, '$title', '".$_SESSION["user"]["name"]."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', 'hot', '$default_siteID', '$default_siteNAME', `".$_POST["form_inhalt"]."`, 'no time for a preview text :(', '$default_keywords');";
$response["error"] = false;
$response["msg"] = _t("everything worked fine");
}
echo json_encode($response);
?>