<?php
session_start();
include("../loader.php");
$title = htmlspecialchars($_POST["article-title"]);
$default_siteID = htmlspecialchars($_POST["default_siteID"]);
$default_siteNAME = htmlspecialchars($_POST["default_siteNAME"]);
$default_keywords = htmlspecialchars($_POST["default_keywords"]);

// ADD security checks here


$update_textdb = new mysql();
$metaresult = $update_textdb->query("INSERT INTO `cms_cms`.`text_w` (`ID`, `Heading`, `author`, `publishdate`, `lasteditdate`, `label`, `affected_pageID`, `affect_pageNAME`, `content`, `preview`, `keywords`) VALUES (NULL, '$title', '".$_SESSION["user"]["name"]."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', 'hot', '$default_siteID', '$default_siteNAME', '".$_POST["form_inhalt"]."', 'Leider noch keine Zeit für einen Vorschautext...', '$default_keywords');");
$response["error"] = "false";
$response["msg"] = "everything worked fine";

echo json_encode($response);
?>