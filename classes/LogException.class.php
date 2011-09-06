<?php
class LogException extends Exception{
    function __construct($message = null, $code = 0){
        parent::__construct($message, $code);
        $this->logError();
    }
    protected function logError(){
        if($fp = fopen('mysql_errors.txt','a')){
            $logMsg = date('[Y-m-d H:i:s]') . " Message: {$this->getMessage()}\n";
            fwrite($fp,$logMsg);
            fclose($fp);
        }
    }
}