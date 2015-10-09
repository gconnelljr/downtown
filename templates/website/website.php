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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Downtown Countdown</title>
		<link rel="stylesheet" href="<?=$template_url?>website.css" type="text/css">
		<link rel="stylesheet" href="<?=$template_url?>content/sidr.dark.css" type="text/css">

		<link rel="stylesheet" href="<?=$template_url?>owl.transitions.css" type="text/css">
		<link href="<?=$template_url?>owl.carousel.css" rel="stylesheet">
		<link href="<?=$template_url?>owl.theme.css" rel="stylesheet">

		<script src="<?=$template_url?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="<?=$template_url?>website.js" type="text/javascript"></script>
		<script src="<?=$template_url?>js/jquery.carouFredSel-6.0.4-packed.js" type="text/javascript"></script>
		<script src="<?=$template_url?>js/jquery.sidr.js" type="text/javascript"></script>
		<!-- <script src="<?=$template_url?>js/myjs.js" type="text/javascript"></script> -->
		<script src="<?=$template_url?>js/jquery-ui.js" type="text/javascript"></script>
		<script src="<?=$template_url?>/owl.carousel.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="top_space" id="top"></div>
		<header>
			<div class="container">
				<img class="logo" src="<?=$template_url?>content/images/countdown-logo.png" alt="" />
				<div class="counter_col">
					<div class="social_media">
						<span>share with friends</span>
						<a href="#"><img src="<?=$template_url?>content/images/fb.jpg" alt="" /></a>
						<a href="#"><img src="<?=$template_url?>content/images/tw.jpg" alt="" /></a>
						<a href="#"><img src="<?=$template_url?>content/images/ig.jpg" alt="" /></a>
					</div>
					<div class="counter"></div>
					<!-- <form><input type="text" placeholder="Search"></form> -->
				</div>
			</div>

			<div class="nav_row">
				<nav>
					<a href="/newyork"><li>new york</li></a>
					<a href="/baltimore"><li>baltimore</li></a>
					<a href="/washington-dc"><li>washington</li></a>
					<a href="/atlanta"><li>atlanta</li></a>
				</nav>
			</div>
		</header>

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
			<div class="site_url">DowntownCountdown.net</div>
			<div class="left_col col">
				<div class="cust_service">CUSTOMER SERVICE</div>
				<div class="cust_num">1.800.000.0000</div>
				<div class="email">Email Address Placeholder</div>
			</div>
			<div class="copyright">© 2015 All Rights Reserved</div>
		</footer>
	</body>
</html>

<?php 
if($_GET['seo_debug'] == 1){
	d($page);
}
?>
<script type="application/javascript">
	var myCountdown2 = new Countdown({
	target:"counter", 
	year	: (new Date().getFullYear()) +1 ,
	ampm	: "am",	
	month	: 1, 
	day		: 1,
	width	: 230, 
	height	: 40,
	rangeHi:"month"	// <- no comma on last item!
	});
</script>

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