<?php 
global $website;
$event_id = 7852; 
$key = 'cache:special-event:'.$event_id; 
//$event = \mem($key); 

$buy_url = 'https://secured.cravetickets.com/purchase/pXdEE7aA3vv/rquNesCME11/Bwfj5f5vP87?&r=newyears.com';
if(!$event){
	$event = new \Crave\Model\ct_event($event_id);



	\mem($key,$event,'5 minutes');

}

$page->title = ""; 
$this->event = $event; 

\Website::top($this);
?>

<link rel="stylesheet" href="<?= $this->template_url ?>content/vip-event.css" />
<section class="maincontent">	

<img style="width: 100%;" src="<?= $this->template_url ?>content\images\vip-event\W-Header.jpg" alt="<?= $event->event_name ?>" />

		
	<section class="blue-top" itemscope itemtype="http://schema.org/Event">
			<div class="profile-info">
				<h1 class="profile-title" itemprop="name"><?= $event->event_name?></h1>
				<span itemprop="location" itemscope itemtype="http://schema.org/Place">
				<span class="floattag">Location:</span> 
				<span class="profile-loc" itemscope itemtype="http://schema.org/PostalAddress">
				<span itemprop="streetAddress">2201 Collins Avenue, </span>
				<span itemprop="addressLocality">Miami, FL </span>
				<span itemprop="addressPostalCode">33139</span>
				</span>
				</span>
				<br />
				
				
				<span class="floattag">Date:</span> <span class="profile-date">
				<span itemprop="startDate">Wednesday, December 31st, 2014 | 11pm - 5am | 21+</span></span>
			</div>
			
			
			


			
	</section>	

<section class="single-content"  itemscope itemtype="http://schema.org/Event">
<div class="top-event">
	<div class="media-left">
		<div id="imgblock" class="preview">
		  <ul class="slides photo-gal">
		  <li>
			<a href="<?= $this->template_url ?>content\images\vip-event\wall-flyer.jpg" large="" data-lightbox="single-pic">
				<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\wall-flyer.jpg" alt="<?= $event->event_name ?>" />
			</a>
		  </li>

		  </ul>
		</div>

				<div id="minithumbs" class="preview_boxes thumbs">
				  <ul class="slides">
				  <li>
					<a href="<?= $this->template_url ?>content\images\vip-event\Wall-1.jpg" large="<?= $this->template_url ?>content\images\vip-event\Wall-1.jpg" data-lightbox="single-pic">
						<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\Wall-1.jpg" alt="<?= $event->name?>" />
					</a>
				  </li>

				  <li style="margin-right:0;">
					<a href="<?= $this->template_url ?>content\images\vip-event\Wall-2.jpg" large="<?= $this->template_url ?>content\images\vip-event\Wall-2.jpg" data-lightbox="single-pic">
						<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\Wall-2.jpg" alt="<?= $event->name?>" />
					</a>
				  </li>

				  <li>
					<a href="<?= $this->template_url ?>content\images\vip-event\Wall-3.jpg" large="<?= $this->template_url ?>content\images\vip-event\Wall-3.jpg" data-lightbox="single-pic">
						<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\Wall-3.jpg" alt="<?= $event->name?>" />
					</a>
				  </li>

				  <li style="margin-right:0;">
					<a href="<?= $this->template_url ?>content\images\vip-event\Wall-4.jpg" large="<?= $this->template_url ?>content\images\vip-event\Wall-4.jpg" data-lightbox="single-pic">
						<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\Wall-4.jpg" alt="<?= $event->name?>" />
					</a>
				  </li>

				  </ul>
				</div>		
	</div>
	<div itemprop="description" class="single-desc more-less" id="description"><a id="description-link"></a>
		<h2>WALL at The W South Beach</h2>
		<div class="descriptionblock more-block" itemprop="description">
		<br />
This New Year’s Eve, WALL, swanky W South Beach hotel’s deluxe lounge-nightclub, hosts Miami’s top NYE party that will be brimming with ritz, glitz and megawatt voltage. In line with The W Hotel’s ultra-luxury reputation, WALL is an exclusive Miami nightlife “it” spot that is bringing together top-of-the-line elements for the ultimate New Year’s: soundtracked by the white-hot music of world-renowned DJ, Don Diablo, South Beach’s nightlife royalty will dance, revel, and usher in the New Year in sizzling style.<br /><br />
WALL is proud to present Don Diablo: collaborations with artists like Kelis, Alex Clare, Diplo, Example, Dragonette and Noisia are standout examples of Don Diabo’s diversity as a producer. His club anthem "Starlight (Could you be mine)" was debuted during the last SHM concerts and shot straight into the Beatport top 5. Don's firm support from Pete Tong, who debuted eight of Don’s releases in his BBC Radio1 show the last twelve months, as well as his recent residency at Las Vegas' hottest new superclub "Light" are more proof of a bright future ahead. Playing the Departures Ibiza closing party alongside Axwell & Ingrosso, his debut at the Ultra Music Festival in Miami, a sold out solo tour in Asia and the USA plus closing of the year in New York City on Pier94 with Alesso are some of the more recent highlights in Don’s busy touring schedule.<br /><br />
•	3 hour premium open bar
•	Thrilling live DJ Countdown to NYE
•	Complimentary champagne toast
•	Complimentary NYE party favors
•	Exclusive VIP Packages 
•	5am curfew
<br /><br />
W South Beach hotel welcomes you to WALL, the trendy lounge and nightlife destination that is hosting Miami’s hottest party crowd for a New Year’s Eve party packed with smoldering beats and electrifying revelry.<br /><br />
<span style="font-weight:bold;">Ambiance</span><br />
Situated inside Miami’s high-luxury hotel, The W South Beach, WALL is an ultra-exclusive lounge-and-nightclub favored by Miami’s high-living partiers. Past velvet ropes and swanky bronze doors, WALL’s interior design reflects the deluxe ambiance of its host hotel. A gold-and-black motif, opulent gold leather couches, and dark, textured walls emit a glamorous edge while WALL’s unique open design optimizes flow for non-stop dancing and partying. With an impressive LED installation, stunning light systems and an exquisite chandelier centerpiece, WALL provides a total sensory feast and atmospheric ambiance that will transport you to a high-octane, futuristic party paradise this New Year’s Eve. 
		</div>
	</div>		
		
</div>
			

	<span class="borderseated">
	<div class="single-price" id="ticketdetails">
	<h5>Ticket Details<span class="totop"><a href="#"><i class="fa fa-caret-up"></i> Back to Top</a></span></h5>

	
	<div class="slide-out">
				<?php
				foreach ($event->ct_tickets as $ticket){ 
					if($ticket->ct_contract_ticket->status!='A')
							continue ;


					//$event = new \Crave\Api\Event($event_id);

$open_tables = \Crave\Table\Inventory::getOpenTables(
                        $ticket->ct_contract_ticket_id
             );

 $abottles = [] ;

 foreach($open_tables as $key=>$value) { 

		if(is_array($value)){
			foreach($value as $table ){

				$bottles = $table['bottles'];

				
				$vodka = 0 ;
				$champagne = 0 ;

				if($bottles && count($bottles)){
					foreach ($bottles as $bottle) {
						if(strtolower($bottle['type']) == 'vodka')
							$vodka = $bottle['qty'];

						if(strtolower($bottle['type']) == 'champagne')
							$champagne = $bottle['qty'];
					}
				}

				if($vodka>0 || $champagne  > 0 ){
					array_push($abottles , [
						'name'=>$table['name'],
						'champagne'=>$champagne,
						'vodka'=>$vodka,
					]);
				}

	
			}
		}
	}



				?>	
	
		<div class="seated-vip" itemscope itemtype="http://schema.org/Offer">	


			<div class="right-buy">
				<a itemprop="url" class="single-buy" href="<?= $buy_url ?>">BUY TICKETS <i class="fa fa-angle-right"></i></a>
				<span itemprop="price" class="sg-price">$<?= number_format($ticket->ct_contract_ticket->price) ?></span>
			</div>

			
			<div class="event-block">
			
			<div class="ticket-type">
			<span itemprop="name" class="light-title"><?= $ticket->name ?></span>
			<span class="tix-detail"><i class="fa fa-angle-down"></i> Ticket Details</span>
			</div>
			
			<div class="tix-info">
			
			
				
			<span itemprop="description"><?= $ticket->ct_contract_ticket->description ?></span>

			<?php 
			if (count($abottles)) { 
				
		?>

	<strong>Bottle Service Information</strong>
			<table class="bottle-service">

				<tr>
					<th>Table &amp; Group Size</th>
					<th></th>
					<th></th>
					<!-- <th>Ultra VIP Bottles</th>
					<th>Platinum VIP Bottles</th> -->
				</tr>
				<?php 
				foreach($abottles as $bottle) { 

					$champagne = $bottle['champagne'];
					$vodka = $bottle['vodka'];

				?>
				<tr>
					<td><?= $bottle['name'] ?></td> <!-- amount -->
					<td><?= $champagne ? $champagne." Champagne" :"" ?></td> <!--ultra -->
					<td><?= $vodka ? $vodka." Vodka" :"" ?></td> <!--ultra -->
				</tr>
				<?php 
				}
				?>
				
			</table>
			<span class="mini-line"><span>*</span> You can only select a table size that is available in the shopping cart. some table sizes may no longer be available.</span>
			<?php 
				} // if open_tables 
			?>
			
		</div>
		</div>
		
		</div>	</span>

		<?php 

		}

		?>	

</div>


<div class="event-infoblock">	
<div class="block-mod">
<h5>Music &amp; Crowd<span class="totop"><a href="#"><i class="fa fa-caret-up"></i> Back to Top</a></span></h5>
<br>	
<div style="text-align: center;">
<p>Live DJ performance</p>
<p>(House, EDM)</p>
</div></div>
			
				
<div class="block-mod">
<h5>Dress Code<span class="totop"><a href="#"><i class="fa fa-caret-up"></i> Back to Top</a></span></h5>
<br>	
<p style="text-align: center;">Dress to impress. New Year's Eve festive!</p></div>
			
				
	
				
<div class="block-mod">
<h5>Age<span class="totop"><a href="#"><i class="fa fa-caret-up"></i> Back to Top</a></span></h5>
<br>	
21+</div>
			
	<div id="4">
	<h5>Map<span class="totop"><a href="#"><i class="fa fa-caret-up"></i> Back to Top </a></span></h5>
<div class="center-content">
<iframe width="990" height="527" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=2201+Collins+Avenue++Miami%2CFL+33139&amp;aq=&amp;sll=25.7978290,-80.1278610&amp;sspn=0.598674,1.234589&amp;ie=UTF8&amp;hq=&amp;hnear=2201+Collins+Avenue++Miami%2CFL+33139&amp;t=m&amp;ll=25.7978290,-80.1278610&amp;spn=0.008564,0.011523&amp;z=16&amp;iwloc=A&amp;output=embed">
	</iframe>		
</div>
</div></div>



</section>
</section> 	

<script>
$(window).load(function() {

  $('.tix-detail').click(function() {
	$(this).parent().siblings('.tix-info').slideToggle(600);
  });
  
});




</script>

<!-- End Social button codes -->
<?php
\Website::bottom();
?>