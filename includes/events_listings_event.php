<?php 
	$limit  = 255  ;

	$desc = strip_tags ($event->description) ;

	if(strlen($desc) > $limit ){
		//$desc = substr($desc, 0, $limit);
		$index_space = strrpos($desc, ' ' , - strlen($desc) + $limit );
		//$index_dot = strrpos($desc, '.', - strlen($desc) + $limit);

		$desc = substr($desc,0 , $index_space).'...';


	} 
?>


<article class="event single-event-block"  itemscope itemtype="http://schema.org/Event"
		data-neighborhood="<?= $event->where->neighborhood ?>" 
		data-ages="<?= $event->info->ages ?>"
		data-event-time="<?= $event->event_time ?>"
		data-header-flyer="<?= $event->header_flyer_url ?>"
		data-ide="<?= $event->ide ?>"
        data-vtype="<?=  $event->where->venue_type->name ?>" 
		data-date="<?= $event->start_date ?>"
		> 
	<div class="poster">
        <?php if ($event->flyer_src) { ?>
        <a href="<?= $event->url ?>"><img itemprop="image" src="<?= $event->flyer_src ?>" alt="<?=  $event->name ?> New Years Flyer" /></a>
		<?php } else if ($event->flyer_ide) { ?>
		<a href="<?= $event->url ?>"><img itemprop="image" src="/templates/website/content/images/NYE_2015_Placeholder.png" alt="<?=  $event->name ?> New Years Flyer" data-vfolder-ide="<?= $event->flyer_ide ?>"/></a>
		<?php } else {?>
        <a href="<?= $event->url ?>"><img itemprop="image" src="/templates/website/content/images/NYE_2015_Placeholder.png" alt="<?=  $event->name ?> New Years Flyer" /></a>
        <?php }?>
	</div>
	<div class="event-info">
	<div class="left-info">
		<div class="right-info">
		<div class="price-area" itemscope itemtype="http://schema.org/AggregateOffer">
			<?php if ($event->contract_status == 'B') { ?> 
				<span><?= $event->announce_ticket_message ?></span>
			<?php } else {  ?>
				<?php if( $event->prices && $event->prices->ga) { ?>
				<span><span itemprop="name">GA</span> from <span class="ev-price" itemprop="lowPrice">$<?= $event->prices->ga ?></span></span><br />
				<?php } ?>
				<?php if( $event->prices && $event->prices->vip ) { ?>
				<span><span itemprop="name">VIP</span> from <span class="ev-price" itemprop="lowPrice">$<?= $event->prices->vip ?></span></span>
				<?php } ?>
			<?php } ?>
		</div>		
	</div>
		<h3>
		<a itemprop="url" href="<?= $event->url ?>">
		<span itemprop="name"><?=  $event->name ?></span>
		</a></h3>

		<?php if(!$event->is->bc) { ?>
		<div class="breadcrumbs">
			<span><a href="/us/<?= $event->market->slug ?>"><?= $event->where->city ?></a></span>
			<?php if($event->where->neighborhood) { ?>
                &rsaquo; <span><a href="#"><?= $event->where->neighborhood ?></a></span>
			<?php } ?>
            <?php if ($event->where->venue_type->name) { ?>
            &rsaquo; <span><a href="/us/<?= $event->market->slug ?>/<?= $event->where->venue_type->slug ?>"><?= $event->where->venue_type->name ?></a></span>
            <?php } ?>
		</div>
		<?php } ?>
		<div class="event-txt">
		<span class="event-descrb">
		<p itemprop="description">
		
			<?= $desc ?>
		<span class="morebtn"><a href="<?= $event->url ?>">more&rsaquo;</a></span>							
		</p>
		</span>
		<span class="event-details"><?= $event->promotion ?></span>


        <div class="clearfix">

	<div itemscope itemtype="http://schema.org/Organization">
	
	<div class="ticket-box-footer left" itemprop="location" itemscope itemtype="http://schema.org/Place">
		<div class="timeloc" itemscope itemtype="http://schema.org/PostalAddress">
			<?php if(!$event->is->bc) { ?>
			<span itemprop="streetAddress"><?= $event->where->address1 ?> ,</span> 
			<span itemprop="addressLocality"><?= $event->where->city ?> </span>
			<span itemprop="addressRegion"><?= $event->where->state ?></span>
			<span itemprop="addressPostalCode"><?= $event->where->zip ?></span><br />
			<?php } ?>
			<span itemprop="startDate"><?= date('l F jS, Y', $event->when->date->U) ?></span><br />
			<span itemprop="duration"><span class="dtstart ftleft"><span class="value"><?= $event->when->door_time->g.$event->when->door_time->a."</span></span><span class='dtend'><span class='value'> - ".$event->when->close_time->g.$event->when->close_time->a ?></span></span><br />
			<span itemprop="age"><?= $event->info->ages ?></span>
		</div>
	</div>
	</div>
	<div class="ticket-box-footer right quick-btns"  itemscope itemtype="http://schema.org/Offer">
		<div class="buy-btns">
		<a class="greybtn1" itemprop="url" href="<?= $event->url ?>">More info</a>
		
		<?php if ($event->contract_status != 'B') { ?>
		<a itemprop="offerurl" class="bold" href="<?= $event->buy_url ?>">Buy now</a>
		<?php } ?>
		</div>				
	</div>


        </div>



	</div>
</div>
	</div>
</article>