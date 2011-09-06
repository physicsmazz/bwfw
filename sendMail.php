<?php
require_once 'includes/config.inc.php';
$result = array();
if(isset($_POST)){
    $formOk = true;
    $errors = array();

    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $date = date('Y/m/d');
    $time = date('H:i:s');

    array_walk_recursive($_POST, create_function('&$val', '$val = stripslashes(trim($val));'));
//    $name = $_POST['name'];
    $emailAddress = $_POST['email'];
//    $phone = $_POST['phone'];
//    $message = $_POST['message'];

    if(empty($emailAddress)){
        $formOk = false;
        $errors[] = 'You have not entered an email address.';
    }elseif(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
        $formOk = false;
        $errors[] = 'You have not entered a valid email address';
    }

//    if(empty($name)){
//        $formOk = false;
//        $errors[] = 'You have not entered a name';
//    }elseif(empty($emailAddress)){
//        $formOk = false;
//        $errors[] = 'You have not entered an email address';
//    }elseif(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
//        $formOk = false;
//        $errors[] = 'You have not entered a valid email address';
//    }elseif(strlen($message < 10)){
//        $formOk = false;
//        $errors[] = 'Your message must be greater than 10 characters';
//    }


    if($formOk){
        try {   //try inserting into the db
            $db = new Mysql();
            $result['addToDb'] = $db->addToMailingList($emailAddress);
        } catch (LogException $e) {
            //return nothing to the user, this will trigger an ajax error.
            //error is logged into a text file
            $result['error'] = true;
            $result['exception'] = $e->getMessage();
        }

        try {   //try sending email
            $email = new PHPMailer(true);
            $email->AddAddress('physicsmazz@gmail.com', 'MAZZ');
            $email->Subject = "Email from betterwaysforwomen.com";
            $email->From = 'donotreply@betterwaysforwomen.com';
            $email->FromName = "Better Ways For Women Website";

            $emailBody = "Email: {$emailAddress}<br>";
            $email->MsgHTML($emailBody);
            $email->Send();
            $result['sendEmail'] = true;
        } catch (Exception $e) {
            //logging handled in LogException
            $result['sendMail'] = false;
            $result['exception'] = $e->getMessage();
        }
    }
}

echo (json_encode($result));







 