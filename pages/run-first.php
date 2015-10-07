<?php 

global $page , $website;


if(strpos(strtolower($p->uri), 'showevent.aspx')!== FALSE || strpos(strtolower($p->uri), 'shownewyearsevent.aspx')!== FALSE){ // call for an event from old (.NET) site .
	$id = $_GET['eventId'];

	include ('migrate/events.php');

}else if(strpos(strtolower($p->uri), '/new-years-eve/')!== FALSE){ // old market redirect


	$uri = str_replace('/new-years-eve/', '/us/', $p->uri);
	$uri = str_replace('-', '', $uri);
	//$uri = str_replace('/newyork/', '/new-york/', $uri);



	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: ".$uri); 
	die();
}


$breadcrumbs = [];


$this->template_url = "/templates/website/";
$this->show_filters = true ; 

$page = $this ;

$page->title = "New Years Eve Central"; 
$page->website = $website; 
$page->website_ide =  encrypt($website->website_id,'website');

//include('pages/cms-run-first.php');
//$page->seo = \Crave\Model\website_page::getSeoForPage($page);
require_once("templates/website/website.php"); 

/** 
* it's an event url 
*/
if(strpos(strtolower($p->uri), '/parties_')!== FALSE){
	include('pages/events/events.php');
	die();
} else if (strpos(strtolower($p->uri), '/barcrawl_')!== FALSE ){
	include('pages/events/events.php');
	die();
}

$seo_callback = function() use($page){
	$seo = \Crave\Model\website_page::getSeoForPage($page);
	/*if(!$seo){
		// there is no information for the current page; creating a default object so we don't pull from db everytime it loads.
		$seo = new stdClass();
	}*/
	return $seo;
};
//d($page);
//$seo = $seo_callback();
//dd($this, $seo);
$seo = getFromCache(
	"nyec:seo_layer:{$this->uri}:{$this->page_path}", // cache key
	$seo_callback,
	rand(10,90) // random cache time in minutes
);

$this->seo = $seo ; 

//d($page->seo);