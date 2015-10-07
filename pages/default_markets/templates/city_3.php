<section class="content1">
    <div class="container">


        <section class="content-row7">

            <section class="smtopwide-contentarea">

                <div class="right-desc" itemscope="" itemtype="http://schema.org/Event">

                    <h2 itemprop="summary name">
                        <a itemprop="url" href="<?= $market['url'] ?>"><?= $market['market_name']?></a>
                    </h2>
                    <p itemprop="description">It's New Year's Eve and all eyes are on Times Square, because on New Year's Eve, the entire world waits for the ball to drop—the timeless symbol that marks the beginning of the New Year. NYE is the biggest party night in New York City—the greatest city—and the Times Square Ball Drop event has been the center of global attention for over 100 years. You'll be thrilled to be one in a million revelers who gather to share the ostentatious Times Square experience together. Times Square is where dreams come true this New Year's Eve, and we invite you to enjoy the magical with one of our glorious Times Square Packages.</p>
                    <div class="home-btnblock">
                        <meta itemprop="latitude" content="40.735747">
                        <meta itemprop="longitude" content="-73.99056">
                        <meta itemprop="startDate" content="2014-12-31">
<a itemprop="url" href="<?= $market['url'] ?>" class="">View all parties »</a>
                    </div>
                </div>
            </section><!--rightarea content-->

        
<div class="timesblock">
        <?php foreach($events as $event) {
            include("event.php");

        } ?>
	</div>	
		</section>

    </div> <!-- end container -->

</section>