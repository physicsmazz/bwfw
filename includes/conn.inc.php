<?php

// it's local, use the local db connection
if ($_SERVER['HTTP_HOST'] == 'localhost' || strstr($_SERVER['HTTP_HOST'], '192.168.2')){
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'physicsmazz');
    define('DB_PASSWORD', 'mazz6288');
    define('DB_NAME', 'betterways');
}else {
    define('DB_SERVER', 'betterwaysdb002.db.7355840.hostedresource.com');
    define('DB_USER', 'betterwaysdb002');
    define('DB_PASSWORD', 'MyDb!!6299');
    define('DB_NAME', 'betterwaysdb002');
}



$conn = new mySQLi (DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die(mysqli_error());