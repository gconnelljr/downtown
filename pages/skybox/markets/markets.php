<?php

use \Crave\Model\market;

?>
<div id="market_container">

<?
$num_cols = 3;
$markets = json_decode(json_encode(market::getSkybox()));
$per_col = ceil(sizeof($markets)/$num_cols);


foreach ($markets as $key => $m) {
	if ($m->country_code != 'US') {
		$other_markets[$m->country_code][] = $m;
		unset($markets[$key]);
	}
}

$country_codes = array(
	'UK' => 'Europe',
	'CA' => 'Canada'
);



foreach ($markets as $key =>$m) {
	$columns[floor(($key+1)/$per_col)][] = $m;
}

$this->title = "Choose a City";
$this->template('skybox', top);

if (is_array($columns)) {
	foreach($columns as $key => $col) {
?>
		<div class="column">
<?
		if ($key==0) {
?>
			<div class="market_title">United States</div>
<?
		} else {
?>
			<div class="market_spacer"></div>
<?
		}

		foreach($col as $market) {
			
?>
			<div><a href="/<?= strtolower($market->country_code )?>/<?=$market->slug?>"><?=$market->name ?></a></div>
<?
		}
?>
		</div>
<?

	}
}




if ($other_markets) {
?>
	<div class="column">
<?
	foreach($other_markets as $key => $markets) {
?>
		<div class="market_title"><?=$country_codes[$key]?></div>
<?
		foreach ($markets as $m) {

?>
			<div><a href="/<?= strtolower($m->country_code )?>/<?=$m->slug?>"><?=$m->name ?></a></div>
<?
		}
	}
?>
	</div>
<?
}
?>
</div>


<?
$this->template('skybox', bottom);
