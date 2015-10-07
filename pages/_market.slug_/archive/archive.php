<?php
use \Crave\Model\ct_event;

global $website;

$config = new stdClass ;

$config->show_venue_type =  true;

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

$media_config_small = array(
			'height' => 300,
			'width' => 191,
			'crop' => 'center'
);

$a = array(
	'seller__ct_promoter_id' => $website->ct_promoter_id,
	'ct_promoter_website_id' => $website->ct_promoter_website_id,
    'upcoming'=> false,
    'status'=>'A',
    'order by' => 'random()',
    'ct_category_id' => 1,
	'market_id' => $market_id

);



// bar crawls for that market was clicked .
if($this->ide == 'bar-crawls'){
	$config->show_venue_type = false;

	// adding the barcrawls filters
	$filters = ['is_barcrawl' => true] ;
	$page->title = "Bar Crawls";
}



// handling search request.
if(isset($_GET['q']) && !empty($_GET['q'])){
	$a['where'][] = "(venue.name ilike '%{$_GET[q]}%' OR ct_event.name ilike '%{$_GET[q]}%')";
}


// merging any pre-existing filters ,will allow us to create customized pages in the future .
if(isset($filters) && is_array($filters)){
	$a = array_merge($a, $filters);
}



// load current market
$market = new \Crave\Model\market($market_id);
$this->market = $market ;

$left_rail_query = [
	'override_order_by' => true,
	'order_by' => 'venue.name',
	'min'=>true
];


// Loading the left rail using the original query, only sorted by name
$left_rail_query = array_merge($a, $left_rail_query) ;


$venue_types = $market && $market->id && $config->show_venue_type?$market->getActiveVenueTypes($a):null;


// load events
$eventIds = \Crave\Model\ct_event::getList($a);
//$events = [] ;


// multi-dimentional array for the left rail filters
$filters_list = [];

// Add venue type to the list of filters on the left rail .
if($venue_types && count($venue_types)){



	$total = 0;
	foreach ($venue_types as $type) {
		$type->title = $type->name_plural;
		$type->url = '/us/'. $market->slug . '/' . $type->slug;

		$total+= $type->total;

	}


	// Adding 'Show all' filter
	$fix_obj = new stdClass ;

	$fix_obj->title = 'All';
	$fix_obj->url = '/us/'.$market->slug;
	$fix_obj->total = $total;

	// adding it to an array, so we can merge with the other filters.
	$all_array = [
		$fix_obj
	];


	$obj = new stdClass;
	$obj->title = 'Venue Types' ;
	$obj->items = array_merge ($all_array, $venue_types);

	$filters_list[] = $obj;
}


$nhoods = [] ;
$ages =[];
$event_types = [];
$event_times = [];






foreach($default_markets as $m )
{
	if($m['market_id'] == $market->id){
		$this->market_summary = $m['market_summary'];

		$show_concierge = true;
	}
}





include('pages/events/list.php');

