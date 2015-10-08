<?php


$sky_canonical_redirect = array(
    'www.downtowncountdown.net' => 'downtowncountdown.net'
);


error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);


$includes[] = 'includes/functions.inc.php';



// set the locality, to be replaced with a dynamic system.
setlocale(LC_MONETARY, 'en_US');



$website_id = 2; 
$website = new stdClass ; 
$website->ct_promoter_website_id = 15027; // nyec.com
$website->website_id = $website_id; 
$website->ct_promoter_id = 1;
$website->holiday_id = 1;
$website->flyer_type = \Crave\FlyerType::UnBranded;
$website->site_criteria = [
	'upcoming' => true, 
	//'skip_defaults' => true,
	//'ct_campaign_id' => 509 , // new years campaign 2014
	//'ct_campaign_id' => 560 , // new years bar crawl campaign 2014
	'status'=>'A',
	'limit'=>5,
	'ct_category_id' => 1,
	'seller__ct_promoter_id' => $website->ct_promoter_id,
	'ct_promoter_website_id' => $website->ct_promoter_website_id,
    

];

$website->market_id = $market_id;

$market = new \Crave\Model\market($market_id);
$default_image = "/templates/website/content/images/placeholder.jpg";


$website->flyer_config = [
    'height' => 190,
    'width' => 190,
    'crop' => 'center'
];
//$website->ct_promoter_website_id = 5173; // random id for local testing 	
//$website->ct_promoter_website_id = 2357; // newyearseve.com

//$cache_refresh = $_GET['refresh'] == 10 ;

//$_GET['refresh'] = 1;


define ('PHONE_NUMBER' ,'(212) 600-2060');


$myaccount_link = 'http://cravetickets.com/login';




 

