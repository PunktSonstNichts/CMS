<?php
session_start();
include("admin.php");
$admin = new admin("sites");
include("../loader.php");


run_action("admin-dashboard");

function sites_js(){
?>
$(".selector-link").click( function(e){
	e.preventDefault();
	$(".pages-element").fadeOut(1);
	$("#page-" + $(this).attr("href")).fadeIn();
});
<?php
}
add_action("admin-javascript", "sites_js");

include_once(dirname(__file__)."/backend_UI.php");
?>
<link rel="stylesheet" href="scripte/css/sites/pages.css" type="text/css"/>
<div id="contentframe">
<div class="element">
	<div class="element-heading">
		<span><?php echo _t("sites"); ?></span>
	</div>
	<div class="element-content">
		<ul class="selector-list well">
			<?php
			$pagessql = new mysql();
			$pagesresult = $pagessql->query("SELECT * FROM `".$pagessql->dbprae."pages`;");
			while($page = $pagessql->result($pagesresult, "assoc")){
			?>
				<li class="selector-element">
					<a href="<?php echo $page["name"]; ?>" class="selector-link"><span class="selector-pagename"><?php echo $page["visual_name"]; ?></span></a>
					<span class="selector-path label-warning" ><?php echo $page["template"].".php"; ?></span>
				</li>
			<?php
			}
			?>
			<li class="selector-element">
				<a href="_new" class="selector-link"><span class="selector-pagename"><?php echo _t("create a new site"); ?></span></a>
				<span class="selector-path label-danger">.php</span>
			</li>
		</ul>
	<div id="pages-main-content">
	<?php
	$pagessql = new mysql();
	$pagesresult = $pagessql->query("SELECT * FROM `".$pagessql->dbprae."pages`;");
	$count = 0;
	while($page = $pagessql->result($pagesresult, "assoc")){
	?>
	<div class="pages-element" id="page-<?php echo $page["name"]; ?>" <?php echo ($count != 0) ? 'style="display: none;"' : ''; ?>>
	<div class="page-general">
		<p><?php echo $page["site_description"]; ?></p>
		<a href="<?php echo ROOT_URL.$page["name"]; ?>"><?php echo _t("view page"); ?></a></br>
		
	</div>
		<table width="98%">
			<thead>
				<tr>
					<th><b><?php echo _t("widget"); ?></b></th>
					<th><b><?php echo _t("position"); ?></b></th>
					<th><b><?php echo _t("widget settings"); ?></b></th>
				</tr>
			</thead> 
			<tbody>
			<?php
			$pagemetasql = new mysql();
			$pagemetaresult = $pagemetasql->query("SELECT * FROM `".$pagemetasql->dbprae."pagemeta` WHERE affected_pageID = '".$page["ID"]."';");
			while($pagemeta = $pagemetasql->result($pagemetaresult, "assoc")){
			?>
				<tr>
					<td><?php echo $pagemeta["widget"]; ?></td>
					<td><?php echo $pagemeta["position"]; ?></td>
					<td><a href="<?php echo "admin-widgets.php?widget=".$pagemeta["widget"]."&site=".$page["name"]; ?>"><?php echo _t("change content"); ?></a></td>
				</tr>
			<?php
			}
			$selectwidgetsql = new mysql();
			$widgetresult = $selectwidgetsql->query("SELECT * FROM `".$selectwidgetsql->dbprae."pagemeta` LEFT JOIN `widgets` ON `pagemeta`.widget = `widgets`.name GROUP BY `widget`;");
			while($widget = $selectwidgetsql->result($widgetresult, "assoc")){
				$select[] = $widget["widget"];
			}
			$select_pos = array("top", "sidebar", "navigation", "main", "footer");
			?>
				<tr>
					<td><?php create_select($select, "slim");?></td>
					<td><?php create_select($select_pos, "slim");?></td>
					<td><input type="submit" class="slim" value="<?php echo _t("create widget");?>"/></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
	$count++;
	}
	$templates = array("commerce", "blog", "main");
	?>
	<div class="pages-element" id="page-_new" <?php echo ($count != 0) ? 'style="display: none;"' : ''; ?>>
	<form method="post" data-type="new" action="<?php echo ROOT_URL."widgets/text/savepost.php";?>">
		<table class="form-table">
		<tr>
			<td><label for="sitename"><?php echo _t("site name"); ?></label></td>
			<td><input type="text" id="sitename" name="sitename" placeholder="<?php echo _t("site name"); ?>"/></td>
		</tr>
		
		<tr>
			<td><label for="sitedescription"><?php echo _t("site description"); ?></label></td>
			<td><input type="text" id="sitedescription" name="sitedescription" placeholder="<?php echo _t("site description"); ?>"/></td>
		</tr>
		
		<tr>
			<td><label for="sitetemplate"><?php echo _t("site template"); ?></label></td>
			<td><?php create_select($templates);?></td>
		</tr>
		
		<tr>
			<td colspan="2"><input type="submit" value="<?php echo _t("create site"); ?>"/></td>
		</tr>
		</table>
	</form>
	</div>
	</div>
	</div>
</div>
</div>
</div> <!-- #header-fixed-helper -->
</body>