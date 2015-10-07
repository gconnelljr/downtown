<?php 
$venues = $ct_event->ct_contract->ct_barcrawl->ct_barcrawl_venue; 


?>
<div id="barslist" itemscope itemtype="http://schema.org/Place">
	<h5 class="heading">Bars list</h5>
	<span class="page_top"><a href="#top">Back to Top</a></span>
	<?php 
		foreach ($venues as $venue) {
	?>
	<div class="bar-item">
		<span itemprop="name" class="barname"><?= $venue->venue_name ?></span>
		
		<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">	
		<meta itemprop="latitude" content="<?= $venue->latitude ?>" />
		<meta itemprop="longitude" content="<?= $venue->longitude ?>" />
		</div>	
		
		<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<span itemprop="streetAddress"><?= $venue->venue_address ?></span>
		</div>
		
		<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<span itemprop="priceSpecification"><?= $venue->specials ?></span>
		</div>
	</div>
	<?php
		}
	?>
</div>
<?php 

	$display_bars = array_map(function($bar) {
		return array(
			'address' => $bar->venue_address,
			'lat' => $bar->latitude,
			'lng' => $bar->longitude,
			'venue_name' => $bar->venue_name,
			'is_registration_point' => $bar->is_registration_point
		);
	}, $venues); 

?> 
<script type="text/javascript">
	var EventBars = <?=json_encode($display_bars)?>;
</script>
