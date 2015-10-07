<?php 
// include('details.php');
// die(); 
$filters = ['is_hotel' => true] ;

dd($filters);

global $website;

$page->title = "Hotels"; 


include('pages/events/list.php');


\Website::top();
?>


<?php 
\Website::bottom();
?>
