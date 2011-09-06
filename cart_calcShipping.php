<?php
require_once 'includes/config.inc.php';

$_SESSION['orderInfo']['shippingZipcode'] = $_POST['zipcode'];

if ($_SERVER['HTTP_HOST'] == 'localhost' || strstr($_SERVER['HTTP_HOST'],'192.168.2')){
    $responseArr['result'] = 'OK';
    $responseArr['shippingAmount'] = $_POST['weight'] * 2;
    sleep(rand(1,3));//this simulates network latency
}else{
    $zipcode = $_POST['zipcode'];
    $weight = '15';
//    $weight = $_POST['weight'];
    //take the zipcode and calculate the shipping
    $ship = new Shipping();
    $ship->setToZipcode($zipcode);
    $ship->setHeight('12');
    $ship->setLength('12');
    $ship->setWidth('12');
    $ship->setWeight($weight);
    $ship->setShippingMethod('USPS');
    try {
        $responseArr['shippingAmount'] = $ship->calculateShipping();
        $responseArr['result'] = 'OK';
    } catch (Exception $e) {
        $responseArr['result'] = $e->getMessage();
        $php->error($e,'$e');
    }
}

echo(json_encode($responseArr));








 
