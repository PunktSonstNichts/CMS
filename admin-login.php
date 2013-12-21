<?php
session_start();
include("loader.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript">
$(document).ready( function(){

$('form').submit(function(e){
	var form = $(this);
	e.preventDefault();
	$.ajax({
		type: $(this).attr("method"),
		url: $(this).attr("action"),
		data: $(this).serialize(),
		success: function(data){
			console.log(data);
			var obj = JSON.parse(data);
			if(obj.error == false){
				if(typeof $.fn.dialog !== "undefined"){
					$('div').dialog('success', obj.msg);
				}
				alert(obj.location);
				if(obj.location != ""){
					location.replace(obj.location);
				}else{
					form.children('input[type=text]').val("");
					form.find('div[contenteditable=true]').html("");		
				}
			}else{
				$('div').dialog('error', obj.msg);
			}
		}
	});
});


//Select button
$(".select-button").click( function(){
$(this).toggleClass("clicked");
});
});
</script>
<link rel="stylesheet" href="admin/scripte/css/main.css" type="text/css"/>
<style type="text/css">

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
<div id="notification" class=""><span></span></div>
<div id="login" style="width: 400px;">
	<div id="heading"><?php echo "CMS" ?> - Backend</div>
	<form action="<?php echo ROOT_URL."admin/login.backend.php";?>" method="post" name="loginform" style=" margin-left: 5px;">
	<div id="text">
			<div ><label class="label" for="username" ><?php _t("username");?></label></br><input type="text"     id="username"  name="username"  /></div>
			<div ><label class="label" for="userpassw"><?php _t("password");?></label></br><input type="password" id="userpassw" name="userpassw" /></div>
	</div>
	<div id="remindme" style="margin-top: 18px;"><input style="display: none;" type="checkbox" id="remindme_checkbox" name="remindme_checkbox"/><label for="remindme_checkbox" class="select-button"><div></div><span style="font-size: 0.9em;">Erinnere mich</span></label></div>
	<input type="submit" class="btn" style="margin-left: 50%;" value="Log In"/>
	</form>
	</div>	
</div>
</body>
</html>