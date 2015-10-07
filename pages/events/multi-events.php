<div class="row1">
	<?php foreach ($events as $main_events) {
		$stripped_text = strip_tags($main_events['description']);
		$first_sentence = $stripped_text !== "" ? substr($stripped_text, 0, strpos($stripped_text, ' ', 260)) : 'BarCrawl';

		$params = [
			'ide' => $main_events['ide'],
			'type' => 'branded',
			'width' => '226',
			'height' => '226',
			'media_items' => $main_events['media_items']
		];

	$flyer_image = Sky\VF\ImageManager::get_flyer_array($params);

	if(!$flyer_image || !isset($flyer_image)){
		$flyer_image = $default_image;
	};
		?>
	<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "Event",
		  "location": {
		    "@type": "Place",
		    "address": {
		      "@type": "PostalAddress",
		      "addressLocality": "<?= $main_events['city'] ?>",
		      "addressRegion": "<?= $main_events['state'] ?>",
		      "postalCode": "<?= $main_events['zip'] ?>",
		      "streetAddress": "<?= $main_events['address1'] ?>"
		    },
		    "name": "<?= $main_events['venue_name'] ?>"
		  },
		  "name": "<?= $main_events['venue_name'] ?>",
		  "startDate": "<?= $main_events['start_date'] ?>"
		}
	</script>
			<div class="rightcol col events" data-vtype="<?=$main_events['venue_type_name']?>" data-neighborhood="<?=$main_events['neighborhood']?>">
				<div class="highlight"><?= $main_events['date_formatted']?> at <?= $main_events['start_time']?></div>
			<a class="links" href="<?= $main_events['url']?>">
				<a href="<?= $main_events['url']?>"><img src="<?= $flyer_image?>" /></a>
				<div class="party_name"><?= $main_events['venue_name']?></div>
				<div class="address"><?= $main_events['address1']?>,<?= $main_events['state']?>, <?= $main_events['zip']?></div>
				<p><?php if(isset($first_sentence)){echo$first_sentence;}?></p>
				<span class="starting_price">Starting at $<?= $main_events['ga_price']?> </span>
				<!-- <div class="col_buttons">
					<a href="<?= $main_events['buy_url']?>" target="_blank"><div class="buy_btn">buy</div></a>
					<a href="<?= $main_events['url']?>"><div class="info_btn">info</div></a>
				</div> -->
			</a>
			</div>
	<?php } ?>
</div>



<script>

	// $(function() {
	// 	$('.links').hover(function(){
	// 		console.log('hi');
	// 		$('.highlight').show();
	// 	});
	// });
</script>