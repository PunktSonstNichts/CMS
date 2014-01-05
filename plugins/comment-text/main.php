<?php
$widget_path = "comment-text/";
$cms_type = "plugin";


function get_comments( $text_id, $text_title ){

global $widget_path;
global $cms_type;

if(!isset($commentboxcounter)){
$commentboxcounter = 0;
}
$titleinput_id = "commentbox-title-$commentboxcounter";
$contentinput_id = "commentbox-content-$commentboxcounter";
?>
<div class='commentbox well' style="padding-top: 15px;">
<div class="commentbox comment-heading">Comment-Box</div>
<button class="commentbox comment-toggleview btn btn-primary"><?php echo _t("read comments", $widget_path, $cms_type); ?></button>
<div class="commentbox comment-body">
<?php
$count = 0;
while($count < 2){
?>
<hr>
<div class='commentbox comment'>
	<div class='commentbox comment-author'>PunktSonstNichts</div>
	<div class='commentbox comment-content well'>
	<p class="commentbox comment-content-text">
	Lorem Ipsum dolor sit amet, consquetetur
	</p>
		<div class='commentbox commentbox-actionbar'>
			<div class="commentbox-likes-div">
				<span class="label label-warning commentbox-likes"><?php echo sprintf(_t("%d likes", $widget_path, $cms_type), 45); ?></span>
			</div>
			<div class="commentbox-actions">
				<span class="label label-info comment-quote" data-target="<?php echo $contentinput_id; ?>"><?php echo _t("quote", $widget_path, $cms_type); ?></span>
				<span class="label label-success"><?php echo _t("like", $widget_path, $cms_type); ?></span>
				<span class="label label-danger"><?php echo _t("report", $widget_path, $cms_type); ?></span>
			</div>
		</div>
	</div>
</div>

<?php
$count++;
}
?>
<hr>
<div class="commentbox leave-comment">

<form method="post" class="form-horizontal" role="form">
  <div class="form-group">
	<div class="col-sm-2"></div>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo sprintf(_t("Add Comment to %s", $widget_path, $cms_type), "<a href='#'>".$text_title."</a>"); ?></p>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo $titleinput_id; ?>" class="col-sm-2 control-label"><?php echo _t("title", $widget_path, $cms_type); ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control commentbox-titleinput" id="<?php echo $titleinput_id; ?>"  placeholder="<?php echo _t("title", $widget_path, $cms_type); ?>"/>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo $contentinput_id; ?>" class="col-sm-2 control-label"><?php echo _t("content", $widget_path, $cms_type); ?></label>
    <div class="col-sm-10">
      <div contenteditable="true" id="<?php echo $contentinput_id; ?>" class="form-control" rows="3" maxRows="5" maxChars="256" wrap="virtual"></div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <input type="submit" class="btn btn-info" value="<?php echo _t("comment!", $widget_path, $cms_type); ?>"/>
    </div>
  </div>

</form>
</div>
</div>
</div>

<?php
$commentboxcounter++;
}

function add_commentbox_css(){
?>
textarea {
resize: none;
}
.commentbox{
position: relative;
clear: both;
font-size: 1em;
}
.commentbox.comment-body{
display: none;
}

.commentbox.leave-comment-header{
margin: 15px;
font-size: 12px;
font-weight: bold;
color: rgb(87, 87, 87);
text-transform: uppercase;
letter-spacing: 1px;
}
.commentbox.comment-content{
background-color: rgb(252, 253, 252);
padding-top: 5px !important;
padding-bottom: 15px !important;
}

.commentbox > .commentbox.comment-heading{
border-radius: 2px;
font-weight: bold;
text-transform: uppercase;
letter-spacing: 1px;
}
.commentbox-titleinput{
margin-bottom: 10px;
}
.comment-toggleview{
float: right;
margin-top: -25px;
}

.commentbox-actionbar{
padding-top: 5px;
border-top: 1px solid rgb(227, 227, 227);
clear: both;
height: 18px;
}
.commentbox-likes-div{
float: left;
margin-top: 6px;
}
.commentbox-actions{
float: right;
}
<?php
}
function add_commentbox_js(){
?>
if (typeof jQuery == 'undefined') {
var script = document.createElement('script');
script.src = 'http://code.jquery.com/jquery-latest.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);
}

$(document).ready( function(){
	$(".comment-body").attr("data-is_commentbox_visible", false);
	$(".comment-toggleview").click(function() {
		if($(this).next(".comment-body").attr("data-is_commentbox_visible") == "true"){
			$(this).next(".comment-body").fadeOut( "fast" );
			$(this).next(".comment-body").attr("data-is_commentbox_visible", false);
		}else{
			$(this).next(".comment-body").fadeIn( "fast" );
			$(this).next(".comment-body").attr("data-is_commentbox_visible", true);
		}
	});
	
	$(".comment-quote").click( function(){
	$this = $(this).parents().parents().parents().children(".comment-content-text");
	$( "#" + $(this).attr("data-target")).html($this.html()).focus();
	});
});
<?php
}

add_action('after-text-loaded', 'get_comments', array("transferred-keys" => array("text-id", "text-title")));
add_action('css-loading', 'add_commentbox_css');
add_action('js-loading', 'add_commentbox_js');
?>