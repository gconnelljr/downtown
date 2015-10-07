<?php
// if($page->urlpath == '/us'){
// 	redirect('/');
// }
$url_piece = explode('/', $page->uri);
$market_slug = $page->vars['market_slug'];

if(class_exists (Website)){
	// we can assume that there had been a call to the old templates

	if ($template_area == 'top') 
{		Website::top() ;
	}
	else if ($template_area == 'bottom') {
		Website::bottom() ;
	} 

}else{
	class Website {



		public static $js = [


            'http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js',
//			'{template}js/jquery-2.0.0.min.js',
			//'/lib/js/jquery-migrate-1.2.1.js',
			'http://code.jquery.com/jquery-migrate-1.2.1.min.js',

			'/lib/js/aqlForm.js',

			// '/templates/html5/cms-html5.js',
			// '/lib/history.js/scripts/compressed/history.js',
			'/lib/history.js/scripts/compressed/history.html4.js',
			'/lib/history.js/scripts/compressed/history.adapter.jquery.js',
			'{template}js/jquery.flexslider-min.js',
			// '{template}js/jquery.carouFredSel-6.2.1.js',
			'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js',
			// '{template}js/jquery.custom_radio_checkbox.js',
			// '{template}js/tinybox.js',
			//'/lib/history.js/scripts/compressed/history.html4.js',
			//'/lib/history.js/scripts/bundled/html4+html5/jquery.history.js',
	        '/lib/js/jquery.livequery.min.js',
			'http://www.cravetickets.com/toolbar/embed.js?brand=crave',
			
			'/lib/js/sky.utils.js',
			'/templates/html5/html5.js',
			'/templates/website/website.js'
		] ;
		
		static  $template_url = "/templates/website/";



		/** 
		* @param Object $container   the page that contains the template 
		*/
		public static function top($container = null ) {
			global $active_tab, $page;

			// making sure we don't get error while trying to use the SEO layer down the page .
			if($page){

                $page->js = array_map(function($item){
                    return str_replace('{template}', self::$template_url, $item);
                }, self::$js) ;


            } else
				$page = new stdClass ;


			// if(!$page->seo)
			// 	$page->seo = array() ;

			// // assign SEO values 
			// self::buildSeo();
			

			if(!$active_tab)
				$active_tab = '/' ;

			$tabs = [
				// [
				// 'url' => '/', 
				// 'title' => 'Home' ],

				[
				'url' => '#markets_list',
				'title' => 'Events',  ],

				[
				'url' => '/timessquare', 
				'title' => 'Times Square' ],
				[
				'url' => '/partypasses', 
				'title' => 'Party Passes' ],

				
//				[ 
//				'url' => '/us/pier36-nyc-edm-shows', 
//				'title' => 'Pier 36' ],
//
				[
				'url' => '/bar-crawls', 
				'title' => 'Bar Crawls' ],

				[
				'url' => '/cruises', 
				'title' => 'Cruises' ],

				[
				'url' => '/dinners', 
				'title' => 'Dinners' ],

				

			]; 

			



			$market_name  = 
				($container && $container->market) ? $container->market->name : 'Choose City' ;
				
				
	//TAKEOVER
	$takeover = new stdClass () ;
	$takeover->active = FALSE;

	$takeover->background_image = "" ;
	$takeover->background_link_active = FALSE;
	$takeover->background_link = "" ;
	$takeover->losangeles  = TRUE;
	$takeover->la_bg  = self::$template_url . "content/images/takeover/belvedere_skin.jpg";

	$template_url = "/templates/website/";

		// Get markets for city dropdown
	$where = 'market.skybox=1';
	$orderby = 'market.name ASC';
	$params = ['where'=>$where,'order_by'=>$orderby]; 

	// Featured array
	$featured_array = [
	"newyork"=>"New York", 
	"brooklyn"=>"Brooklyn",
	"newyork"=>"Manhattan",
	"queens"=>"Queens",
	"boston"=>"Boston", 
	"newjersey"=>"New Jersey", 
	"philadelphia"=>"Philly", 
	"baltimore"=>"Baltimore", 
	"washington"=>"Washington DC", 
	"miami"=>"Miami", 
	"losangeles"=>"Los Angeles", 
	"chicago"=>"Chicago", 
	"atlanta"=>"Atlanta"
	];
	$markets = \Crave\Model\market::getMany($params);
	$num_cols = 3;
	$per_col = ceil(sizeof($markets)/$num_cols);
	foreach ($markets as $key => $m) {
		if ($m->country_code != 'US') {
			$other_markets[$m->country_code][] = $m;
			unset($markets[$key]);
		}
	}

	// Set url for markets 
	$url_piece = explode('/', $page->urlpath);
	unset($url_piece[0]); //remove first value since we know it's blank
	unset($url_piece[1]); //remove first value since we know it's the market

	$new_url = "";
	foreach($url_piece as $up){
		$set_url .= "/" . $up;
	}
	foreach ($markets as $key =>$m) {
		$columns[floor(($key+1)/$per_col)][] = $m;
	}
	// Get slugs for all markets
	$selected_market = [];
	foreach($markets as $m){
		$selected_market[$m->slug] = $m->name;
	}

	// Check if queryfolder is in array of markets
	if($page->vars['market_slug'] != "" && array_key_exists($page->vars['market_slug'], $selected_market)){
		setcookie("current_market", $page->vars['market_slug']);
		$_SESSION['current_market'] = $page->vars['market_slug'];
	} 

	$t=time();
	$market_slug_id = $page->vars['market_id'];
	$_GET['refresh']=1;

	if ($page->market && ! $page->seo) {
		 $page->seo = new stdClass ();  
	}
	// Meta_tag Formats pulled from page.php
	if ($page->market && ! $page->seo->geo) {
			$page->seo->geo = new stdClass (); 
			$page->seo->geo->latitude =  $page->market->latitude;
			$page->seo->geo->longitude = $page->market->longitude;
			$page->seo->geo->city = $page->market->city;
			$page->seo->geo->state = $page->market->state;
			$page->seo->geo->country = $page->market->country_name;	
			$page->seo->geo->geo_position = $page->market->latitude ."; ". $page->market->longitude;
			$page->seo->geo->geo_region = $page->market->state;
			
	}
	?>

	<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1">-->
		<?php if(is_object($page->seo) && !is_null($page->seo)): ?>
			<title><?= $page->seo->title ?></title>
			<?php
			    $meta_tag = $page->seoMetaContent();// Meta_tag display pulled from page.php
				foreach ($meta_tag as $key => $val) {
			?>
			    <meta name="<?= $key ?>" content="<?= $val ?>" />
			<?php  } ?>
			
			<meta property="og:title" content="<?= $page->seo->meta_title ?>" />
			<meta property="og:type" content="<?= $page->seo->domain ?>" />
			<meta property="og:url" content="<?= $page->seo->url ?>" />
		<?php else: ?>
			<!-- <title>New Year's Eve Central</title> -->
			<meta name="subject" content="" />
			<meta name="title" content="" />
			<meta name="Description" content="" />
			<meta name="Keywords" content="" />
			<meta property="og:title" content="newyearsevecentral.com" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="Newyearsevecentral.com" />
		<?php endif; ?>
		<link rel="stylesheet" href="<?=$template_url?>content/style.css" type="text/css">
		<link rel="stylesheet" href="<?=$template_url?>content/sidr.dark.css" type="text/css">
		<script src="<?=$template_url?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="<?=$template_url?>website.js" type="text/javascript"></script>
		<script src="<?=$template_url?>js/jquery.carouFredSel-6.0.4-packed.js" type="text/javascript"></script>
		<script src="<?=$template_url?>js/jquery.sidr.js" type="text/javascript"></script>
		<script src="<?=$template_url?>js/jquery.sidr.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="top_space" id="top"></div>
		<header class="header_container">
			<a href="/<?= $_SESSION['current_market'] ?>"><img class="nye_logo" src="<?=$template_url?>content/images/nye_logo.png" alt="nye logo" title="nye logo" /></a>
			<nav class="header_nav">
				<div class="chosen_city">
				<?php if($page->uri !== "/"): ?>
					<a class="city_color drop_menu">Choose City</a>
					<div class="featured_cities">
						<div class="featured-city"><a href="/newyork<?= $set_url ?>" target="_self" class="featured market_link">New York</a></div>
						<div class="featured-city"><a href="/atlanta<?= $set_url ?>" target="_self" class="featured market_link">Atlanta</a></div>
						<div class="featured-city"><a href="/baltimore<?= $set_url ?>" target="_self" class="featured market_link">Baltimore</a></div>
						<div class="featured-city"><a href="/boston<?= $set_url ?>" target="_self" class="featured market_link">Boston</a></div>
						<div class="featured-city"><a href='/brooklyn<?= $set_url ?>' target="_self" class='sub_market market_link'>Brooklyn</a></div>
						<div class="featured-city"><a href="/chicago<?= $set_url ?>" target="_self" class="featured market_link">Chicago</a></div>
						<div class="featured-city"><a href="/losangeles<?= $set_url ?>" target="_self" class="featured market_link">Los Angeles</a></div>
						<div class="featured-city"><a href="/miami<?= $set_url ?>" target="_self" class="featured market_link">Miami</a></div>
						<div class="featured-city"><a href='/manhattan<?= $set_url ?>' target="_self" class='sub_market market_link'>Manhattan</a></div>
						<div class="featured-city"><a href="/newjersey<?= $set_url ?>" target="_self" class="featured market_link">New Jersey</a></div>
						<div class="featured-city"><a href="/philadelphia<?= $set_url ?>" target="_self" class="featured market_link">Philadelphia</a></div>
						<div class="featured-city"><a href="/washington<?= $set_url ?>" target="_self" class="featured market_link">Washington DC</a></div>
						<div class="featured-city"><a href='/queens<?= $set_url ?>' target="_self" class='sub_market market_link'>Queens</a></div>
									<span class='change-city other-cities'>Other Cities</span>
								<div class="non-featured-cities">
									<!-- Display cities that are not featured -->
									<?php if(is_array($columns)): ?>
										<?php foreach($columns as $key => $col): ?>
												<?php foreach($col as $market): ?>
													<?php if(!array_key_exists($market->slug, $featured_array)): ?>
														<div class="non-featured-city"><a href="<?= '/' . $market->slug . $set_url ?>" target="_self" class="market_link"><?=$market->name?></a></div>
													<?php endif; ?>
												<?php endforeach; ?>
										<?php endforeach; ?>
									<?php endif; ?>

									<?php if($other_markets): ?>
										<?php foreach($other_markets as $key => $markets): ?>
											<?php foreach($markets as $m): ?>
												<?php if(!array_key_exists($market->slug, $featured_array)): ?>
													<div class="non-featured-city"><a href="<?= '/' . $m->slug . $set_url ?>" target="_self" class="market_link"><?=$m->name?></a></div>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
					</div>
					<a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : 'newyork' ?>" class="city_chosen" target="_self"><?= $_SESSION['current_market'] ? $selected_market[$_SESSION['current_market']] : 'New York'?></a>
				<?php else: ?>
					<a href="#" class="nav_link city_color drop_menu select_city">choose city</a>
				<?php endif; ?>
				</div>
				<a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : 'newyork' ?>/events" class="nav_link <?= strpos($page->uri, 'events') ? 'active_nav' : '' ?>">parties</a>
				<a href="/timessquare" class="nav_link <?= strpos($page->uri, 'timessquare') ? 'active_nav' : '' ?>">times square</a>
				<a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : 'newyork' ?>/partypasses" class="nav_link <?= strpos($page->uri, 'partypasses') ? 'active_nav' : '' ?>">party passes</a>
				<a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : 'newyork' ?>/dinners" class="nav_link <?= strpos($page->uri, 'dinners') ? 'active_nav' : '' ?>">dinners</a>
				<a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : 'newyork' ?>/cruises" class="nav_link <?= strpos($page->uri, 'cruises') ? 'active_nav' : '' ?>">cruises</a>
				<a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : 'newyork' ?>/hotels" class="nav_link <?= strpos($page->uri, 'hotels') ? 'active_nav' : '' ?>">hotels</a>
				<a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : 'newyork' ?>/bar-crawls" class="nav_link <?= strpos($page->uri, 'bar-crawls') ? 'active_nav' : '' ?>">bar crawls</a>
				<a href="http://cravetickets.com/sell-tickets/get-started?ref=newyearscentral.com" rel="nofollow" target="_blank" class="nav_link post_party">post a party</a>
				<a href="http://cravetickets.com/contact?ref=newyearscentral.com" rel="nofollow" target="_blank" class="nav_link concierge">concierge</a>
			</nav>
			
			<a id="right-menu" class="tiny button secondary radius" href="#sidr_nav">
				<!-- <span class="menu">Menu</span> -->
				<span><img src="<?=$template_url?>content/images/nav_icon.png" alt="nav icon" title="Check out our menu" /></span></a>
			
			<ul class="sidr">
				<li><a href="#" class="nav_link choose_city">choose city</a></li>
				<li><a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : /*$_COOKIE['current_market']*/ 'newyork' ?>/events" class="nav_link">parties</a></li>
				<li><a href="/timessquare" class="nav_link">times square</a></li>
				<li><a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : /*$_COOKIE['current_market']*/ 'newyork' ?>/partypasses" class="nav_link">party passes</a></li>
				<li><a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : /*$_COOKIE['current_market']*/ 'newyork' ?>/dinners" class="nav_link">dinners</a></li>
				<li><a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : /*$_COOKIE['current_market']*/ 'newyork' ?>/cruises" class="nav_link">cruises</a></li>
				<li><a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : /*$_COOKIE['current_market']*/ 'newyork' ?>/hotels" class="nav_link">hotels</a></li>
				<li><a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : /*$_COOKIE['current_market']*/ 'newyork' ?>/bar-crawls" class="nav_link">bar crawls</a></li>
				<li class="post_party"><a href="http://cravetickets.com/sell-tickets/get-started?ref=newyearscentral.com" class="nav_link">post a party</a></li>
				<li class="concierge"><a href="http://cravetickets.com/contact?ref=newyearscentral.com" class="nav_link">concierge</a></li>
			</ul>
				
		</header>

				<div class="banner_container">
			<div class="banner_content">
				<div class="main_col">
					<h1 class="city"><?=$page->seo->h1 ?> </h1>
					<div class="search_row">
						<span>find a party</span>
						<form action="#" id="searchevents" method="GET">
							<input type="text" class="topsearch search_field" placeholder="SEARCH BY VENUE NAME, CITY, STATE, ZIP" name="q" value="<?= $_GET['q'] ?>">
							<input class="search_btn" type="submit" value="SEARCH">
						</form>
					</div>
				</div>
				<div class="side_col">
					<div class="questions">Question about a party?</div>
					<div class="customer_service">Customer Service <span>917-300-0930</span></div>
				</div>
			</div>
		</div>

		<style>
		.chosen_city {
		    display: inline-block;
		    vertical-align: top;
		}

		a.city_chosen {
		    display: block;
		    text-align: center;
		    font-size: 10px;
		}
		</style>

<script>
$(document).ready(function() {
    $('#right-menu').sidr({
      name: 'sidr-existing-content',
      side: 'right',
      source: '.sidr'
    });
});
</script>



<?php 

	}  



		public static function bottom () { // template_area  
			global $page , $p , $website ;
			
			//}
	?>

		
		<footer>
			<div class="vip_link"><a href="/<?= $_SESSION['current_market'] ? $_SESSION['current_market'] : /*$_COOKIE['current_market']*/ 'newyork' ?>">Newyearsevecentral.com</a></div>
			<div class="footer_row">
				<div class="leftcol col">
					<span>Customer Service</span>
					<div>917-300-0930</div>
					<div>info@Newyearsevecentral.com</div>
				</div>
				<div class="right-middlecol col">
					<div><a href="/about-us">About</a></div>
					<div><a href="/terms-and-conditions">Terms and Conditions</a></div>
					<div><a href="/privacy-policy">Privacy Policy</a></div>
				</div>
				<div class="rightcol col">
					<span>Connect With Us</span>
					<div class="social_media">
						<a href="https://www.facebook.com/JoonbugNYC"><img src="/templates/website/content/images/foot-fb.png" alt="facebook" title="facebook" /></a>
						<a href="https://twitter.com/JoonbugBuzz"><img src="/templates/website/content/images/foot-tw.png" alt="twitter" title="twitter" /></a>
						<a href="https://instagram.com/joonbugbuzz/"><img src="/templates/website/content/images/foot-ig.png" alt="instagram" title="instagram" /></a>
					<!--	<a href="#"><img src="/templates/website/content/images/foot-gp.png" alt="google" title="google" /></a> -->
					</div>
				</div>
			</div>
			<div class="copyright">© 2015 Newyearsevecentral.com™ All rights reserved. Sitemap.</div>
		</footer>
	</body>
</html>

<?php 
if($_GET['seo_debug'] == 1){
	d($page);
}
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1583693-4']);
  _gaq.push(['_setDomainName', 'newyearsevecentral.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	<?php 
		

		//$page->template('html5','bottom');

		} // close footer


		/**
		* print out a simple meta tag, but only if it has value.
		*/
		public static function buildMetaTag($title, $value)
		{
			if($value && !empty($value))
			{
				echo("<meta name=\"$title\" content=\"$value\" />\n");
			}

		}

		// public static function buildSeo() {

		// 	global $page;


		// 	if(!$page->seo)
		// 		$page->seo = array();

		// 	if(!$page->seo['phone'])
		// 		$page->seo['phone'] = PHONE_NUMBER; 

		// 	if($page->event){
		// 		// assign default meta tags for event 
		// 		$page->seo['ICBM'] = $page->seo['ICBM']?:$page->event->where->latitude.';'.$page->event->where->longitude;
		// 		$page->seo['geo-position'] = $page->seo['geo-position']?:$page->event->where->latitude.','.$page->event->where->longitude;
		// 		$page->seo['meta_title'] = $page->seo['meta_title']?:$page->event->where->name." New Year's in ".$page->event->where->city." | A-List New Year's Parties &amp; Events";

		// 		$page->seo['meta_description'] = 
		// 					$page->seo['meta_description'] ?: 
		// 					$page->event->where->name." New Year's in ".$page->market->name." - Find Best of the Best New Years Eve Events at Top Clubs, Lounges, Bars, Hotels. Ring in NYE dancing &amp; toasting - famous DJs Open Bar - Get Tixs Now"; 
						
		// 	} else if($page->market){
		// 		// assigning default value for market SEO if wasn't overriden 
		// 		$page->seo['meta_title'] = 
		// 					$page->seo['meta_title'] ?: 
		// 					"New Years ".$page->market->market1 ." Parties | Top New Year Venues | Tix Online"; 

		// 		$page->seo['meta_description'] = 
		// 					$page->seo['meta_description'] ?: 
		// 					"New Year's Parties at Top Clubs, Bars, Lounges - Your Destination Guide to A-list Venues, New Year Cruises, New Year Bar Crawls - Online Tickets or call ".$page->seo['phone']; 
							
		// 		$page->seo['h1'] = $page->seo['h1'] ?: "New Year's ".$page->market->market1." Parties"; 

				
		// 	}

		// 	// Assign default values if none were assigned to that point .
		// 	$page->seo['meta_title'] = $page->seo['meta_title'] ?: "New Year's Parties Worldwide | Top Events | NYC Chicago Boston Miami Philly | Buy Tix";
		// 	$page->seo['meta_description'] = $page->seo['meta_description'] ?: 
		// 					"New Year's events showcasing NYC nightlife &amp; celebrations at top clubs, lounges, bars, private event space and hotels. More Venues, More Tix - Buy Now"; 
		// 	$page->seo['meta_keywords'] = $page->seo['meta_keywords'] ?: "NewYears.com"; 
		// 	$page->seo['meta_subject'] = $page->seo['meta_subject'] ?: "NewYears.com"; 
		// } // buildSeo


	} // class Website

} // end of class_exists condition 