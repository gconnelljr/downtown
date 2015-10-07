<?php
$path = decrypt(IDE , 'vfolder-flyer', true) ;

$folder = \Crave\ListingPage::getFlyer($path, [
    'height' => 190,
    'width' => 190,
    'crop' => 'center'
]);



header("Content-Type: application/json");
echo json_encode($folder);
exit();