<section class="content1">
    <div class="container">
        <section class="left-contentarea">
            <section class="content-row2" itemscope="" itemtype="http://schema.org/Place">


            </section>
            <section class="content-row1">

                <?php foreach($events as $event) { include("event.php"); } ?>

                <?php /*
                <article itemscope="" itemtype="http://schema.org/Event" class=" ">
                    <a itemprop="url" href="/us/philadelphia/parties_g-lounge_111-s-17th-st-philadelphia-pa"><img itemprop="image" src="http://cdn.vfolder.net/files/BOGcvtg4OIa/glounge1.jpg" alt="G Lounge - New Years Party"></a>
                    <div class="box-content">
                        <div itemscope="" itemtype="http://schema.org/Offer">
                            <a itemprop="offerurl url" class="more-info-tix" href="/us/boston/parties_gem-restaurant-n-lounge_42-province-street-boston-ma">More Info</a>
                        </div>
                        <div itemscope="" itemtype="http://schema.org/Offer">
                            <a itemprop="offerurl url" class="buy-tickets" href="/us/boston/parties_gem-restaurant-n-lounge_42-province-street-boston-ma">Buy now</a>
                        </div>
                    </div>
                </article>

                <article itemscope="" itemtype="http://schema.org/Event" class=" ">
                    <a itemprop="url" href="/us/philadelphia/parties_g-lounge_111-s-17th-st-philadelphia-pa"><img itemprop="image" src="http://cdn.vfolder.net/files/BOGcvtg4OIa/glounge1.jpg" alt="G Lounge - New Years Party"></a>
                    <div class="box-content">
                        <div itemscope="" itemtype="http://schema.org/Offer">
                            <a itemprop="offerurl url" class="more-info-tix" href="/us/boston/parties_guilt_279-tremont-street-boston-ma">More Info</a>
                        </div>
                        <div itemscope="" itemtype="http://schema.org/Offer">
                            <a itemprop="offerurl url" class="buy-tickets" href="/us/boston/parties_guilt_279-tremont-street-boston-ma">Buy now</a>
                        </div>
                    </div>
                </article>
                */

?>

            </section>

        </section><!--leftarea content-->

        <section class="smright-contentarea2">

            <div class="right-desc" itemscope="" itemtype="http://schema.org/Event">

                <h2 itemprop="summary name">
                    <a itemprop="url" href="<?= $market['url'] ?>"><?= $market['market_name']?></a>
                </h2>
                <p itemprop="description"><?= $market['description'] ?></p>
                <div class="home-btnblock">
                    <meta itemprop="latitude" content="42.358544">
                    <meta itemprop="longitude" content="-71.065063">
                    <meta itemprop="startDate" content="2014-12-31">
                    <a itemprop="url" href="<?= $market['url'] ?>" class="">View all parties »</a>
                </div>
            </div>
        </section><!--rightarea content-->
    </div> <!-- end container -->

</section>