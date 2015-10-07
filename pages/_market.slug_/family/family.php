<?php 
$filters = ['is_family' => true] ;



$auto_set_left_rail = true; 


$page->title = "Family"; 

?>
<?php 
use \Crave\Model\ct_event;


global $website, $cache_refresh;



$event_times_titles = [
	'ap'=>'After Parties',
	'nye'=>'New Years Eve',
	'nyd'=>'New Years Day',
];

/**
* Configs 
*/
$event_cache_duration = '20 minutes';
//$event_cache_allowed = false;

$media_config_header_flyer = array(
		'height' => 173,
		'width' =>122 ,
		'resize'=>true,
			'limit' => 1

	) ;

$media_config_small = array(
			'height' => 250,
			'width' => 191,
			'crop' => 'center'
);


// allowing pages such as market slug page to preset the filters.
// required for other queries that might be using the same set of filters .
if(!isset($a)){
	// Setup the query 
	$a = $website->site_criteria; 

	if(isset($_GET['q']) && !empty($_GET['q'])){
		$a['where'][] = "(venue.name ilike '%{$_GET[q]}%' OR ct_event.name ilike '%{$_GET[q]}%')";
	}


	if(isset($filters) && is_array($filters)){
		$a = array_merge($a, $filters);
	}else 
		$filters = [];





}

// $a['where'][] = " ct_event.id = 5366 " ;

// get the left rail events (if applicable)
if($left_rail_query){
	$left_events = getLeftRailEvents($left_rail_query); 
} else if ($auto_set_left_rail){
	$left_rail_query = [
		'override_order_by' => true,
		'order_by' => 'venue.name',
		'min'=>true] ; 

	$left_rail_query = array_merge($a ,$left_rail_query);
}

// making sure the ct_promoter_id is provided
$a['seller__ct_promoter_id'] = $website->ct_promoter_id;


$nhoods = [] ;
$ages =[]; 
$event_types = [];
$event_times = [];


$cache_filters = [] ;

foreach($a as $key => $value){
	if(is_array($value)){
		$cache_filters[] = $key.':'.implode(',', $value);
	}else 
	$cache_filters[] = $key.':'.$value;
}


	$cache_name = sprintf('jwebsite:%s/page:_market.slug_/id:%s/filters:%s',$website->ct_promoter_website_id,$market_id , implode('+', $cache_filters));
	$cache_name_events = sprintf('jwebsite:%s/page:_market.slug_/id:%s/events/filters:%s',$website->ct_promoter_website_id,$market_id , implode('+', $cache_filters));


	unset($eventIds);
	$eventIds = \mem($cache_name);

	if(!$eventIds){
		$eventIds = \Crave\Model\ct_event::getList($a);			
		

		\mem($cache_name, $eventIds , $event_cache_duration);
	}


	//$events = \mem($cache_name_events);

	
		

	if(!$events){

		$events = []; 

		

		foreach ($eventIds as $eventId) {
			


			$cache_event_key = sprintf('jwebsite:%s/list.php/event:%s',$website->ct_promoter_website_id,$eventId);



			if(!$cache_refresh)
				$event = \mem($cache_event_key);

			//$obj = null ;
			
			if (!$event){ 

				$event = new \Crave\Api\Event(['id'=>$eventId , 'no_tickets'=> true ]);

				$event->buy_url = getBuyUrl(['event_ide'=>$event->ide]);


				$ct_event =  $event->getEvent();
				$event->_ct_event = $ct_event;
				$ct_contract = $ct_event->ct_contract; 

				$event->contract_status = $ct_contract->status; 

				if ($ct_contract->status == 'B'){ 

					$event->announce_ticket_message = $event->getAnnounceMessage();
					
				}
				else {
					if($event->tickets){
						$event->ticket_ga = $event->tickets[0];

						foreach($event->tickets as $ticket )
						{
							if($ticket->class=="bp" || $ticket->class=="as"){
								$event->ticket_vip = $ticket;
								break ; 
							}
						}
					}
				}


				if($ct_event->afterparty){
					$event->event_time = 'ap';

				} elseif ($event->when->date->n == 1) {
					$event->event_time = 'nyd';
					
					
				} else {
					$event->event_time = 'nye';
					
				}



				// get medias 
				$flyers = $ct_event->getFlyers (false,$media_config_small); 



				if( $flyers['no_logo'] ){

					$event->img_small = $flyers['no_logo'];

				}
				else{
					$mediaIds = $ct_event->getMediaIDs(1);
					$event->img_small = \vf::getItem($mediaIds[0], $media_config_small);
					
				}

							
				//$header_flyer = \vf::getItem($flyerId, $media_config_header_flyer);


				//$event->img_small = \vf::getItem($flyerId, $media_config_small);

				// $event->header_flyer_url = $header_flyer->src;

					
				$event->url = parseEventUrl($event);

				// include the template for event display.
				//include ('includes/events_listings_event.php');

				\mem($cache_event_key, $event, rand(2,20).' minutes');
			}

			$events[] = $event;

			$event = null ;
			//$obj = null ;
		}



//		\mem($cache_name_events, $events , '20 minutes');

}


/** 
* @todo reorganize, and improve page's life cycle. too many loops for the same array.
*/
// build left rail filters 
if($events && count($events)){
	foreach ($events as $event) {
		
		addItemToCounterArray($event_times, $event->event_time);


		addItemToCounterArray($nhoods, $event->where->neighborhood);
		addItemToCounterArray($ages, $event->info->ages);
		
		
		
		
	}
}else {


	\Website::top($this);


?>
	<section class="banner slider">
			<?php include ("templates/website/media-box/mediabox.php") ?>

	</section>

			
	<section class="main-area">
		<div class="breadcrumbs single-event" itemscope itemtype="http://schema.org/WebPage">
		<span itemprop="breadcrumb"><a itemprop="url" href="/">Home</a></span> 
		<?php if ($market && $market->country_name) { ?> 
		&rsaquo; <span itemprop="breadcrumb"><a itemprop="url" href="/<?= $market->country_slug ?>"><?= $market->country_name ?></a></span> 
		<?php } ?>
		&rsaquo; <span itemprop="breadcrumb" class="selected">New Year's Parties</span>
		<div class="area-head">
			<h1><?= $page->title ?></h1>
		</div>
		</div>

		<div>
			<?php include ("includes/notifyme.php") ?>
		</div>
	</section>

<?php 

	\Website::bottom();
	die();
}





\Website::top($this);

$h1_blurb = $this->seo['h1_blurb']; 
?>
			<section class="choose nobanner">
				<div class="choosearea">
					<a class="choosebtn" href="#markets_list">Choose City</a>							
				</div>

				
				
			<form action="#" id="searchevents" method="GET">
				<input type="text" class="topsearch" placeholder="Search" value="<?= $_GET['q'] ?>">
				<span class="topsearchicon"></span>
			</form>
			</section>

	<section class="main-area">
		<div class="breadcrumbs single-event" itemscope itemtype="http://schema.org/WebPage">
		<span itemprop="breadcrumb"><a itemprop="url" href="/">Home</a></span> &rsaquo; 
		<?php if ($market && $market->country_name) { ?> 
		&rsaquo; <span itemprop="breadcrumb"><a itemprop="url" href="/<?= $market->country_slug ?>"><?= $market->country_name ?></a></span> 
		<?php } ?>
		<span itemprop="breadcrumb"><a itemprop="url" href="/us/<?= $market->slug ?>"><?= $market->name ?></a></span> &rsaquo; <span class="selected">New Year's Parties</span>
		<div class="area-head ">
			<h1><?= $page->seo['h1']?:$page->title ?></h1>
			<p class="event-listp"><?= $h1_blurb ?></p>
		</div>

		</div>
		<aside class="side-menu"> <!-- Sidebar -->
		<?php /* 
			<!--<div class="nav-search">
			<form action="#" method="GET">
				<input type="text" name="q" placeholder="Search Locations &amp; Events" value="<?= $_GET['q'] ?>" />
				<input type="image" src="<?= $this->template_url ?>/content/images/icon_search.png" />
			</form>
			</div> <!-- end navsearch bar-->
			*/ ?>
		<div class="accordion">
		<!-- <button class="uncheckall">Reset</button> -->
			<?php 
				if(count($event_times)>1) { 
			?>
			<span class="slide-title">When</span>
			<div>

				<?php foreach ($event_times as $key=>$value) { ?>
					<div><span><div class="checkbox"><input type="checkbox" name="" data-filter="event-time" class="styled" value="<?= $key ?>"/></div><?= $event_times_titles[$key] ?></span><span class="amount"><?= $value ?></span></div>
				<?php
				}	
				?>
			</div>
			<?php 
				}
			?>

			<?php 
				if(count($ages) > 1) { 
			?>
			<span class="slide-title">Ages</span>
			<div>
				<?php foreach ($ages as $key=>$value) { ?>
					<div><span><div class="checkbox"><input type="checkbox" name="" data-filter="ages" class="styled" value="<?= $key ?>"/></div><?= $key ?></span><span class="amount"><?= $value ?></span></div>
				<?php
				}	
				?>
			</div>
			<?php 
				}
			?>
			<?php 
				if(count($nhoods)>1){
			?>
			<span class="slide-title">Neighborhoods</span>
			<div>
				<?php foreach ($nhoods as $key=>$value) { ?>
					<div><span><div class="checkbox"><input type="checkbox" data-filter="neighborhood" class="styled" value="<?= $key ?>"/></div><?= $key ?></span><span class="amount"><?= $value ?></span></div>
				<?php
				} 
				?>
			</div>
			<?php 
				}		

				if($filters_list && count($filters_list)){
					foreach ($filters_list as $filters_block) {	
			?>

			<span class="slide-title"><?= $filters_block->title ?></span>
			<div>
				<?php foreach ($filters_block->items as $item) { ?>
					<div>
						<a href="<?= $item->url?>">
							<?= $item->title ?>
						</a>
						<span class="amount"><?= $item->total ?></span>
					</div>
				<?php
				} 
				?>
			</div>
			<?php 

						
					}
				}
			?>


		</div> <!--end accordion -->
		
		<div class="city-event-list"> <!-- list of all events in city-->
			
		<img class="azlist" src="<?= $this->template_url ?>/content/images/partyaz.png" alt="Party A-Z" />
		<?php 

		if ($events && count($events)) { ?>
		<div>
			<?php
			foreach ($events as $event) {

				
				?>
				<a href="<?= $event->url ?>"><?= $event->name ?></a>
				<?php
			}
			?>
		</div>
		<?php 
		} // if($left_events)
		?>
		</div>
		
		</aside>
		<section class="content">
			<?php 
				foreach($events as $event){
					include("includes/events_listings_event.php");
				}

			?>
		</section>
	</section> 
<?php 
  //} // end of cache loop 
?>		

<script>
	
	$(function(){
		$('.checkbox').bind('click' ,function () {

			if($('.checkbox [data-filter]:checked').length == 0){

				$('article.event').show(); 
			}else {
				
				$('article.event').hide(); 

				$('.checkbox [data-filter]:checked').each(function(){

					var val = $(this).val(); 
					var filter = $(this).attr('data-filter');

					var selector = 'article.event[data-'+filter+'="' + val + '"]'; 

					$(selector).show();

					console.log(selector);

				});
			}
		

		}); 
	});

</script>

<?php




\Website::bottom();

?>