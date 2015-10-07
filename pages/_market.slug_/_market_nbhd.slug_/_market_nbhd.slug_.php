<?php
if (is_numeric(decrypt(IDE, 'market'))) {
	// load a venue profile
	include('_market.slug_.php'); 
	exit(); 
}



if(!$this->seo){
	$this->seo = new stdClass ();
	$this->seo->title = 'New Years Eve '.$this->vars['market_nbhd_slug'].' | Top NYE Parties | Best Tickets';
}

$filters = ['market_nbhd_id' => $this->vars['market_nbhd_id'], 'is_barcrawl' => false] ;


include('pages/_market.slug_/_market.slug_.php');

