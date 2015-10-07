
<section class="content1">
    <div class="container">

        <section class="content-row6">

            <?php
            if(count($events) > 0 ){
                foreach($events as $event) { include("event.php"); }
            } else {
                $image = $market['images'][0];
                include ("image.php");

            }

            ?>


        </section>







        <section class="smleft-contentarea">

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
