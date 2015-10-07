<section class="content1">
    <div class="container">


        <section class="content-row5">

            <?php if ($events && count($events)) { $event = $events[0] ; include("event.php"); } ?>
            <?php /*
            <article itemscope="" itemtype="http://schema.org/Event" class=" ">
                <a itemprop="url" href="/philadelphia/parties_g-lounge_111-s-17th-st-philadelphia-pa"><img itemprop="image" src="http://cdn.vfolder.net/files/BOGcvtg4OIa/glounge1.jpg" alt="G Lounge - New Years Party"></a>
                <div class="box-content">
                    <div itemscope="" itemtype="http://schema.org/Offer">
                        <a itemprop="offerurl url" class="more-info-tix" href="/boston/parties_gem-restaurant-n-lounge_42-province-street-boston-ma">More Info</a>
                    </div>
                    <div itemscope="" itemtype="http://schema.org/Offer">
                        <a itemprop="offerurl url" class="buy-tickets" href="/boston/parties_gem-restaurant-n-lounge_42-province-street-boston-ma">Buy now</a>
                    </div>
                </div>
            </article>
            */
?>

        </section>


        <section class="smmid-contentarea">

            <div class="right-desc" itemscope="" itemtype="http://schema.org/Event">

                <h2 itemprop="summary name">
                    <a itemprop="url" href="<?= $market['url'] ?>"><?= $market['market_name'] ?></a>
                </h2>
                <p itemprop="description">When it comes New Year's parties, Chicago lives up to its name as the "windy city" ... having bragging rights for the best New Year's Eve parties and events at top nightlife hotspots.</p>
                <div class="home-btnblock">
                    <meta itemprop="latitude" content="42.358544">
                    <meta itemprop="longitude" content="-71.065063">
                    <meta itemprop="startDate" content="2014-12-31">
                    <a itemprop="url" href="<?= $market['url'] ?>" class="">View all parties »</a>
                </div>
            </div>
        </section>


        <section class="content-row4">
            <?php if ($events && count($events)>1) { $event = $events[1] ; include("event.php"); } ?>

            <?php /*
            <article itemscope="" itemtype="http://schema.org/Event" class=" ">
                <a itemprop="url" href="/philadelphia/parties_g-lounge_111-s-17th-st-philadelphia-pa"><img itemprop="image" src="http://cdn.vfolder.net/files/BOGcvtg4OIa/glounge1.jpg" alt="G Lounge - New Years Party"></a>
                <div class="box-content">
                    <div itemscope="" itemtype="http://schema.org/Offer">
                        <a itemprop="offerurl url" class="more-info-tix" href="/boston/parties_guilt_279-tremont-street-boston-ma">More Info</a>
                    </div>
                    <div itemscope="" itemtype="http://schema.org/Offer">
                        <a itemprop="offerurl url" class="buy-tickets" href="/boston/parties_guilt_279-tremont-street-boston-ma">Buy now</a>
                    </div>
                </div>
            </article>
*/ ?>


        </section>



    </div> <!-- end container -->

</section>