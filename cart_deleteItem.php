<?php
require_once 'includes/config.inc.php';

$prodId = $_GET['id'];

unset($_SESSION['order'][$prodId]);
echo ('1');

