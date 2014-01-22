<?php
session_start();
include("admin.php");
$admin = new admin("pages");
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
		<span><?php echo _t("pages"); ?></span>
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
		</ul>
	<div id="pages-main-content">
	<?php
	$pagessql = new mysql();
	$pagesresult = $pagessql->query("SELECT * FROM `".$pagessql->dbprae."pages`;");
	while($page = $pagessql->result($pagesresult, "assoc")){
	?>
	<div class="pages-element" id="page-<?php echo $page["name"]; ?>" style="display: none;">
	<div class="page-general">
		<p><?php echo $page["site_description"]; ?></p>
		<a href="#"><?php echo _t("view page"); ?></a></br>
		
	</div>
		<table width="98%">
			<thead>
				<tr>
					<th><b><?php echo _t("widget"); ?></b></th>
					<th><b><?php echo _t("position"); ?></b></th>
					<th><?php echo _t("status"); ?></th>
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
					<td><?php echo $pagemeta["ID"]; ?></td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
	<?php
	}
	?>
	</div>
	</div>
</div>
</div>
</div> <!-- #header-fixed-helper -->
</body>