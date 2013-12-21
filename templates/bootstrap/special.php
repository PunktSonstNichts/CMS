<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<?php echo $header->title; ?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-5589-1">
<?php echo $header->metastring; ?>
<link rel="stylesheet" href="<?php echo ROOT;?>templates/bootstrap/scripte/css/bootstrap.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<style type="text/css">
h1{
font-size: 24px !important;
}
.breadcrumb>li+li:before {
padding: 0 !important;
content: "" !important;
}
</style>
</head>
<body>
<div class="container">
<div class="header">
	<?php $body->navigation("top"); ?>
</div>
<hr>
</div>
<div class="container">
  <?php $body->top();  ?>
  <hr>
<div class="row row-offcanvas row-offcanvas-right active">
  <div class="col-xs-12 col-sm-9">
	<h3 style="text-align: center;"><b>Never went to germany?</b></h3>
	<h4 style="text-align: center;">Then start discovering cool cities and captivating landscapes today!</h4>
	<img src="http://<?php echo ROOT; ?>content/images/wrapper_DE.jpg" width="848px" style="border: 1px solid rgb(170, 170, 170); border-radius: 5px;-webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);"/>
	<p style="color: rgb(98,100,95); float:left;">01.12.2013 // Till Meyer-Arlt</p>
	<p style="text-align: right;"><small><a target="_blank" href="http://de.best-wallpaper.net/Beautiful-scenery-in-Germany_2560x1440.html">http://de.best-wallpaper.net/Germany.html</a></small></p></br>
	<p style="line-height: 21px;">
	<?php print_r($_GET);  ?>
	
	Germany is the perfect destination for people who like to explore many different traditions in a short amount of time due to the fact that the german highways are the best worldwide.
	Not only the highway but also the comfortable trains enable the traveller to visit one day Hamburg with its unique red-light district and to drink beer at the "Wiesn" in Munich the next day.
	Besides Hamburg and Munich many other cities have there specialty mostly in downtown, for examples hannover is known for it big forrest and other natural areas like the Maschsee in town.</br>
	Germany's big cities are just waiting to get discovered. To dive into them you don't need to buy expansive guides: English is widely spoken through Germany and our country is known as very visitor-friendly. 
	Many people are open to show tourists the special trendy district. Not only for explorer Germany is the best choice, adrenalin-junkies can drive on the Autobahn, Snowboarder can drive down the mountains in the Alps and families can drive to all the theme parks Germany can offer.</br>	
	</p>
  </div>
	<div class="col-xs-6 col-sm-3 sidebar-offcanvas">
		<div class="well" style="text-align: left;">
			<h3 style="text-align: center;">Our Publisher</h3>
			<p><a href="blog">PunktSonstNichts</a> | <span class="label label-success">admin</span></p>
			<p><a href="blog">Max M&uuml;ller</a> | <span class="label label-info">designer</span></p>
			<p><a href="blog">Till Meyer-Arlt</a> | <span class="label label-primary">content manager</span></p>
		</div>
		<div class="well" style="text-align: left;">
			<h3 style="text-align: center;">CMS | Bootstrap</h3>
			<p>Do you like that design? We have this and many other <b>for free</b>!</p>
			<p><a class="btn btn-success btn-medium" href="xxx">Visit tdesk.com</a></p>
		</div>
	</div>
</div>
</div>

</body>
</html>