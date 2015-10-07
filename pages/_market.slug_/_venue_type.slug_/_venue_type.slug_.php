<?php
use \Crave\Model\venue_type; 

$type = venue_type::getOne(['where'=> "slug='{$this->vars['venue_type_slug']}'"]);

$filters["venue_type_id"] = $type->id; 

$listing = getListingPage()->add_to_criteria($filters); 

$breadcrumbs[] = (object)['url' => $this->urlpath , 'title' => $type->name_plural];

include('pages/_market.slug_/_market.slug_.php');