<?php
require_once 'includes/config.inc.php';


$itemsArr = (array)$_POST['items'];
foreach($itemsArr as $item){
    $prodId = $item['id'];
    $qty = $item['qty'];
    $price = $item['price'];
    if($qty == '0'){
        unset($orderArr[$prodId]);
    }else{
        $orderArr[$prodId]['qty'] = $qty;
    }
    $result['result'] = true;
    $result['id'] = $prodId;
    $result['qty'] = $qty;
    $resultArr[] = $result;
}

echo (json_encode($resultArr));
