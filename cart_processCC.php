<?php

if ($_SERVER['HTTP_HOST'] == 'localhost' || strstr($_SERVER['HTTP_HOST'],'192.168.2')){
    $resultArr['result'] = 'true';
}else{
    function __autoload($class_name)
    {
        require_once 'classes/' . $class_name . '.class.php';
    }

    $name = trim(stripslashes($_POST['shipName']));
    $address = trim(stripslashes($_POST['shipAddress']));
    $city = trim(stripslashes($_POST['shipCity']));
    $state = trim(stripslashes($_POST['shipState']));
    $zipcode = trim(stripslashes($_POST['shipZipcode']));
    $nameB = trim(stripslashes($_POST['billName']));
    $addressB = trim(stripslashes($_POST['billAddress']));
    $cityB = trim(stripslashes($_POST['billCity']));
    $stateB = trim(stripslashes($_POST['billState']));
    $zipcodeB = trim(stripslashes($_POST['billZipcode']));
    $ccNum = (string)trim(stripslashes($_POST['ccNum']));
    $ccMonth = (string)trim(stripslashes($_POST['ccMonth']));
    $ccYear = substr((string)trim(stripslashes($_POST['ccYear'])),2);
    $orderWeight = (string)trim(stripslashes($_POST['weight']));
    $orderTotal = $_POST['orderTotal'];
    $taxTotal = $_POST['taxTotal'];
    $nameArr = explode(' ', $name);
    $firstname = $nameArr[0];
    $lastname = $nameArr[1];


    try{
    //do the creditcard processing
    $cc = new CC();

    $cc->amount($orderTotal);
    $cc->firstname($firstname);
    $cc->lastname($lastname);
    $cc->address($address);
    $cc->city($city);
    $cc->state($state);
    $cc->zipcode($zipcode);
    $cc->setCcNum($ccNum);
    $ccExp = $ccMonth . $ccYear;
    $cc->setCcExp($ccExp);
    $ccResultArr = $cc->runCC();

    if($ccResultArr[0] != 1){
        throw new MyException($ccResultArr[3]);
    }

    }catch(MyException $e){
        $resultArr['errorMessage'] = $e->getMessage();
    }

    //if cc result ok, set status to placed and send confirmation email.
    $resultArr['ccProcessResult'] = $ccResultArr;
    if($ccResultArr[0] != 1){
        $_SESSION['ccError'] = $ccResultArr[3];
        $resultArr['result'] = false;
    }else{
        $resultArr['result'] = 'true';
    }
}

echo(json_encode($resultArr));
