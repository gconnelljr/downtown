<?php 

$nhoods = [] ;
$venue_types = []; 
$ages = []; 

if ($this->show_filters) {
    array_walk (
            $left_events ,  // $events
            function ($item) use (&$nhoods, &$venue_types){
                    $venue_type = $item['venue_type_name']; 

                    if ($item['neighborhood']){
                            if ($nhoods[$item['neighborhood']])
                                    $nhoods[$item['neighborhood']]->count++;
                            else  {
                                    $nhoods[$item['neighborhood']] = new stdClass ; 
                                    $nhoods[$item['neighborhood']]->count  = 1;
                                    $nhoods[$item['neighborhood']]->title  = $item['neighborhood'];
                            }
                    } 

                    if ($venue_type){
                            if ($venue_types[$venue_type])
                                    $venue_types[$venue_type]->count++;
                            else {
                                    $venue_types[$venue_type] = new stdClass ; 

                                    $venue_types[$venue_type]->count  = 1;
                                    $venue_types[$venue_type]->title  = $venue_type;

                                //    $venue_types[$venue_type]->url  = sprintf("/%s/%s/%s", $this->vars['country_slug'], $this->vars['market_slug'],$item->where->venue_type->slug) ;
                            }
                    } 
    });

	
    if (!isset($filters_list)){
            $filters_list = []; 
    }


    $neighborhood[] = (object)['title'=>'Neighborhoods', 'items' => $nhoods , 'filter_name' => 'data-neighborhood' ] ; 
    $filters_list[] = (object)['title'=>'Venue Types', 'items' => $venue_types, 'filter_name' => 'data-vtype' ] ;
    $filters_list[] = (object)['title'=>'Ages', 'items' => $ages] ; 

}

//d($this);

?> 
<section class="listings_page">


	<aside class="side_content">
		<div class="news_letter">
			<div class="heading">newsletter</div>
				<form id="newsletter_form">
					<input type="hidden" name="website_id" value="<?= $this->website->website_id ?>">
					<input type="hidden" name="ct_promoter_website_id" value="<?= $this->website->ct_promoter_website_id ?>">
					<input type="email" class="email_field" name="email_address" id="newsletter_email" placeholder="SIGN UP FOR OUR NEWSLETTER">
					<button class="email_btn" id="newsletter_submit"></button>
				</form>
		</div>

<?php if (count($events) > 2){?>

	<?php if($this->show_filters){?>
		<div class="venue_type">
			<div class="heading">Venue Type</div>
			<?php 

			
				if($filters_list && count($filters_list)){
					foreach ($filters_list as $filters_block) {	
						if (count($filters_block->items) < 2 )
							continue;
			?>
			<div>
				<?php foreach ($filters_block->items as $item) { ?>
					<div class="venue_name">
						<?php if ($item->url ) { ?> 
						<a href="<?= $item->url?>"><?= $item->title ?></a>
						<?php } else { ?> 
						<input type="checkbox" class="checkbox" data-filter="<?= $filters_block->filter_name ?>" value="<?= $item->title ?>" /> <?= $item->title ?>
						<?php }?>

						<span class="amount"><?= $item->count ?></span>
					</div>
				<?php
				} 
				?>
			</div>
			<?php 

						
					}
				}
			?>
		</div>

	<?php 

	if($market_id == 1){?>
		<div class="neighborhoods">
			<div class="heading neighbors">neighborhoods <span class="ui-icon-triangle-1-e">&nabla;</span></div>
			<ul class="neighbors_list">
				<?php
				if($neighborhood && count($neighborhood)){
					foreach ($neighborhood as $filters_block) {	
						if (count($filters_block->items) < 2 )
							continue;
			?>
			<div>
				<?php foreach ($filters_block->items as $item) { ?>
					<div class="neighborhood_name">
						<?php if ($item->url ) { ?> 
						<a href="<?= $item->url?>"><?= $item->title ?></a>
						<?php } else { ?> 
						<input type="checkbox" class="checkbox" data-filter="<?= $filters_block->filter_name ?>" value="<?= $item->title ?>" /> <?= $item->title ?>
						<?php }?>

						<span class="amount"><?= $item->count ?></span>
					</div>
				<?php
				} 
				?>
			</div>
			<?php 	
					}
				}
			?>
			</ul>
	<?php }} ?>
		

		<div class="parties">
			<div class="heading">all parties a-z</div>
			<ul>
			<?php foreach ($left_events as $side_events) { ?>
				<li><a href="<?= $side_events['url']?>"><?= $side_events['venue_name']?></a></li>
			<?php } ?>
			</ul>
		</div>
<?php }?>
	</aside>

	<div class="main_content">
		<!-- <div class="introduction">
			Hottest Bars, Clubs, Lounges, A-list Venues, Top Djs, and Open Bars. Bo one knows better than 
			NewYearsEveCentral.com how to ring in New Year's in New York with the trendiest New Years Eve 
			parties. We want to make your New Work New Year's clebration memorable. You can be sure to get 
			all of the New Year Party information you need including venue photos, music performers, world 
			renown DJs.
		</div> -->
		<div class="row1">
			<?php if (count($events) < 1){
				//echo ('There are no current events right now');
			}else if (count($events) == 1){
				include ('templates/components/1-event/1-event.php'); 
			}else if(count($events) == 2 || count($events) == 4){
				include ('templates/components/2-events/2-events.php');
			}else if(count($events) == 3 || count($events) == 5){
				include ('templates/components/5-events/5-events.php');
			}else{
				include ('multi-events.php');
			}?>

			<?php if (count($events) < 1){ ?>

					
			<section class="main-area">

				<div>
					<?php include ("includes/notifyme.php") ?>
				</div>
			</section>
			<?php } ?>
		</div>
	</div>
</section>

<style>
/* nyc blue date boxes*/
.date_tabs {
overflow: hidden;
padding-bottom: 10px;
height: 114px;
max-width: 751px;
float: right;
}

.date_tabs div.datetabs {
background: #35a6da;
text-transform: uppercase;
font-family: 'Open Sans', sans-serif;
font-weight: 600 !important;
font-size: 24px;
width: 148px;
height: 126px;
border-right: 2px solid #0E80B4;
float: left;
}
.date_tabs > div.datetabs a {
display: block;
padding: 8px 0 4px 12px;
text-decoration: none;
text-transform: uppercase;
max-height: 38px;
margin: 0;
position: relative;
}
a.viewallparties {
font-size: 12px;
}
.date_tabs a {
color: #fff;
}
.minipartylist a {
font-size: 12px;
text-align: left !important;
padding: 0px 8px 3px 12px !important;
}
.datetabs:last-child {
border-right: none !important;
}
.lgnyetag {
font-size: 15px;
padding-left: 12px;
font-weight: 700;
color: #fff;
}
.datetabs.selected {
background-color: #ab955a !important;
}
a.viewallnyc {
float: right;
}

.neighbors_list{
	display: none;
}

.neighbors{
	cursor: pointer;
}

</style>

<script>
	
	$(function(){
		$('.checkbox').bind('change' ,function () {

			if($('.checkbox[data-filter]:checked').length == 0){

				$('div.events').show(); 
			}else {
				
				$('div.rightcol').hide(); 
				$('.checkbox[data-filter]:checked').each(function(){

					var val = $(this).val(); 
					var filter = $(this).attr('data-filter');

					var selector = 'div.rightcol['+filter+'="' + val + '"]'; 

					$(selector).show();

					console.log(selector);

				});
			}
		

		});

		$('.neighbors').on('click' ,function () {
			$('.neighbors_list').toggle();
		});


	});
</script>