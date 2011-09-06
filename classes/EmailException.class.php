<?php
class EmailException extends Exception{

    function __construct($message = null, $code = 0){
        parent::__construct($message, $code);
        $this->logError();
        if ($_SERVER['HTTP_HOST'] == 'localhost' || strstr($_SERVER['HTTP_HOST'],'192.168.2')){
            //LOCAL
        }else{
            $this->sendEmail();
        }
    }

    protected function logError(){
        if($fp = fopen('mysql_errors.txt','a')){
            $logMsg = date('[Y-m-d H:i:s]') . " Message: {$this->getMessage()} - {$this->getTraceAsString()}\n";
            fwrite($fp,$logMsg);
            fclose($fp);
        }
    }
    protected function sendEmail(){
        $mail = new PHPMailer();
        $mail->AddAddress('physicsmazz@gmail.com', 'Mazz');
        $msg = 'There was a problem with the Best Price Bed Bug Mattress Covers: ' . $this->getMessage() . ' - ' . $this->getTraceAsString();
        $mail->MsgHTML($msg);
        $mail->Subject = 'problem with the Best Price Bed Bug Mattress Covers';
        $mail->SetFrom('donotreply@bpbbmc.com', 'BPBBMC');
        $result = $mail->Send();
    }

} //End Class

