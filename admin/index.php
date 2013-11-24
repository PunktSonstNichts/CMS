<?php
session_start();
define( 'PATH', dirname($_SERVER["PHP_SELF"]) );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript">
$(document).ready( function(){


$(".next").click( function(){
var error = false;
var data = [];
$(this).prev().children().children(".input").each( function(key, value){
if(typeof $(this).data("value") === 'undefined'){
var error = true;
console.log("error");
alert("error");
}else{
var key = $(this).attr("title");
var value = $(this).data("value");
alert(key);
data.push(key +"="+ value);
}

});
if(error == true){
alert("error");

}else{
alert(data);
var transmitted_data = data.join("&");
alert(transmitted_data);
$.ajax({
	url: "login.backend.php",
	type: "POST",		
	data: transmitted_data,

	success: function (answer_json){
	var answer = jQuery.parseJSON(answer_json);
	console.log(answer);
		if (answer.error == "false"){
			alert("alles gut!");
		//Wenn Passwort falsch, dann Ausgabe!
		} else{
			console.log(answer);
            $('#login_error').html(answer.message);
			$('#login_error').effect("shake", { times:1 }, 100);
			$('input').removeAttr('disabled');
			$('#login').val("");
        }
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

//Select button
$(".select-button").click( function(){
$(this).toggleClass("clicked");
toggle_view_input_trow_checkbox($(this));
});

function toggle_view_input_trow_checkbox(element){
if(element.hasClass("clicked")){

}else{

}
}
});
</script>
<style type="text/css">
*:focus {
	outline: 0;
}
input {
	white-space: nowrap;
	width: 240px;
	height: 28px;
	overflow: hidden;
	color: rgb(0, 100, 255);
	-webkit-box-shadow: inset 1px 1px 2px rgba(200, 200, 200, 0.8);
	box-shadow: inset 1px 1px 2px rgba(200, 200, 200, 0.8);
	border: 1px solid  rgb(200,200,200);
	font-weight: 200;
	font-size: 24px;
	background: -webkit-gradient(linear, left top, left bottom, from(rgb(255, 255, 255)), to(rgb(245, 245, 245)));
	background: -moz-linear-gradient(top, rgb(255, 255, 255), rgb(245, 245, 245));
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
#remindme{
margin: 5px;
float: left;
}
.select-button{
}
.select-button > div{
width: 15px;
height: 15px;
margin-right: 5px;
float: left;
border: 1px solid rgb(200,200,200);
background: rgba(230, 230, 230, 0.8);
background-image: -webkit-linear-gradient(rgba(220, 220, 220, 0.8) 0%, rgba(250, 250, 250, 0.8) 100%); 
background-image: -moz-linear-gradient(rgba(220, 220, 220, 0.8) 0%, rgba(250, 250, 250, 0.8) 100%); 
background-image: -o-linear-gradient(rgba(220, 220, 220, 0.8) 0%, rgba(250, 250, 250, 0.8) 100%); 
background-image: linear-gradient(rgba(220, 220, 220, 0.8) 0%, rgba(250, 250, 250, 0.8) 100%);
}
.select-button.clicked > div{
border: 1px solid  rgb(0, 100, 255);
background: rgba(0, 100, 255, 0.8);
background-image: -webkit-linear-gradient(rgba(50, 150, 255, 0.8) 0%, rgba(0, 75, 225, 0.8) 100%); 
background-image: -moz-linear-gradient(rgba(50, 150, 255, 0.8) 0%, rgba(0, 75, 225, 0.8) 100%); 
background-image: -o-linear-gradient(rgba(50, 150, 255, 0.8) 0%, rgba(0, 75, 225, 0.8) 100%); 
background-image: linear-gradient(rgba(50, 150, 255, 0.8) 0%, rgba(0, 75, 225, 0.8) 100%); 
}


#heading{
padding: 5px;
background: rgb(157,225,187);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(71,196,85)), to(rgb(51,176,65)));
border: 1px solid rgb(71,196,85);
margin-top: 5px;
margin-bottom: 5px;
height: 20px;
font-family: Verdana;
font-size: 1em;
text-align: center;
color: white;
}
#label{
font-size: 1.1em;
margin-right: 15px;
width: 150px;
}
#next{
margin-left: 5px;
margin-top: 5px;
width: 101.5px;
height: 20px;
cursor: pointer;
background: rgb(71,196,85);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(71,196,85)), to(rgb(51,176,65)));
font-family: Verdana;
text-align: center;
padding: 10px;
color: white;
  
transition: background 2s;
-moz-transition: background 2s; /* Firefox 4 */
-webkit-transition: background 2s; /* Safari and Chrome */
-o-transition: background 2s; /* Opera */
}
#next > span{
font-size: 1.2em;
display: block;
text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);

}

#next:hover{
background: rgb(51,176,65);
background: -webkit-gradient(radial, center center, 100, center center, 400, from(rgb(51,176,65)), to(rgb(71,196,85)));
}


#next:active{
box-shadow:inset 4px 4px 8px rgba(0, 0, 0, 0.25);
background: rgb(41,166,55);
background: -webkit-gradient(radial, center center, 100, center center, 400, from(rgb(41,166,55)), to(rgb(21,146,35)));
}
#label, .input{
margin-bottom: 5px;
}
#footer_container {
    position:fixed;
    bottom:0; left:0; right:0;
    text-align:center;
    margin:0;
    height:2em;
    z-index:3;
}

.footer {
    position:absolute;
    top:0; left:0; right:0; bottom:0;
    background:#efefef;
    z-index:3;
}
#login{
width: 250px;
z-index: 500;
background-color: rgba(255, 255, 255, 0.8);
margin: 25px auto;
padding-bottom: 5px;
	-webkit-box-shadow: 1px 1px 2px rgba(200, 200, 200, 0.8);
	box-shadow: 1px 1px 2px rgba(200, 200, 200, 0.8);
}
body{
font-family: 'Open Sans Condensed', sans-serif;
margin: 0;
background-color: rgb(247, 245, 241);
}
#notification{
margin: 15px auto;
width: 250px;
border: 1px solid;
padding: 5px;
color: rgb(255, 255, 255);
font-size: 1.1em;
margin-bottom: 5px;
	-webkit-box-shadow: 1px 1px 2px rgba(33, 33, 33, 0.8);
	box-shadow: 1px 1px 2px rgba(33, 33, 33, 0.8);
}
#notification > span{
text-shadow: rgb(33, 33, 33) 1px 1px 5px;
}
#notification.error{
background-color: rgb(223, 140, 144);
border-color: rgb(220, 10, 40);
}
#notification.success{
background-color: rgb(140, 223, 144);
border-color: rgb(0, 220, 0);
}
</style>
</head>
<body>
<div id="notification" class="<?php echo ($_SESSION['error'] ? 'error' : '')?>"><span><?php echo $_SESSION["error"]; ?></span></div>
<div id="login" style="width: 250px;">
	<div id="heading"><?php echo "CMS" ?> - Backend</div>
	<form action="<?php echo PATH."/login.backend.php"; ?>" method="post" name="loginform" style=" margin-left: 5px;">
	<div id="text">
			<div ><label class="label" for="username" >Username:</label></br><input type="text"     id="username"  name="username"  /></div>
			<div ><label class="label" for="userpassw">Password:</label></br><input type="password" id="userpassw" name="userpassw" /></div>
	</div>
	<div id="remindme" style="margin-top: 18px;"><input style="display: none;" type="checkbox" id="remindme_checkbox" name="remindme_checkbox"/><label for="remindme_checkbox" class="select-button"><div></div><span style="font-size: 0.9em;">Erinnere mich</span></label></div>
	<div id="next" style="margin-left: 50%;" onclick="document.loginform.submit()"><span>Log In</span></div>
	</form>
	</div>	
</div>
</body>
</html>