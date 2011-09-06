<?php
require_once 'includes/config.inc.php';

//take the zipcode and see what state it is. If it's the delFrom state, then add that states tax.
$mysql = new Mysql();
$cityInfo = $mysql->getInfoByZip($_POST['zipcode']);

if($cityInfo['state'] == 'MA'){
    $result['taxable'] = true;
}

$result['info'] = $cityInfo;
echo (json_encode($result));
