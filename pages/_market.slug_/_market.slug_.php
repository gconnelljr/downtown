<?php
use \Crave\Model\ct_event;

global $website;

if(!$this->seo){
	$this->seo = new stdClass ();
	$this->seo->title = $this->vars['ct_category_slug'];
}

if (!$this->seo->title) {
	$this->seo->title = $this->ide.' on New Years Eve Central';
}



$website->market_id = $market_id;

$market = new \Crave\Model\market($market_id);
$this->market = $market ;

// $listing = getListingPage()->add_to_criteria($filters); 

$market_id = $this->vars['market_id'];

$listingPage = getListingPage()->add_to_criteria($filters);
// get featured events 
$params = [
			'market_id' => (string)$market_id,
			'ide' => $this->vars['ct_category_slug'],
			'filters' => $filters,
			'bar-crawls' => $this->ide //only for bar-crawls
		];





// Cache Featured Events
$events_callback = function() use($params){
if (!$params['filters']) {
	$filters = ['is_barcrawl' => 1];
}

if ($params['bar-crawls'] == 'bar-crawls'){
	$params['filters']  = ['is_barcrawl' => 1, 'ct_category_id' => 1];
}

if ($params['ide'] == 'dinners'){
	$filters['dinner']  = true ;	
}

if ($params['ide'] == 'hotels'){
	$filters['hotels']  = true ;	
}


	$listingPage = getListingPage()->add_to_criteria($params['filters']);

	$market_id = $params['market_id'];
	
	$event_listing = $listingPage->getEvents();
	$main_events = array_map(function($item){
		$date_formatted = date("F jS, Y", strtotime($item->start_date));
		return [
				'id' => $item->ct_event_id,
				'ide' => $item->ide,
				'ct_event_name' => $item->ct_event_name,
				'description' => $item->ct_event_description,
				'venue_ide' => $item->venue_ide,
				'venue_id' => decrypt($item->venue_ide, 'venue'),
				'venue_name' => $item->venue_name,
				'city_name' => $item->market_name,
				'address1' => $item->where->address1,
				'city' => $item->where->city,
				'zip' => $item->zip,
				'state' => $item->where->state,
				'date_formatted' => $date_formatted,
				'start_date' => $item->start_date,
				'start_time' => $item->when->door_time->formatted,
				'url' => $item->url,
				'ga_price' => $item->prices->ga,
				'venue_type_name' => $item->where->venue_type->name,
				'neighborhood' => $item->where->neighborhood,
				'buy_url' => $item->buy_url,
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
\Website::top($this);
include("pages/events/list.php");
\Website::bottom($this);
