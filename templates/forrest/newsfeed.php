<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<?php echo $header->title; ?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-5589-1">
<?php echo $header->metastring; ?>
<link rel="stylesheet" href="<?php echo ROOT_URL."templates/".TEMPLATE; ?>/scripte/css/main.css" type="text/css" />

<script src="http://code.jquery.com/jquery-latest.js"></script>
<style type="text/css">
<?php
run_action('css-loading');
?>
</style>
</head>
<body>
<div class="wrapper">
<div class="wrapper-child">
<span>One day baby we'll be old, oh baby we'll be old and think of all the stories that we could have told</span></br>
<?php $body->logo("crap"); ?>
</div>
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
<div id="main">
<div id="table">
<?php $body->main(); ?>
</div>
</div>
</div>
<div id="footer">
</div>
</div>