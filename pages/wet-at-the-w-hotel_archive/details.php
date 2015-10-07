<?php 
global $website;
$event_id = 7853; 
$key = 'cache:special-event:'.$event_id; 
//$event = \mem($key); 

$buy_url = 'https://secured.cravetickets.com/purchase/xI7dgL5wpwE/rquNesCME11/Bwfj5f5vP87?&r=newyears.com';
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
				<span itemprop="startDate">Wednesday, December 31st, 2014 | 9pm - 2am | 21+</span></span>
			</div>
			
			
			

			<div class="hour-info">
			<span>3 HOUR PREMIUM OPEN BAR 9PM - 12AM</span><br />
			</div>

			
	</section>	

<section class="single-content"  itemscope itemtype="http://schema.org/Event">
<div class="top-event">
	<div class="media-left">
		<div id="imgblock" class="preview">
		  <ul class="slides photo-gal">
		  <li>
			<a href="<?= $this->template_url ?>content\images\vip-event\wet-flyer.jpg" large="" data-lightbox="single-pic">
				<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\wet-flyer.jpg" alt="<?= $event->event_name ?>" />
			</a>
		  </li>

		  </ul>
		</div>

				<div id="minithumbs" class="preview_boxes thumbs">
				  <ul class="slides">
				  <li>
					<a href="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-1.jpg" large="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-1.jpg" data-lightbox="single-pic">
						<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-1.jpg" alt="<?= $event->name?>" />
					</a>
				  </li>

				  <li style="margin-right:0;">
					<a href="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-2.jpg" large="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-2.jpg" data-lightbox="single-pic">
						<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-2.jpg" alt="<?= $event->name?>" />
					</a>
				  </li>

				  <li>
					<a href="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-3.jpg" large="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-3.jpg" data-lightbox="single-pic">
						<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-3.jpg" alt="<?= $event->name?>" />
					</a>
				  </li>

				  <li style="margin-right:0;">
					<a href="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-4.jpg" large="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-4.jpg" data-lightbox="single-pic">
						<img itemprop="image" src="<?= $this->template_url ?>content\images\vip-event\Outside-Wet-4.jpg" alt="<?= $event->name?>" />
					</a>
				  </li>

				  </ul>
				</div>		
	</div>
	<div itemprop="description" class="single-desc more-less" id="description"><a id="description-link"></a>
		<h2>WET at The W South Beach</h2>
		<div class="descriptionblock more-block" itemprop="description">
		<br />
This New Year’s Eve, Miami’s WET, luxurious W South Beach Hotel’s exclusive poolside bar-and-lounge, invites you to experience a heavenly combination of swanky poolside revelry and high-voltage dance party. Bringing the red-hot sounds of world-class DJ, Martin Solveig, to Miami nightlife, WET presents an electrifying NYE bash filled with gorgeous Miami partiers, sumptuous amenities, and heart-stopping music and dancing. Elevate your New Year’s Eve at WET, where South Beach-glitz meets kilowatt fun for an unforgettable NYE. 

<br /><br />
WET is proudly presents renowned DJ, Martin Solveig: selling over two million copies of his hit single "Hello", Martin Solveig earned global recognition in 2011 was put on the 2012 billing of some of the world’s biggest festivals such as Coachella and Electric Daisy Carnival among others. Martin has produced tracks for Pop-Queen, Madonna’s 2012 "MDNA" album and worked with newcomers such as "The Cataracs" and young rapper "Kyle" to release one of 2013's summer anthem's "Hey Now". 2014 is set to be Martin’s biggest year yet as he brings his thumping, fun-filled sounds to the shores of Ibiza and bright lights of Vegas. 
<br /><br />
•	3 hour premium open bar
•	Thrilling live DJ Countdown to NYE
•	Complimentary champagne toast
•	Complimentary party favors
•	Exclusive VIP Package options
 <br /><br />
Usher in this New Year’s in Miami’s South Beach with an extravagant and supercharge NYE tropical bash, crafted for Miami’s in-the-know party crowd by WET, a trendy poolside lounge situate in the swanky W South Beach hotel. <br /><br />
<span style="font-weight:bold;">Ambiance</span> <br />
A brand that is synonymous with lavish hospitality and nightlife, W South Beach has hosted Miami’s hottest parties and nightlife events. Its deluxe poolside venue, WET, brings you two glimmering pools of dazzling reflections and towering palm trees that infuse the space with deluxe tropical ambiance. Experience sumptuous poolside leisure, relax in the tranquil Mini WET pool, or treat yourself to the extravagance of a private cabana, WET is the ultimate destination for luxury revelry. This New Year’s Eve, WET sets the glimmering scene for high-energy party that will be truly sublime. 		</div>
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