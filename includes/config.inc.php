<?php
date_default_timezone_set('America/New_York');
ob_start('ob_gzhandler');
session_start();
//database connection
require_once 'includes/conn.inc.php';
function __autoload($class_name)
{
    require_once 'classes/' . $class_name . '.class.php';
}



//php logging
$php = FirePHP::getInstance(true);
//turn on php logging if local
if ($_SERVER['HTTP_HOST'] == 'localhost' || strstr($_SERVER['HTTP_HOST'], '192.168.2')) {
    $php->setEnabled(true);
} else {
    //set false for production.
    $php->setEnabled(false);
}
