<?php
use \Crave\Model\ct_event;

global $website;

if(!$this->seo){
	$this->seo = new stdClass ();
	$this->seo->title = $this->vars['ct_category_slug'];
}

if (!$this->seo->title) {
	$this->seo->title = $this->ide.' Downtown Countdown';
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


\Website::top($this); ?>

<section class="listings_page container pages">
	<section class="introduction">
		<div class="container">
			<h1><?= $this->seo->h1?></h1>
			<p>Downtown Countdown is your global source for the biggest and best New Year’s Eve parties. Celebrate New Year's with a million of your closest friends in some of the best clubs, lounges, event spaces, restaurants, cruises, etc. We are the worldwide destination for New Year's Eve revelers with more than 60 fabulous New Year's events.</p>
		</div>
	</section>

	<aside>
		<div class="price">
			<div class="heading">Events from A-Z</div>
			<ul>
			<?php foreach ($left_events as $events) {?>
				<li><a href="<?= $events['url']?>"><?= $events['venue_name'] ?></a></li>
			<?php } ?>
			</ul>
		</div>
	</aside>

	<main>
		<div class="top_div clear">
			<div class="list_map clear">
				<a href="#"><img src="<?= $template_url?>content/images/list.jpg" /></a>
				<a href="#"><img src="<?= $template_url?>content/images/map.jpg" /></a>
			</div>
			<div class="heading"><?= count($events);?> results found</div>
		</div>

		<div class="listing_row">
		<?php foreach ($main_events as $events) {
		$stripped_text = strip_tags($events['description']);
		$first_sentence = $stripped_text !== "" ? substr($stripped_text, 0, strpos($stripped_text, ' ', 260)) : 'BarCrawl';

		$params = [
			'ide' => $events['ide'],
			'type' => 'branded',
			'width' => '147',
			'height' => '147',
			'media_items' => $events['media_items']
		];

		$flyer_image = Sky\VF\ImageManager::get_flyer_array($params);

		?>
		<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "Event",
		  "location": {
		    "@type": "Place",
		    "address": {
		      "@type": "PostalAddress",
		      "addressLocality": "<?= $events['city'] ?>",
		      "addressRegion": "<?= $events['state'] ?>",
		      "postalCode": "<?= $events['zip'] ?>",
		      "streetAddress": "<?= $events['address1'] ?>"
		    },
		    "name": "<?= $events['venue_name'] ?>"
		  },
		  "name": "<?= $events['venue_name'] ?>",
		  "startDate": "<?= $events['start_date'] ?>"
		}
	</script>
			<div class="listing_img">
				<a href="<?= $events['url']?>"><img src="<?= $flyer_image ?>" alt="" /></a>
			</div>
			<div class="listing_content">
				<div class="listing_header">
					<span class="name"><?= $events['venue_name']?></span>
					<span class="address"><?= $events['address1']?>, <?= $events['city']?>, <?= $events['state']?> <?= $events['zip']?></span>
				</div>
				<p><?= $event['description']?></p>
				<div class="listing_btns">
					<a href="<?= $events['url']?>"><div class="info_btn btn">more info</div></a>
					<a href="<?= $events['buy_url']?>"><div class="buy_btn btn">buy now</div></a>
				</div>
			</div>
		<?php } ?>
		</div>
	</main>
</section>

<?php
\Website::bottom($this);