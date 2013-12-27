<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<?php echo $header->title; ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php echo $header->metastring; ?>
<link rel="stylesheet" href="<?php echo ROOT_URL."templates/".TEMPLATE; ?>/scripte/css/main.css" type="text/css" />
</head>
<body>
<div class="wrapper">
<?php $body->logo("navigation"); ?>
</div>
<div class="wrapper grey">
<div id="topnav">
<?php $body->navigation("top"); ?>
</div>
</div>
<div class="wrapper">
<div id="content">
<?php $body->top(); ?>
</div>
</div>
<div class="wrapper">
<div id="content">
<div id="table">
<?php $body->main(); ?>
</div>
</div>
</div>
<div class="wrapper">
<div id="main">
<?php $body->footer(); ?>
</div>
<div id="footer"></div>
</div>