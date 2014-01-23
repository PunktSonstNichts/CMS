<?php
if(!ROOT){ exit; }

if(can_current_user("view_statistics")){

$user_recentsql = new mysql();
$user_recentresult = $user_recentsql->query("SELECT COUNT(*) AS User_all, (SELECT COUNT(*) FROM `".$user_recentsql->dbprae."client_demograohy` WHERE 'accesstimestamp' >= '".gmdate("Y-m-d H:i:s", time() - (30 * 60))."' LIMIT 0 , 3) AS User_recent FROM  `".$dbprae."client_demograohy` WHERE 'accesstimestamp' >= '".gmdate("Y-m-d H:i:s", time() - (24 * 60 * 60))."' LIMIT 0 , 3;");
while($user_recent[] = $user_recentsql->result($user_recentresult, "assoc"));

$browsersql = new mysql();
$browserresult = $browsersql->query("SELECT COUNT(Browser) AS BrowserNum , Browser, (SELECT COUNT(*) FROM `".$browsersql->dbprae."client_demograohy` ) AS AllBrowser FROM  `".$dbprae."client_demograohy` GROUP BY Browser ORDER BY COUNT( Browser ) DESC LIMIT 0 , 3;");
while($most_used_browser[] = $browsersql->result($browserresult, "assoc"));

$referrersql = new mysql();
$referrerresult = $referrersql->query("SELECT COUNT(Referrer) AS ReferrerNum , Referrer, (SELECT COUNT(*) FROM `".$referrersql->dbprae."client_demograohy` ) AS AllReferrer FROM  `".$dbprae."client_demograohy` GROUP BY Referrer ORDER BY COUNT( Referrer ) DESC LIMIT 0 , 3;");
while($most_used_referrer[] = $referrersql->result($referrerresult, "assoc"));

/* Stat math */
$user_development = $user_recent[0]["User_all"] / 24; //BUG


if($most_used_browser[0]["AllBrowser"] == 0){
	$percent_first_browser = 0;
}else{
	$percent_first_browser = round(($most_used_browser[0]["BrowserNum"] / $most_used_browser[0]["AllBrowser"]) * 100);
}

if($most_used_browser[1]["AllBrowser"] == 0){
	$percent_sec_browser = 0;
}else{
	$percent_sec_browser = round(($most_used_browser[1]["BrowserNum"] / $most_used_browser[1]["AllBrowser"]) * 100);
}


if($most_used_referrer[0]["AllReferrer"] == 0){
	$percent_first_referrer = 0;
}else{
	$percent_first_referrer = round(($most_used_referrer[0]["ReferrerNum"] / $most_used_referrer[0]["AllReferrer"]) * 100);
}

if($most_used_referrer[1]["AllReferrer"] == 0){
	$percent_sec_referrer = 0;
}else{
	$percent_sec_referrer = round(($most_used_referrer[1]["ReferrerNum"] / $most_used_referrer[1]["AllReferrer"]) * 100);
}


?>
	<div class="element" id="visitors" style="width: 100%;">
		<div class="element-heading">
			<span><?php echo _t("statistics"); ?></span>
		</div>
		<div class="element-content">
			<div class="element" id="visitors" style="min-width: 124px; width: 31%; height: 120px;">
				<div class="element-heading">
					<span><?php echo _t("visitor"); ?></span>
				</div>
				<div class="element-content">
					<div class="center main-statistic">
						<?php echo $user_recent[0]["User_recent"]; ?>
					</div>
					<div class="statistics-development pos">
					</div>
					<div class="statistic-description">
					<?php echo sprintf( _t('in the past %c minutes'), 30); ?>
					</div>
				</div>
			</div>
			<div class="element" id="browsers" style="min-width: 124px; width: 31%; height: 120px;">
				<div class="element-heading">
					<span><?php echo _t("browsers"); ?></span>
				</div>
				<div class="element-content">
					<div class="main-statistic">
						<?php echo $most_used_browser[0]["Browser"]; ?>
					</div>
					<div class="statistics-development">
					<?php echo $percent_first_browser; ?>%
					</div>
					<div class="statistic-description">
					2. <?php echo $most_used_browser[1]["Browser"]." (".$percent_sec_browser."%)"; ?>
					</div>
				</div>
			</div>
			<div class="element" id="referrer" style="min-width: 124px; width: 31%; height: 120px;">
				<div class="element-heading">
					<span><?php echo _t("refferrer"); ?></span>
				</div>
				<div class="element-content">
					<div class="center main-statistic">
						<?php
						if($most_used_referrer[0]["Referrer"] != ""){
							echo $most_used_referrer[0]["Referrer"];
						}else{
							echo _t("<span title='or no referrer send'>tipped URL</span>");
						}
						?>
					</div>
					<div class="statistics-development">
					<?php echo $percent_first_referrer; ?>%
					</div>
					<div class="statistic-description">
					2. <?php
					if($most_used_referrer[1]["Referrer"] != ""){
						echo $most_used_referrer[1]["Referrer"];
					}else{
						echo _t("<span title='or no referrer send'>tipped URL</span>");
					}
					echo " (".$percent_sec_referrer."%)"; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>