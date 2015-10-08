<?php
use \Crave\Model\ct_tbl_assign;

$flyer_config = array(
			//'height' => 1000 ,
			'width' => 333,
			//'crop' => 'center',
			'resize'=>true,
			'limit' => 1

);

$large_config = array(
			'height' => 375 ,
			'width' => 540,
			'crop' => 'center',
			'limit' => 1

);


$thumb_config = array(
			'height' =>65 ,
			'width' => 107,
			'crop' => 'center',
			'limit' => 1

);

$key = 'cache:newyears.com:event-uri:'.$this->uri; 

 unset ($event);
 //$event = \mem($key);

if(!$event){

	// the usage of ide is to prevent the need to handle querystring.
	$a = unParseEventUrl($p->urlpath.'/'.$p->ide);

	$eventIds = \Crave\Model\ct_event::getList($a);

	

	if(count($eventIds) == 0 ){
		// event not found , need to send the user to an error page .
		echo("<h1>EVENT NOT FOUND</h1>");
		die();
	}

	$event = new \Crave\Api\Event($eventIds[0]);

	$desc_arr = [];

	$desc = $event->getDescription([
			'website_ide' => $this->website_ide

		]);


	$list= $event->getVenuePhotos(); 

	$event->buy_url = getBuyUrl(['event_ide'=>$event->ide]);
	$ct_event = $event->getEvent();


	if ($desc){
        //'intro',
		$desc_keys = ['description_leadin', 'description_holiday', 'description_venue', 'description_closing'];

		array_walk($desc_keys , function ($key) use ($desc, &$desc_arr){
			$d = $desc->{$key}; 

			if ($d){
				$desc_arr[] = '<p>'.$d.'</p>';

				
			}
			
		} );




		if (count($desc_arr)){
			$event->description = implode('', $desc_arr);
		}
	}
	elseif($ct_event->is_bc)
	{
		$event->description = $ct_event->ct_contract->ct_barcrawl->description; 
	}


	$flyerId = $ct_event->getFlyer(); 

	if($flyerId){
		$event->flyer = \vf::getItem($flyerId, $flyer_config);
	}

	/**
	* Fetch media for the event .
	*/

	$cache_key = 'newyears.com::cache::event::medias::'.$event->ide ;

	//$medias = mem($cache_key);
	
	if (!$medias){ 
		$medias = $event->getVenuePhotos(['limit'=>10, 'width'=>600, 'height'=>400]);  


		if ($medias && count($medias)){
			foreach($medias as $key=>$media){

				if( is_object($media) ) {
					
					$media->thumb = \vf::getItem($media->id, $thumb_config);


				}
			}

			mem($cache_key, $medias, '20 minutes');
		} 



	}

	$event->medias = $medias; 


}


$right_events = getListingPage()->add_to_criteria(['market_id'=>decrypt($event->market->ide,'market')])->getSideEvents();

$announce_message = $event->getAnnounceMessage(); 

$this->market = $event->market; 

$ct_event = $event->getEvent() ;
$ct_contract = $ct_event->ct_contract;

$flyer = $event->flyer; 
$medias = $event->medias; 

// adding the event to the class making sure it's available throughout the page's life cycle, and make it available for the template , and SEO layer 
$this->event = $event; 


// pieces of HTML to display on the page
$modules = [
	'musiccrowd' => (object)[ 'iorder' => 1 , 'title'=>'Music & Crowd', 'content' => html_entity_decode($event->info->music_crowd)],
	'dresscode' => (object)['iorder' => 2 ,'title'=>'Dress Code', 'content' => html_entity_decode($event->info->dress_code)],
	'Complimentary food' => (object)['iorder' => 3 ,'title'=>'Complimentary Food', 'content' => $event->info->menu],
	'age' => (object)['iorder' => 5 ,'title'=>'Age', 'content' => $event->info->ages],
	'map' => (object)['iorder' => 6 ,'title'=>'Map', 'module' => 'map']
] ;
//DescriptionTicket Details FoodAge

if($event->is->bc){
	$modules['barslist'] = (object)[
		'iorder'=>4,
		'name' =>'barslist', 
		'title' => 'Bars List', 
		'module' => 'bars_list'
	];

}


foreach ($modules as $key => $module) {
	if ($module->module)
		continue; 

	if (empty($module->content)){
		unset($modules[$key]);
	}
}


usort ($modules , function ($a , $b ){
	return $a->iorder == $b->iorder ? 0 : ( $a->iorder > $b->iorder ) ? 1 : -1;
});

if(!$this->seo){
	$this->seo = new stdClass ();
	$this->seo->title = $ct_event->venue->venue_name.' at '.$this->market->name;
}


\Website::top($this);
?>

<?php 
$eventide = $ct_event->venue_ide;

	$clubspecial = array(
	'scPJLUuXHBK',
	'F8MGIChuExf',
	'uwqljg6U7Oy',
	'Ae4ejxxZ5eu',
	'vCLZhyh6RiK',
	'q8C09Uh7AJz'
	);

	if (in_array($eventide, $clubspecial) ){
		$ticketdetails = "Prices";
		} else {
		$ticketdetails = "Ticket Prices";
		}
	?>

<section class="profile_page">
	<div class="page_header">
		<div class="party_info">
			<div class="party_title"><?= $ct_event->venue->venue_name?></div>
			<?php if($event->promotion){?><div class="promotions"> <?= $event->promotion?></div><?php }?>
			<div class="party_location"><?= $event->where->address1?>, Doors Open at <?= $event->when->door_time->formatted?></div>
		</div>
		<a href="#"><div class="buy_tickets">buy tickets</div></a>
		<ul class="page_nav">
			<li class="page_link"><a href="#">tickets</a></li>/
			<li class="page_link"><a href="#">description</a></li>/
			<li class="page_link"><a href="#">music & crowd</a></li>/
			<li class="page_link"><a href="#">dress code</a></li>/
			<li class="page_link"><a href="#">age</a></li>/
			<li class="page_link"><a href="#">menu</a></li>
		</ul>
	</div>
	
		<!-- <div class="flyer">

		<?php
				$params = [
				'ide' => $ct_event->ide,
				'type' => 'branded',
				'width' => '337',
				'height' => '337',
				'media_items' => $ct_event->media_items
			];

			$flyer_image = Sky\VF\ImageManager::get_flyer_array($params);
		?>

		<img src="<?= $flyer_image?>"/> 

		</div> -->
		<div class="description_row">
			<div class="description">
				<div class="heading">Description</div>
				<?= $event->description?>
			</div>

			<div class="venue_gallery">
				<div class="carousel">
					<div class="display">
					<?php
					if($event->medias){
					 ?>
						<img class="big-pic" src="<?=$event->medias[0]->src?>" alt="<?= $image->alt_text?>" title="<?= $image->alt_text ?>" />
					<?php }else{ ?>
					This venue has no images
					<?php } ?>
					</div>
					
					<span>Scroll to see images. Click to enlarge</span>
					<div class="thumbnails">					
					<?php
					$venue = new \Crave\Model\Venue($event->where->ide);
					$media_items = json_decode($venue->media_items);
					if($media_items){
					$venue = new \Crave\Model\Venue($event->where->ide);
					$media_items = json_decode($venue->media_items);			
					 foreach ($media_items as $item) {
					 	$image = \Sky\VF\ImageManager::get_venue_image_src($item, NULL, NULL, $this->website_ide);
					 ?>
						<img class="small-pic" src="<?= $image->src?>" alt="<?= $image->alt_text?>" title="<?= $image->alt_text ?>" />
					<? }
					}?>
					</div>
				</div>
			</div>
		</div> <!-- end description row -->

		<div class="ticket_info">
			<div class="heading">Tickets</div>
		<?php foreach ($event->tickets as $tickets) { ?>
			<div class="ticket_row">
				<div class="left_col">
					<span class="ticket_type"><?= $tickets->name?></span>
					<span class="v">v</span>
					<span class="ticket_details"><a href="javascript:void(0);">Ticket Details</a></span>
				<div id="ticket-drop" class="ticket-lists">
					<?= $tickets->description?>
				</div>
				</div>
				<div class="right_col">
					<span class="price">$<?= $tickets->price?></span>
					<a href="<?= $event->buy_url?>"><div class="buy_tickets">buy tickets</div></a>
				</div>
			</div>
		<?php } ?>
		</div>
		
		<!-- <div class="music_crowd">
			<span class="heading">Music & Crowd</span>
			<span class="page_top"><a href="#top">Back to Top</a></span>
			<div class="mc_row">
				<div class="topic">Music:</div>
				<p><?= $event->info->music_crowd?></p>
				<div class="topic">Crowd:</div>
				<p><?= $event->info->dress_code?></p>
			</div>
		</div> -->

		<?php 
		foreach ($modules as $key=>$module) {
			if ($module->module){
				include("modules/{$module->module}.php"); 
			}else if($module->content){	?>

			<div id="<?= $key ?>">
					<h5 class="heading"><?=$module->title?></h5>
					<!-- <span class="page_top"><a href="#top">Back to Top</a></span> -->
					<p><?= $module->content ?></p>
			</div>
		<?php 
				}
			}
			
		?>
</section>


<script>
$(function(){
	//$('#imgMain')

	$('.thumbs img').each(function(){
		$(this).bind('mouseover' , function(){
			var src = $(this).attr('data-large');
			$('#imgMain').attr('src',src);
		});
	});
	
});

$(window).load(function() {
  $('.tix-detail').click(function() {
	$(this).parent().siblings('.tix-info').slideToggle(600);
  });
  
});


 $(document).ready(function() {
    $(".slidelist dt a").on("click", function( e ) {
        e.preventDefault();
        $("body, html").animate({ 
            scrollTop: $( $(this).attr('href') ).offset().top  - 20}, 300);
		});
});
</script>

<!-- End Social button codes -->
<?php
\Website::bottom();
?>