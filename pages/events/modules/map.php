<div id="map-area">
	<h5 class="heading">Map</h5>
	<span class="page_top"><a href="#top">Back to Top</a></span>
<?php 
if ($event->is->bc){ ?> 

	<div id="map"></div>
	
<?php }else { ?>

	<iframe width="538" height="527" frameborder="0" scrolling="no" 
			marginheight="0" marginwidth="0" 
			src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?= urlencode(sprintf("%s %s %s,%s %s", $event->where->address1, $event->where->address2, $event->where->city, $event->where->state, $event->where->zip  )) ?>&amp;aq=&amp;sll=<?= $event->where->latitude ?>,<?= $event->where->longitude ?>&amp;sspn=0.598674,1.234589&amp;ie=UTF8&amp;hq=&amp;hnear=<?= urlencode(sprintf("%s %s %s,%s %s", $event->where->address1, $event->where->address2, $event->where->city, $event->where->state, $event->where->zip  )) ?>&amp;t=m&amp;ll=<?= $event->where->latitude ?>,<?= $event->where->longitude ?>&amp;spn=0.008564,0.011523&amp;z=16&amp;iwloc=A&amp;output=embed">
	</iframe>			

<?php } ?>
</div>