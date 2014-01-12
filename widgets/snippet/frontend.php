<div class="snippet-box" style="height: 710px;">
<?php
$snippet = new mysql();
$snippet_result = $snippet->query("SELECT * FROM `text_w`;");
while($snippet_arr[] = $snippet->result($snippet_result, "assoc"));

foreach($snippet_arr as $key => $textsnippet){
if($textsnippet != ""){
?>
<div class="snippet" style="width: 270px; height: 350px; overflow: hidden; float: left; margin: 5px; display: block;">
<div class="snippet-heading" style="color: rgb(255, 145, 0); height: 60px"><h1><?php echo $textsnippet["Heading"]; ?></h1></div>
<div class="snippet-smline" style="width: 100%; height: 20px;">
	<div class="snippet-author" style="float: left;"><small style="font-size: 0.8em; color: rgb(66,66,66);">by <?php echo $textsnippet["author"]; ?></small></div>
	<div class="snippet-label" style="float: right;"><small style="font-size: 0.8em; color: rgb(66,66,66);">
	<?php
	if($textsnippet["label"] == "new"){
	?>
	<span class="label label-primary"><?php _t("new"); ?></span>
	<?php
	}elseif($textsnippet["label"] == "recommended"){
	?>
	<span class="label label-success"><?php _t("recommended"); ?></span>
	<?php
	}elseif($textsnippet["label"] == "hot"){
	?>
	<span class="label label-danger"><?php _t("hot"); ?></span>
	<?php
	}
	?>
	</small></div>
</div>
<div class="snippet-content" style="marign-top: 5px; border: 1px solid rgba(166, 166, 166, 0.4); background-color: white;">
<p>
<?php
echo $textsnippet["content"];
?>
...
</p>
<div class="snippet-seemore btn btn-link"><a href="<?php echo ROOT_URL.$textsnippet["affected_pageNAME"]; ?>"><?php echo sprintf(_t("Read article on %s"), $textsnippet["affected_pageNAME"]); ?></a></div>
</div>
</div>
<?php
}
}
?>
</div>