<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<?php echo $header->title; ?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-5589-1">
<?php echo $header->metastring; ?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo ROOT_URL."templates/".TEMPLATE; ?>/scripte/css/bootstrap.css">
<script src="<?php echo ROOT_URL."templates/".TEMPLATE; ?>/scripte/js/bootstrap.js"></script>

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
.fly_in{
position: absolute !important;
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
		<?php $body->sidebar("sidebar");  ?> <!--  End Sitebar -->
	</div>
</div>
<hr>
<?php $body->footer(); ?>
</div>
</body>
</html>