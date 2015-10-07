<section class="content1">
    <div class="container">


        <section class="content-row3">
<?php
for($i = 0 ; $i < 2 ; $i++){
    $event = $events[$i] ;
    include("event.php");

}
?>
        </section>
        <section class="mid-contentarea">

            <div class="right-desc" itemscope="" itemtype="http://schema.org/Event">

                <h2 itemprop="summary name">
                    <a itemprop="url" href="<?= $market['url'] ?>"><?= $market['market_name'] ?></a>
                </h2>
                <p itemprop="description"><?= $market['description'] ?></p>
                <div class="home-btnblock">
                    <meta itemprop="latitude" content="40.735747">
                    <meta itemprop="longitude" content="-73.99056">
                    <meta itemprop="startDate" content="2014-12-31">
                    <a itemprop="url" href="<?= $market['url'] ?>" class="">View all parties »</a>
                </div>
            </div>
        </section><!--rightarea content-->

        <section class="content-row4">
            <?php for($i = 2 ; $i < 4 ; $i++){
                $event = $events[$i] ;
                include("event.php");

            }
            ?>

        </section>




    </div> <!-- end container -->

</section>