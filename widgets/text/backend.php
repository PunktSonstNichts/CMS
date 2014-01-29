<style type="text/css">.preview-text{padding: 5px;-webkit-box-shadow: inset 0px 1px 2px rgba(200, 200, 200, 0.8);box-shadow: inset 0px 1px 2px rgba(200, 200, 200, 0.8);border: 1px solid rgb(200, 200, 200);font-weight: 200;color: rgb(85, 85, 85);border-radius: 2px;}</style><script type="text/javascript">$(document).ready( function(){	$(".selector-link").click( function(e){		e.preventDefault();		$(".post-element").fadeOut(1);		$($(this).attr("href")).fadeIn();	});	$(".preview-selector").click( function(e){		e.preventDefault();		var selection = getSelectionHtml();		$(".preview-text[data-postid=" + $(this).attr("data-postid") +"]").html(selection);		$(".preview-text-input[data-postid=" + $(this).attr("data-postid") +"]").val(selection);	});});// http://stackoverflow.com/questions/5643635/how-to-get-selected-html-text-with-javascriptfunction getSelectionHtml() {    var html = "";    if (typeof window.getSelection != "undefined") {        var sel = window.getSelection();        if (sel.rangeCount) {            var container = document.createElement("div");            for (var i = 0, len = sel.rangeCount; i < len; ++i) {                container.appendChild(sel.getRangeAt(i).cloneContents());            }            html = container.innerHTML;        }    } else if (typeof document.selection != "undefined") {        if (document.selection.type == "Text") {            html = document.selection.createRange().htmlText;        }    }    return html;}</script><?phpif(can_current_user("create_post")){?><div class="element"><div class="element-heading"><span><?php echo _t("create a new text");?></span></div><div class="element-content"><form><label for="post_title"><?php echo _t("title"); ?></label><input type="text" id="post_title" placeholder="<?php echo _t("title"); ?>"/></form></div></div><?php}?><div class="element"><div class="element-heading"><span><?php echo _t("manage old posts");?></span></div><div class="element-content"><?php$postsql = new mysql();$postresult = $postsql->query("SELECT * FROM  `".$postsql->dbprae."text_w`;");while($posts[] = $postsql->result($postresult, "assoc"));?><div id="change_post"><ul class="selector-list well"><?phpforeach($posts as $post){?>	<li class="selector-element">		<a href="#post-<?php echo $post["ID"]; ?>" data-target="post-<?php echo $post["ID"];?>" class="selector-link"><span class="selector-post"><?php echo $post["Heading"]; ?></span></a>		<span class="selector-path label-warning" ><?php echo $post["label"]; ?></span>	</li><?php}?></ul></div><div id="post_edit_field"><?phpforeach($posts as $key => $post){if($post != ""){?><div id="post-<?php echo $post["ID"];?>" class="post-element" <?php echo ($key != 0) ? "style='display: none;'" : '';?>>	<form method="post" data-type="update" action="<?php echo ROOT_URL."widgets/text/savepost.php";?>">		<input type="text" class="big" name="article-title" value="<?php echo $post["Heading"]; ?>" placeholder="<?php echo _t("title"); ?>"/>		<?php run_action("wysiwyg", array("type" => "normal", "value" => $post["content"])); ?>				<div class="select-preview">			<button class="preview-selector btn-primary" data-postID="<?php echo $post["ID"];?>"><?php echo _t("preview text"); ?></button>			<span class="preview-selector-hint" class="hint" style="font-size: 12px;"><?php echo _t("select a part of your text inside the editor and press this button. The selected text will be the preview text"); ?></span>			<input type="hidden" name="preview-text" data-postID="<?php echo $post["ID"];?>" id="preview-text-input" value="<?php echo htmlspecialchars($post["preview"]);?>"/>			<div class="preview-text" data-postID="<?php echo $post["ID"];?>"><?php echo $post["preview"]; ?></div>		</div>				<input type="text" name="keywords" value="<?php echo $post["keywords"]; ?>" placeholder="<?php echo _t("keywords"); ?>"/>				<select name="label">		<option>recommended</option>		<option>hot</option>		</select>		<input type="hidden" name="post_ID" value="<?php echo  $post["ID"]; ?>"/>		<input type="submit" value="<?php echo _t("update post"); ?>"/>	</form></div><?php}}?></div><form></form></div></div>