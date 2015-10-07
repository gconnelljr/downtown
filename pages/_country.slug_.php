<?php 
global $website;
$event_cache_duration = '20 minutes';

$country_slug = $this->vars['country_slug']; 

include(sprintf("default_markets/%s.php" ,$country_slug));
	/** 
	* @todo open the query to support international markets, improve conditions .
	*/
	
	// Get list of markets to put in the footer.
	
	/**
	* Default markets for the national page .
	* 
	* @todo : this is a temporary solutoion, and only covers the US , must replace with a better and fexible option .
	*/

	$a = $website->site_criteria ;

	$a = array_merge($website->site_criteria, [

		'featured' => true, 
		'random' => true,
		'is_barcrawl' => false

		]);

	$media_config_small = array(
			'height' => 330,
			'width' => 330,
			'crop' => 'center'
	);


	
	$a['limit'] = 4;
	$a['add_fillers'] = true; 
	$a['ct_holiday_id'] = $this->website->holiday_id;
	$a['ct_category_id'] = null;

	// Organize the featured events for the featured markets /.
	for($i = 0; $i<count($default_markets) ; $i++)
	{
        $default_market = $default_markets[$i];

        $filters = $a ;

        if ($default_market['filters']){
            $filters = array_merge($default_market['filters'], $filters);

        }

        if ($default_market['market_id'])
        {
            $filters['market_id'] = $default_markets[$i]['market_id'];
        }

        if ($default_market['limit'])
        {
            $filters['limit'] = $default_market['limit'];

        }




        $cache_name = sprintf('jwebsite:%s;page:%s;name:featured_markets;market_id:%s',$website->ct_promoter_website_id,$this->uri, serialize($filters)) ;

        unset ($events);

		if(!$cache_refresh && false)
			$events = \mem($cache_name);
			
		if(!$events){
			//$events = \Crave\Api\Event::getFeaturedFeed($a);
			$events = \Crave\Api\Event::getFeaturedEvents($filters);

			array_walk($events,function (&$event ) use ($default_market, $media_config_small) {
				$ct_event = new \Crave\Model\ct_event ; 


				$event->ct_contract = new stdClass() ; 
				$event->ct_contract->market_slug = $default_market['slug']; 

				$event->venue = new stdClass(); 
				$event->venue->name = $event->venue_name; 
				$event->venue->slug =  $event->venue_slug;
                $event->venue->address =  $event->address;
                $event->venue->address1 =  $event->address1;
                $event->venue->address2 =  $event->address2;
                $event->venue->city =  $event->city;
                $event->venue->zip =  $event->zip;
                $event->venue->state =  $event->state;
                $event->url = parseEventUrl($event);


				$ct_event->ct_event_id = $event->ct_event_id ; 


				/**
				* Fetch media for the event .
				*/
				$mediaIds = $ct_event->getMediaIDs(1);
				$index = count($mediaIds)>1?1:0;



//$mediaIds[$index]
				$event->img_small = \vf::getItem($ct_event->getFlyer(), $media_config_small);

                if (!$event->img_small && count($mediaIds))
                {
                    $event->img_small = \vf::getItem($mediaIds[0], $media_config_small);

                }


			});



			\mem($cache_name, $events , $event_cache_duration);
		}

		$default_markets[$i]['events'] = $events ;
	}


	\Website::top();
?>
			<section class="banner slider">

			<?php include ("templates/website/media-box/mediabox.php") ?>
			
	</section>

<div>

			<section class="choose">
				<div class="choosearea">
					<a class="choosebtn" href="#markets_list">Choose City</a>							
				</div>
				
				<div class="homemid-head">
				<h1>Worldwide new years parties</h1>
				</div>
			</section>


	<?php 


		/**
		*  @todo : remove rdundancy for running over the array twice (see line 51) 
		*/
		foreach($default_markets as $market){
			$events = $market['events'];

            $template = $market['template'];

            if ($template)
            {
                $template = "pages/_country.slug_/default_markets/templates/{$template}.php" ;

                include($template);


            }



		}
	?>


<!-- SF, LV, SD AREA -->		
		
<section class="content3">
<div class="container">


	<section class="content-row3">
			
	<section class="smtop-contentarea">
			
			<div class="right-desc" itemscope="" itemtype="http://schema.org/Event">
				
				<h2 itemprop="summary name">
				<a itemprop="url" href="/us/sanfrancisco">San Francisco</a>
				</h2>
				<p itemprop="description">The golden gates are opening, and San Francisco is the place to celebrate an unbeatable New Year’s Eve. San Francisco’s nightlife scene comes alive this New Year’s with clubs, lounges bars and restaurant parties. </p>
				<div class="home-btnblock">
				<meta itemprop="latitude" content="40.735747">
                <meta itemprop="longitude" content="-73.99056">
				<meta itemprop="startDate" content="2014-12-31">

				</div>
			</div>
	</section><!--rightarea content-->	
	<section class="content-row4">		
			<article itemscope="" itemtype="http://schema.org/Event" class=" ">
				<a itemprop="url" href="/us/sanfrancisco"><img itemprop="image" src="/templates/website/content/images/cities/city_sf.jpg" alt="San Francisco"></a>

			</article> 
		
	</section>
</section>	


<!-- MIDDLE BLOCK -->
<section class="content-row3">
	<section class="content-row4">		
			<article itemscope="" itemtype="http://schema.org/Event" class=" ">
				<a itemprop="url" href="/us/lasvegas"><img itemprop="image" src="/templates/website/content/images/cities/city_lv.jpg" alt="Las Vegas"></a>

			</article> 
		
	</section>
	<section class="smtop-contentarea">
			
			<div class="right-desc" itemscope="" itemtype="http://schema.org/Event">
				
				<h2 itemprop="summary name">
				<a itemprop="url" href="/us/lasvegas">Las Vegas</a>
				</h2>
				<p itemprop="description">This New Year’s Eve, we invite you out to Las Vegas—or shall we say, paradise—for a rule-breaking, secret-making New Year’s Eve party where there’s only one requirement: What happens in Vegas, stays in Vegas.  </p>
				<div class="home-btnblock">
				<meta itemprop="latitude" content="40.735747">
                <meta itemprop="longitude" content="-73.99056">
				<meta itemprop="startDate" content="2014-12-31">

				</div>
			</div>
	</section><!--rightarea content-->	

</section>	



	<section class="content-row6">
			
	<section class="smtop-contentarea">
			
			<div class="right-desc" itemscope="" itemtype="http://schema.org/Event">
				
				<h2 itemprop="summary name">
				<a itemprop="url" href="/us/sandiego">San Diego</a>
				</h2>
				<p itemprop="description">The New Year’s parties are heating up in San Diego, with fun in the sun special New Year’s Eve Packages --dancing, music, drinks and party favors –it doesn't get any hotter. </p>
				<div class="home-btnblock">
				<meta itemprop="latitude" content="40.735747">
                <meta itemprop="longitude" content="-73.99056">
				<meta itemprop="startDate" content="2014-12-31">

				</div>
			</div>
	</section><!--rightarea content-->	
	<section class="content-row4">		
			<article itemscope="" itemtype="http://schema.org/Event" class=" ">
				<a itemprop="url" href="/us/sandiego"><img itemprop="image" src="/templates/website/content/images/cities/city_sd.jpg" alt="San Diego"></a>

			</article> 
		
	</section>
</section>	

				
</div> <!-- end container -->

	</section>	



</div>

<hr>


<?php

	\Website::bottom();
?> 
<script>
$(document).ready(function(){
$('.content1 .container article').hover(function(){
	$(this).find('.box-content').fadeToggle(500);
});
$('.content3 .container article').hover(function(){
	$(this).find('.box-content').fadeToggle(500);
});
});

</script>