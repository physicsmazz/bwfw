<?php
date_default_timezone_set('America/New_York');
ob_start('ob_gzhandler');
session_start();
//database connection
//require_once 'includes/conn.inc.php';
function __autoload($class_name)
{
    require_once 'classes/' . $class_name . '.class.php';
}