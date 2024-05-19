<?php

require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
require('inc/esewa/config_esewa.php');

date_default_timezone_set("Asia/Kathmandu");
session_start();
unset($_SESSION['room']);

header("Pragma:no-cache");
header("Cache-Control:no-cache");
header("Expires:0");

$slct_query="SELECT `booking_id`,`user_id` FROM `booking_order` W"
?>