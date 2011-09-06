<?php
require_once 'includes/config.inc.php';
$catId = $_POST['catId'];
$depth = $_POST['depth'];
$size = $_POST['size'];
$qty = (int)$_POST['qty'];

//get product Id
$prod = new Product();


$prodArr = $prod->getInfoBySize($size, $depth);
$prodId = (int)$prodArr['id'];
$result['prodId'] = $prodId;

$result['text'] = 'This is a test.';


//look for item that is already there
if(isset($orderArr[$prodId]['qty'])){
    //item exists
    $orderArr[$prodId]['qty'] = $orderArr[$prodId]['qty'] + $qty;
    $result['itemExists'] = true;
}else{
    $orderArr[$prodId]['qty'] = $qty;
    $orderArr[$prodId]['name'] = $prodArr['name'];
    $orderArr[$prodId]['price'] = $prodArr['price'];
    $orderArr[$prodId]['description'] = $prodArr['description'];
    $orderArr[$prodId]['cat'] = $prodArr['category'];
}

$php->warn($_SESSION,'$_SESSION');

//if($orderProduct){
//    //if the prodId was already there
//    if(!$orderProduct['qty']){
//        //if you qty, make it 1
//        $orderProduct['qty'] = 1;
//    }
//    $orderProduct['qty']++;
//    $result['newProduct'] = false;
//}else{
//    //not previously there
//    $orderProduct['prodId'] = $prodId;
//    $orderProduct['qty'] = 1;
//    $result['newProduct'] = true;
//}
//$orderProduct['name'] = trim(stripslashes($_POST['name']));
//$orderProduct['price'] = trim(stripslashes($_POST['price']));

echo (json_encode($result));
