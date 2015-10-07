<?php 
$obj = new \Crave\Model\ct_notify_me();

//$obj->birthdate = $_POST['birthdate'];
$obj->ct_holiday_id = $this->website->holiday_id; //$_POST['ct_holiday_id'];
$obj->email_address = $_POST['email'];
$obj->fname = $_POST['fname'];
$obj->lname = $_POST['lname'];
$obj->phone = $_POST['phone'];
$obj->venue_id = $_POST['venue_id'];
$obj->market_id = decrypt($_POST['market_ide'], 'market');


$obj->save();

$response = $obj->getResponse();
exit_json($response);