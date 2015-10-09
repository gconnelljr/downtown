<?php 
global $website;
$event_cache_duration = '20 minutes';


// if(!$_SESSION['current_market']){
// 	$_SESSION['current_market'] == 'newyork';
// 	redirect('/'.$_SESSION['current_market']);
// }else{
// 	redirect('/newyork');
// }

// 	redirect('/newyork');

// exit();



$country_slug = $this->vars['country_slug'];

//include(sprintf("default_markets/%s.php" ,$country_slug));
// include("pages/default_markets/us.php");
// 	/** 
// 	* @todo open the query to support international markets, improve conditions .
// 	*/
	
// 	// Get list of markets to put in the footer.
	
// 	/**
// 	* Default markets for the national page .
// 	* 
// 	* @todo : this is a temporary solutoion, and only covers the US , must replace with a better and fexible option .
// 	*/

// 	$a = $website->site_criteria ;

// 	$a = array_merge($website->site_criteria, [

// 		'featured' => true, 
// 		'random' => true,
// 		'is_barcrawl' => false

// 		]);

// 	$media_config_small = array(
// 			'height' => 330,
// 			'width' => 330,
// 			'crop' => 'center'
// 	);


	
// 	$a['limit'] = 4;
// 	$a['add_fillers'] = true; 
// 	$a['ct_holiday_id'] = $this->website->holiday_id;
// 	$a['ct_category_id'] = null;

// 	// Organize the featured events for the featured markets /.
// 	for($i = 0; $i<count($default_markets) ; $i++)
// 	{
//         $default_market = $default_markets[$i];

//         $filters = $a ;

//         if ($default_market['filters']){
//             $filters = array_merge($default_market['filters'], $filters);

//         }

//         if ($default_market['market_id'])
//         {
//             $filters['market_id'] = $default_markets[$i]['market_id'];
//         }

//         if ($default_market['limit'])
//         {
//             $filters['limit'] = $default_market['limit'];

//         }




//         $cache_name = sprintf('jwebsite:%s;page:%s;name:featured_markets;market_id:%s',$website->ct_promoter_website_id,$this->uri, serialize($filters)) ;

//         unset ($events);

// 		if(!$cache_refresh && false)
// 			$events = \mem($cache_name);
			
// 		if(!$events){
// 			//$events = \Crave\Api\Event::getFeaturedFeed($a);
// 			$events = \Crave\Api\Event::getFeaturedEvents($filters);

// 			array_walk($events,function (&$event ) use ($default_market, $media_config_small) {
// 				$ct_event = new \Crave\Model\ct_event ; 


// 				$event->ct_contract = new stdClass() ; 
// 				$event->ct_contract->market_slug = $default_market['slug']; 

// 				$event->venue = new stdClass(); 
// 				$event->venue->name = $event->venue_name; 
// 				$event->venue->slug =  $event->venue_slug;
//                 $event->venue->address =  $event->address;
//                 $event->venue->address1 =  $event->address1;
//                 $event->venue->address2 =  $event->address2;
//                 $event->venue->city =  $event->city;
//                 $event->venue->zip =  $event->zip;
//                 $event->venue->state =  $event->state;
//                 $event->url = parseEventUrl($event);


// 				$ct_event->ct_event_id = $event->ct_event_id ; 


// 				/**
// 				* Fetch media for the event .
// 				*/
// 				$mediaIds = $ct_event->getMediaIDs(1);
// 				$index = count($mediaIds)>1?1:0;



// //$mediaIds[$index]
// 				$event->img_small = \vf::getItem($ct_event->getFlyer(), $media_config_small);

//                 if (!$event->img_small && count($mediaIds))
//                 {
//                     $event->img_small = \vf::getItem($mediaIds[0], $media_config_small);

//                 }


// 			});



// 			\mem($cache_name, $events , $event_cache_duration);
// 		}

// 		$default_markets[$i]['events'] = $events ;
// 	}

// $template_url = "/templates/website/";
\Website::top($this);
?>

<section class="index container pages">
	<section class="introduction">
		<div class="container">
			<h1>the best new year's ever parties</h1>
			<p>Downtown Countdown is your global source for the biggest and best New Year’s Eve parties. Celebrate New Year's with a million of your closest friends in some of the best clubs, lounges, event spaces, restaurants, cruises, etc. We are the worldwide destination for New Year's Eve revelers with more than 60 fabulous New Year's events.</p>
		</div>
	</section>

	<section class="city_section">
		<h2>New York</h2>
		<p>Downtown Countdown is your global source for the biggest and best New Year’s Eve parties. Celebrate New Year's with a million of your closest friends in some of the best clubs, lounges, event spaces, restaurants, cruises, etc. We are the worldwide destination for New Year's Eve revelers with more than 60 fabulous New Year's events.</p>
		<div class="image_row">
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
		</div>
		<div class="see_all"><a href="#">see all nye parties >></a></div>
	</section>
	<section class="city_section">
		<h2>Washington-dc</h2>
		<p>Downtown Countdown is your global source for the biggest and best New Year’s Eve parties. Celebrate New Year's with a million of your closest friends in some of the best clubs, lounges, event spaces, restaurants, cruises, etc. We are the worldwide destination for New Year's Eve revelers with more than 60 fabulous New Year's events.</p>
		<div class="image_row">
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
		</div>
		<div class="see_all"><a href="#">see all nye parties >></a></div>
	</section>
	<section class="city_section">
		<h2>Baltimore</h2>
		<p>Downtown Countdown is your global source for the biggest and best New Year’s Eve parties. Celebrate New Year's with a million of your closest friends in some of the best clubs, lounges, event spaces, restaurants, cruises, etc. We are the worldwide destination for New Year's Eve revelers with more than 60 fabulous New Year's events.</p>
		<div class="image_row">
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
		</div>
		<div class="see_all"><a href="#">see all nye parties >></a></div>
	</section>
	<section class="city_section">
		<h2>Atlanta</h2>
		<p>Downtown Countdown is your global source for the biggest and best New Year’s Eve parties. Celebrate New Year's with a million of your closest friends in some of the best clubs, lounges, event spaces, restaurants, cruises, etc. We are the worldwide destination for New Year's Eve revelers with more than 60 fabulous New Year's events.</p>
		<div class="image_row">
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
			<a href="#"><img src="<?=$template_url?>content/images/bar-crawl.png" alt="" /></a>
		</div>
		<div class="see_all"><a href="#">see all atlanta nye parties >></a></div>
	</section>

</section> <!-- end index -->


<?php

	   \Website::bottom($this);
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