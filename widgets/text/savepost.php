<?php
session_start();
include("../../loader.php");


$title = (isset($_POST["article-title"])) ? htmlspecialchars($_POST["article-title"]) : "";
$post_ID = (isset($_POST["post_ID"])) ? htmlspecialchars($_POST["post_ID"]) : "";
$keywords = (isset($_POST["keywords"])) ? htmlspecialchars($_POST["keywords"]) : "";
$content = (isset($_POST["wysiwyg_content"])) ? $_POST["wysiwyg_content"] : "";
$preview = (isset($_POST["preview-text"])) ? $_POST["preview-text"] : "";
$label = (isset($_POST["label"])) ? htmlspecialchars($_POST["label"]) : "";

// ADD security checks here
if($title == ""){
	$response["error"] = true;
	$response["msg"] = _t("no title selected");
}elseif($content == ""){
	$response["error"] = true;
	$response["msg"] = _t("a post without content is not possible");
}elseif($post_ID == ""){
	$response["error"] = true;
	$response["msg"] = _t("no linked site to article");
}elseif($_SESSION["user"] == ""){
	$response["error"] = true;
	$response["msg"] = _t("you stayed too long inactiv");
}elseif(!can_current_user("publish_post")){
	$response["error"] = true;
	$response["msg"] = _t("you don't have the rights to publish posts. The post will get saved as a draft.");
	//save as draft
}else{
	$update_textdb = new mysql();
	$metaresult = $update_textdb->query("UPDATE `".$update_textdb->dbprae."text_w`  SET Heading = '$title', lasteditdate = '".date("Y-m-d H:i:s")."', label = '$label', content = '$content', preview = '$preview', keywords = '$keywords' WHERE ID = '$post_ID';");

	$response["error"] = false;
	$response["msg"] = _t("everything worked fine");
}
echo json_encode($response);
?>