<div class="snippet-box">
<?php
$snippet = new mysql();
$snippet_result = $snippet->query("SELECT * FROM `text_w` WHERE `affected_pageID` = ".$this->sqlresult_array_site["ID"].";");
while($snippet_arr[] = $snippet->result($snippet_result, "assoc"));

foreach($snippet_arr as $textsnippet){
if($textsnippet != ""){
?>
<div class="snippet" style="margin: 5px; display: block;">
<div class="snippet-heading" style="color: rgb(255, 145, 0); height: 60px"><h1><?php echo $textsnippet["Heading"]; ?></h1></div>
<div class="snippet-content" style="marign-top: 5px; border: 1px solid rgba(186, 186, 186, 0.1); background-color: white;">
<p>
<?php
echo $textsnippet["content"];
?>
</p>
</div>
<div class="snippet-author" style="float:left;"><small style="font-size: 0.8em; color: rgb(66,66,66);">by <?php echo $textsnippet["author"]; ?></small></div>
<div class="snippet-time" style="width: 100%; text-align: right;"><small style="font-size: 0.8em; color: rgb(66,66,66);">since <?php echo date_format(date_create($textsnippet["lasteditdate"]), 'd.m.y // H:i:s'); ?></small></div>
</div>
<?php
}
}
?>
</div>