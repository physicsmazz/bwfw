<?php
ob_start('ob_gzhandler');
//set the session length to 24 hours
ini_set('session.gc_maxlifetime', 60*60*24);

session_start();

function __autoload($class_name)
{
    require_once 'classes/' . $class_name . '.class.php';
}

// it's local, use the local db connection
if ($_SERVER['HTTP_HOST'] == 'localhost' || strstr($_SERVER['HTTP_HOST'], '192.168.2')) require_once('includes/connLocal.inc.php');
else require_once 'includes/conn.inc.php';
//php logging
$php = FirePHP::getInstance(true);
//turn on php logging if local
if ($_SERVER['HTTP_HOST'] == 'localhost' || strstr($_SERVER['HTTP_HOST'], '192.168.2')) {
    $php->setEnabled(true);
} else {
    //set false for production.
    $php->setEnabled(true);
}

$orderArr = $_SESSION['order'];
$numItems = sizeof($orderArr);
$userId = session_id();


$order = new Order($userId);

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
$email = trim(stripslashes($_POST['email']));
$subtotal = $_POST['subtotal'];
$orderTotal = $_POST['orderTotal'];
$taxTotal = $_POST['taxTotal'];
$nameArr = explode(' ', $name);
$firstname = $nameArr[0];
$lastname = $nameArr[1];

//write user data to db
try {
    //see if the address is already in the db
    if($checkShippingR = $order->checkAddress($name, $address, $city, $state, $zipcode)){
        $shippingId = $checkShippingR;
    }else{
        $shippingId = $order->writeAddress($name, $address, $city, $state, $zipcode);
    }
    //if same address is selected
    if($sameAddress == 'on'){
        $billingId = $shippingId;
    }else{
        if($checkBillingR = $order->checkAddress($nameB, $addressB, $cityB, $stateB, $zipcodeB)){
            $billingId = $checkBillingR;
        }else{
            $billingId = $order->writeAddress($nameB, $addressB, $cityB, $stateB, $zipcodeB);
        }
    }

    $r1 = $order->setDeliveryId($shippingId);
    $r2 = $order->setBillingId($billingId);

    //set the totals
    $o = $order->orderTotal($orderTotal);
    $t = $order->taxTotal($taxTotal);

    $resultArr['setOrder'] = $order->setOrderArray($_SESSION['order']);

    $statusPlaced = $order->setStatus('placed');
    $resultArr['placed'] = $statusPlaced;

    $orderTable = <<<ORDER
<table width="98%" border="1">
    <tr>
        <td>
            <table id="shippingConf">
                <tr>
                    <td>{$name}</td>
                </tr>
                <tr>
                    <td>{$address}</td>
                </tr>
                <tr>
                    <td>{$city}</td>
                </tr>
                <tr>
                    <td>{$state}</td>
                </tr>
                <tr>
                    <td>{$zipcode}</td>
                </tr>
                <tr>
                    <td>{$email}</td>
                </tr>
            </table>
        </td>
        <td>
            <table id="billingConf">
                <tr>
                    <td>{$nameB}</td>
                </tr>
                <tr>
                    <td>{$addressB}</td>
                </tr>
                <tr>
                    <td>{$cityB}</td>
                </tr>
                <tr>
                    <td>{$stateB}</td>
                </tr>
                <tr>
                    <td>{$zipcodeB}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table id="orderTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
ORDER;

    foreach($orderArr as $orderItem){
        $subTotalEa = $orderItem['price'] * $orderItem['qty'];
        $orderTable .= <<<ORDER
        <tr>
            <td>{$orderItem['id']}</td>
            <td>{$orderItem['image']}</td>
            <td>{$orderItem['name']}</td>
            <td>{$orderItem['qty']}</td>
            <td>{$orderItem['price']}</td>
            <td>{$subTotalEa}</td>
        </tr>
ORDER;

    }

$orderTable .= <<<ORDER
            </tbody>
            <tfoot>
                <tr><td>Order Subtotal: {$subtotal}</tr>
                <tr><td>Order Tax: {$taxTotal}</tr>
                <tr><td>Order Total: {$orderTotal}</tr>
            </tfoot>
            </table>
        </td>
    </tr>
</table>

ORDER;


    //send email
    $emailO = new PHPMailer(true);
    $emailO->Encoding = "base64";
    $emailO->AddAddress($email);
    $emailO->AddBCC('physicsmazz@gmail.com', 'Mazz');
    $emailO->SetFrom('noreply@thewickedstix.com', 'Do Not Reply - The Wicked Stix Order Confirmation');

    $emailO->MsgHTML($orderTable);
    $emailO->Subject = 'Your order was received at thewickedstix.com';
    $sendResult = $emailO->Send();
    //clear session
    session_unset();
    session_destroy();
    unset($userId);
}catch(MyException $e){
    $resultArr['error'] = $e->getMessage();
    echo (json_encode($resultArr));
}
$resultArr['emailSend'] = $sendResult;
echo (json_encode($resultArr));
