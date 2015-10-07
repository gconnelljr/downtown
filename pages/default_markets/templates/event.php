
<article itemscope="" itemtype="http://schema.org/Event" class="">
    <a itemprop="url" href="<?= $event->url ?>"><img itemprop="image" src="<?= $event->img_small->src ?>" alt="<?= $event->venue_name ?>"></a>
    <div class="box-content">
        <div itemscope="" itemtype="http://schema.org/Offer">
            <a itemprop="offerurl url" class="more-info-tix" href="<?= $event->url ?>">More Info</a>
        </div>
        <div itemscope="" itemtype="http://schema.org/Offer">
            <a itemprop="offerurl url" class="buy-tickets" href="<?= $event->url ?>">Buy now</a>
        </div>
    </div>
</article>