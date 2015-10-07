<?php 

global $website ,$cache_refresh;


?>

<section id="list-places"> <!-- state/place list -->
   <a id="markets_list" name="markets_list"></a>
   <span class="list-caption">choose city for your new year's destination</span>
	<nav>
<?php

	$cache_name = sprintf('jwebsite:%/id:markets_footer',$website->ct_promoter_website_id);

	if(!$cache_refresh) {
		\elapsed("Footer : Getting the markets from cache") ;
		$markets = mem($cache_name); 
	}
	

	if(!$markets){
		$markets = [] ;


		$marketIds = \Crave\Model\market::getSlugsFeed([
				'ct_promoter_website_id' => $website->ct_promoter_website_id,
				'where'=>["country_code='US'"] , 
				'order_by' => 'name'
			]); 


			foreach($marketIds as $marketId){
					$market = new \Crave\Model\Market($marketId); 

					if (!$market->country_code) {
						$market->country_code = 'us';
					}

					$market->url = strtolower("/".$market->slug);


				$markets[] = $market ; 
					
				
			}



		mem($cache_name ,$markets , '10 hours');


	}



		
		$panels = [] ;

		$delimiter_index = ceil(count($markets)/6); 


		$index = -1  ;

		

		foreach($markets as $market){
			$panels[(++$index)/$delimiter_index][] = $market; 
		}
			
		foreach($panels as $panel){
	?>
		<ul id="place-list">
			<?php 
				foreach($panel as $market) {
			?>
			<li><a href="<?= $market->url ?>" style="<?= $market->target?"font-weight:bold;":""?>"><?= $market->name ?></a></li>
			<?php 
			}
			?>
		</ul>
	<?php
		}

?> 

	


		</nav>
	</section> <!--end state/place list -->