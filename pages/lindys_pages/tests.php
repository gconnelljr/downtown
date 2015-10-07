<?php 


$events_callback = function() {
 $list = \Crave\Model\ct_event::getMany(array(
 'upcoming' => 1, 
 //'seller__ct_promoter_id' => 7400,
 'producer__ct_promoter_id' => 7400,
 'limit' => 4, 
 'order_by' => "ct_contract_date.start_date"

 ));



 $events = array_map( function ($item) {
 
 return (object)[
 'ide' => $item->ide, 
 'market_name' => $item->ct_contract->market_name ,
 'start_date'  => $item->ct_contract->dates[0]->start_date, 
 'venue_name'  => $item->venue->venu_name,
 'media_items' => $item->media_items

 ];

 }, $list) ;

 return $events; 

};


$upcoming_events = getFromCache(
 "lindys:homepage:upcoming-events", // cache key
 $events_callback,
 rand(20,60) // random cache time in minutes
);

//dd($events_callback());
dd($upcoming_events);

