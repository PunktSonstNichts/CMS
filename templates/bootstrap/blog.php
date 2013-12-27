<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<?php echo $header->title; ?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-5589-1">
<?php echo $header->metastring; ?>
<link rel="stylesheet" href="<?php echo ROOT_URL."templates/".TEMPLATE; ?>/scripte/css/bootstrap.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
<?php
run_action('js-loading');
?>
</script>
<style type="text/css">
<?php
run_action('css-loading');
?>
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
  <div class="col-xs-12 col-sm-9"><?php $body->main(); ?></div>
	<div class="col-xs-6 col-sm-3 sidebar-offcanvas">
		<div class="well" style="text-align: left;">
			<h3 style="text-align: center;">Recommended</h3>
			<p>CMS // Blog is the number 1 for good textes combinded with design: <a href="blog">Blog</a></p>
			<p>Hakuna Matata; or the life of monkeys in natural habbits: <a href="blog">Life of Monkeys</a></p>
		</div>
		<div class="well" style="text-align: left;">
			<h3 style="text-align: center;">Our Publisher</h3>
			<p><a href="blog">PunktSonstNichts</a> | <span class="label label-success">admin</span></p>
			<p><a href="blog">hermit</a> | <span class="label label-primary">content manager</span></p>
			<p><a href="blog">Max M&uuml;ller</a> | <span class="label label-info">designer</span></p>
		</div>
		<div class="well" style="text-align: left;">
			<h3 style="text-align: center;">CMS | Bootstrap</h3>
			<p>Do you like that design? We have this and many other <b>for free</b>!</p>
			<p><a class="btn btn-success btn-medium" href="http://templateworld123.funpic.de" target="_blank">Visit tdesk.com</a></p>
		</div>
	</div>
</div>
<hr>
<?php $body->footer(); ?>
</div>
</body>
</html>