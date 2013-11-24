<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready( function(){
$(".input").click( function(){
	$(this).children(".placeholder").remove();
}).blur(function(){
	if($(this).html() == ""){
		var placeholder = $(this).attr("title");
		$(this).html("<span class='placeholder'>" + placeholder + "</span>");		
	}else{
		$(this).data("value",$(this).html());
	}
	$(this).children(".placeholder").show();
});

$(".next").click( function(){
var error = false;
var data = [];
var action = $(this).parent().attr("id");
$(this).parent().parent().removeClass("active");
$(this).parent().children(".input").each( function(){
var key = $(this).attr("id");
var value = $(this).val();
data.push(key +"="+ value);
console.log(key +"="+ value);

});
if(error = true){


}else{
var values = data.join("&");
$.ajax({
	url: "backend.php",
	type: "POST",		
	data: "action=" + action + "&" + values,

	success: function (answer_json){
		var answer = jQuery.parseJSON(answer_json);
	}
});

}
});

$(".finished").click( function(){
$(this).children(".form_content").show();
$(".active").click( function(){
$(this).children(".form_content").show();
$(".finished").children(".form_content").hide();
}).children(".form_content").hide();
});
$(".select-button").click( function(){
$(this).toggleClass("clicked");
toggle_view_input_trow_checkbox($(this));
});

function toggle_view_input_trow_checkbox(element){
if(element.hasClass("clicked")){
element.children("span").hide();
element.next(".input").show();
}else{
element.children("span").show();
element.next(".input").hide();
}
}

$(".finished, .todo").delay(800).animate({"width": "60%", marginLeft: "20%"}, 750).children(".form_content").hide();
$(".active").delay(900).animate({"width": "80%", marginLeft: "10%"}, 650);
});
</script>
<style type="text/css">
*:focus {
	outline: 0;
}
input {
	white-space: nowrap;
	width:200px;
	overflow: hidden;
	color: rgb(0, 100, 255);
	-moz-box-shadow:    inset 0 0 3px rgb(0,0,0);
	-webkit-box-shadow: inset 0 0 3px rgb(0,0,0);
	box-shadow:         inset 0 0 3px rgb(0,0,0);
	border: 1px solid  rgb(50,50,50);
	border-radius: 2px;
}
input:focus{
	-moz-box-shadow:    0 0 3px rgb(0, 150, 240);
	-webkit-box-shadow: 0 0 3px rgb(0, 150, 240);
	box-shadow:         0 0 3px rgb(0, 150, 240);
	border: 1px solid  rgb(0, 100, 255);
}
input br {
	display:none;
}
input * {
	display:inline;
	white-space:nowrap;
}
.placeholder{
color: rgb(103,103, 103);
backrgound-color: rgba(0, 125, 242, 0.8);
}
.select-button{
}
.select-button > div{
width: 20px;
height: 20px;
margin-right: 5px;
float: left;
border-radius: 4px;
border: 1px solid black;
background: rgba(230, 230, 230, 0.8);
background-image: -webkit-linear-gradient(rgba(200, 200, 200, 0.8) 0%, rgba(250, 250, 250, 0.8) 100%); 
background-image: -moz-linear-gradient(rgba(200, 200, 200, 0.8) 0%, rgba(250, 250, 250, 0.8) 100%); 
background-image: -o-linear-gradient(rgba(200, 200, 200, 0.8) 0%, rgba(250, 250, 250, 0.8) 100%); 
background-image: linear-gradient(rgba(200, 200, 200, 0.8) 0%, rgba(250, 250, 250, 0.8) 100%);
}
.select-button.clicked > div{
border: 1px solid  rgb(0, 100, 255);
background: rgba(0, 100, 255, 0.8);
background-image: -webkit-linear-gradient(rgba(50, 150, 255, 0.8) 0%, rgba(0, 75, 225, 0.8) 100%); 
background-image: -moz-linear-gradient(rgba(50, 150, 255, 0.8) 0%, rgba(0, 75, 225, 0.8) 100%); 
background-image: -o-linear-gradient(rgba(50, 150, 255, 0.8) 0%, rgba(0, 75, 225, 0.8) 100%); 
background-image: linear-gradient(rgba(50, 150, 255, 0.8) 0%, rgba(0, 75, 225, 0.8) 100%); 
}


.finished{
background-color: rgb(247,255,247);
border: 1px solid rgb(120,245,131);
padding: 5px;
border-radius: 5px;
}
.finished > .heading{
background: rgb(71,196,85);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(71,196,85)), to(rgb(51,176,65)));
border: 2px solid rgb(71,196,85);
}
.active{
background-color: rgb(245, 245, 255);
border: 1px solid rgb(120, 175, 245);
padding: 5px;
border-radius: 5px;
}
.active > .heading{
background: rgb(0, 125, 242);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(0, 125, 242)), to(rgb(0, 105, 232)));
border: 2px solid rgb(20, 145, 255);
}
.todo > .heading{
background: rgb(103, 103, 103);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(190, 190, 190)), to(rgb(175, 175, 175)));
border: 2px solid rgb(150, 150, 150);
}
.heading{
color: rgb(103,103,103);
padding: 5px;
border-radius: 4px;
margin-left: 5px;
margin-top: 5px;
margin-bottom: 5px;
height: 20px;
cursor: pointer;
font-family: Verdana;
font-size: 1em;
text-align: center;
padding: 5px;
color: white;
}
.label{
float: left;
font-size: 1.1em;
margin-right: 15px;
width: 150px;
}
.next{
border-radius: 4px;
margin-left: 5px;
margin-top: 5px;
width: 100px;
height: 20px;
cursor: pointer;
background: rgb(71,196,85);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(71,196,85)), to(rgb(51,176,65)));
font-family: Verdana;
text-align: center;
padding: 5px;
color: white;
border: 2px solid rgb(71,196,85);
  
transition: background 2s;
-moz-transition: background 2s; /* Firefox 4 */
-webkit-transition: background 2s; /* Safari and Chrome */
-o-transition: background 2s; /* Opera */
}
.next > span{
font-size: 1.2em;
display: block;
margin-top: 1px;
text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);

}

.next:hover{
background: rgb(51,176,65);
background: -webkit-gradient(radial, center center, 100, center center, 400, from(rgb(51,176,65)), to(rgb(71,196,85)));
}


.next:active{
background: rgb(41,166,55);
background: -webkit-gradient(radial, center center, 100, center center, 400, from(rgb(41,166,55)), to(rgb(21,146,35)));
}
.label, .input{
margin-bottom: 5px;
}
</style>
</head>
<body>

<div id="heading">
Your grandious CMS-System
</div>
<div id="carousel">
	<div id="step1" class="step finished">
		<div class="heading"><span>Allgemeine Einstellungen</span><div class="response_logo"></div></div>
		<div class="form_content" id="init">
			<label class="label" for="lang">Language</label><input title="German" id="lang" class="input" placeholder="German"/></br>
			<label class="label" for="path">Path</label>    <input title="/" id="path" class="input" placeholder="/"/></br>
		</div>
	</div>
	<div id="step2" class="step active">
		<div class="heading"><span>Database</span><div class="response_logo"></div></div>
		<div class="form_content" id="db">
			<label class="label" for="db_host">Database Host</label>    <input title="localhost" id="db_host" class="input" placeholder="localhost"/></br>
			<label class="label" for="db_user">Database User</label>    <input title="root" id="db_user" class="input" placeholder="root"/></br>
			<label class="label" for="db_passw">Database Password</label><div class="select-button"><div></div><span>Use Password</span></div><input title="123321" style="width: 173px; display:none;" id="db_passw" class="input" placeholder="123321"/></br>
			<div class="next"><span>Next Step</span></div>
		</div>
	</div>
	<div id="step3" class="step todo">
		<div class="heading"><span>Name</span><div class="response_logo"></div></div>
		<div class="form_content" id="name">
		<label class="label" for="websitename">Website Name</label><input title="//Blog" id="websitename" class="input" placeholder="//Blog"/>
		<div class="next"><span>Next Step</span></div>
		</div>
	</div>
	<div id="step4" class="step todo">
		<div class="heading"><span>User</span><div class="response_logo"></div></div>

	</div>
</body>