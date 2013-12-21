<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<?php echo $header->title; ?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-5589-1">
<?php echo $header->metastring; ?>
<link rel="stylesheet" href="<?php echo ROOT;?>templates/bootstrap/scripte/css/bootstrap.css">
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
<?php $body->main(); ?>
</div>

<div id="footer">
	<button type="submit" class="btn" name="add">
		<span class="value">Add new</span>
	</button>
</div>
</body>
</html>