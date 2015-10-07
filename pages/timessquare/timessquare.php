<?php 
use \Crave\Model\ct_event;

global $website;
$website->market_id = $market_id;

$market = new \Crave\Model\market($market_id);
$this->market = $market ;
$market_id = $this->vars['market_id'];

// $listingPage = getListingPage()->add_to_criteria($filters);

// get featured events 
$params = [
			'market_id' => (string)$market_id,
		];



// Cache Featured Events
$events_callback = function() use($params){
$filters = ['market_nbhd_id' => 449, 'is_barcrawl' => false] ;
	$listingPage = getListingPage()->add_to_criteria($filters);

	$market_id = $params['market_id'];
	
	$event_listing = $listingPage->getEvents();
	$main_events = array_map(function($item){
		return [
				'id' => $item->ct_event_id,
				'ide' => $item->ide,
				'ct_event_name' => $item->ct_event_name,
				'description' => $item->ct_event_description,
				'venue_ide' => $item->venue_ide,
				'venue_id' => decrypt($item->venue_ide, 'venue'),
				'venue_name' => $item->venue_name,
				'city_name' => $item->market_name,
				'start_date' => $item->start_date,
				'start_time' => $item->when->door_time->formatted,
				'ct_contract_category' => $item->ct_contract->ct_contract_category[0]->category_slug,
				'url' => $item->url,
				'slug' => $item->ct_event_slug,
				'media_items' => $item->media_items
		];
	}, $event_listing);

	return $main_events;
};
$main_events = getFromCache(
	"nyec:market:events:".serialize($params), // cache key
	$events_callback,
	rand(60,120) // random cache time in minutes
);
$events = $main_events;
// $events = $listing->getEvents(); 
$left_events = $events;
// load current market
$template_url = "/templates/website/";




$this->show_filters = false; 

\Website::top($this);
include("pages/events/list.php");
\Website::bottom($this);