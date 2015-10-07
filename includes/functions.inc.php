<?php
/**
* Global and utility functions
*/

/**
* Parse the event into the url structured
*/
function parseEventUrl($event){

        $prefix = "parties" ;

        if ((is_object($event)) && ($event instanceof \Crave\Api\Event))
                $ct_event = $event->getEvent();
        else
                $ct_event = $event;

        $market_slug = $ct_event->market_slug?:$ct_event->ct_contract->market_slug;
        
        


        if($event->is->bc){
                $event_slug = $event->ct_event_slug ?: $event->slug;
                $prefix = "barcrawl";
                $url = sprintf('/%s/%s_%s' , $market_slug,$prefix , $event_slug);
        }else {

            if(!$event->where && $ct_event->venue){
                $event->where = $ct_event->venue;

            }


            $event_slug = $event->venue_slug ?: $event->where->slug ?: slugize($event->where->name);
            $city = $event->venue_city?:$event->where->city ; 
            $state = $event->venue_state ?: $event->where->state;


            $address_slug = slugize($event->where->address1.' '.$city.' '.$state);

                /**
                * /newyork/parties_cipriani_42nd
                */
                $url = sprintf('/%s/%s_%s_%s' , $market_slug,$prefix , $event_slug,$address_slug);

        }

        $url = strtolower($url);

        return $url;
}


/**
* Build criteria for the event from the uri
*/
function unParseEventUrl($uri){
        global $website ; 


        $bar_crawl_prefix = "barcrawl_";

        $segments = split('/',$uri) ;

        // check if it's a bar crawl .
        if(strpos(strtolower($segments[2]), $bar_crawl_prefix)!== FALSE){

                $slug = substr($segments[2], strlen($bar_crawl_prefix)) ;



                $a = [
                                'where'=> "ct_event.slug ilike '".$slug."'",
                            'status'=>'A'
                        ];

			return $a ;
        }

        $venue_segments = split('_',$segments[2]);

        $market_slug = $segments[1];
        $venue_slug = $venue_segments[1];

        $a = $website->site_criteria ;

        $a['where'] =  array(
                        '(venue.slug = \''.$venue_slug.'\' OR ct_event.slug ILIKE \''.$venue_slug.'\')',
                        "market.slug = '".$market_slug."'"


                );



        return $a ;


}





function addItemToCounterArray(&$arr , $key){
	if($key){
		if(isset($arr[$key] )){
			$arr[$key]++ ;
		}else {
			$arr[$key]=1 ;
		}
	}
}


function getMarketEvents ($market_id){

    global $website;

    $a = array(
        'seller__ct_promoter_id' => $website->ct_promoter_id,
        'ct_promoter_website_id' => $website->ct_promoter_website_id,
        'upcoming'=> true,
        'status'=>'A',
        'order by' => 'random()',
        'ct_category_id' => 1,
        'market_id' => $market_id

    );


    return getLeftRailEvents($a);




}


/**
* Returns a list of events to be used in left / right rails of different pages.
*
* @param int $market_id
* @param bool $refreshed - prevents infinite loop if the function had to be called again .
* @return Array - list of object with url, and title
*
* @todo : add a check that it's not a barcrawl
*/
function getLeftRailEvents($query, $refresh = false){
    global $cache_refresh;

    $cache_key = 'cache::leftrail:market';


    foreach ($query as $key => $value) {
        $cache_key.='::'.$key.':'.$value;

    }



	$cache_name = $cache_key;

    if(!$cache_refresh && !$refresh)
	   $left_events = \mem($cache_name);



	if(!$left_events){

		$left_events = [];


		$left_eventIds = \Crave\Model\ct_event::getList($query);

		foreach ($left_eventIds as $id) {
			$obj = new stdClass ;




			$e = new \Crave\Api\Event(['id'=>$id , 'no_tickets'=> true ]);



			$obj->url = parseEventUrl($e);
			$obj->title = $e->is->bc ?  $e->event_name : $e->where->name;



			$left_events[] = $obj ;
		}



		\mem($cache_name, $left_events , $event_cache_duration);

	} else if (!$refresh && !is_array($left_events)){

        // there has been a problem with the cached data .
        // calling the function again while refreshing the cache
        return getLeftRailEvents($query, true);

    }



	return $left_events;
}


/**
* Generates the buy URL .
*
* @param Array $a
*                 - 'buy_url' : to build the new buy link from the old one.
*
*/
function getBuyUrl(Array $a = []){

    global $cravessl_domain, $website; 

    $event_ide = $a['event_ide'] ;
    
    if (!$cravessl_domain){
        $cravessl_domain ='s2.cravetickets.com'; 
    }


    $seller_ide  = encrypt($website->ct_promoter_id , 'ct_promoter');
    $website_ide = encrypt($website->ct_promoter_website_id, 'ct_promoter_website');

    $url = sprintf("https://%s/purchase/%s/%s/%s?&r=" ,$cravessl_domain, $event_ide, $seller_ide, $website_ide);

    return $url;
}



function getListingPage(){
    global $website; 

    $q = $_GET["q"];

    if ($q){
        $q = "(venue.name ilike '%{$q}%' OR ct_event.name ilike '%{$q}%')";
    }

    $obj = new \Crave\ListingPage([
            'criteria'=>$website->site_criteria,
            'flyer_config'=> array(
                'height' => 300,
                'width' => 191,
                'crop' => 'center'
            ),
            'website' => $website
        ]); 


    return $obj
            ->add_criteria_item('where',$q)
            ->add_criteria_item('market_id',$website->market_id);
}


/**
* Getting dataset from cache, or run the function 
*/
function getFromCache ($key, $func, $cache_time = 0) {
    if ($cache_time === 0){
        $cache_time = rand(10,90);
    }

    $retval = $_GET['refresh']?null:\mem($key);

    if (!$retval){

        $retval = $func(); 
        // d("FROM DB", $retval);
        \mem($key, $retval, "{$cache_time} minutes");
    }
    
    return $retval ;
}
