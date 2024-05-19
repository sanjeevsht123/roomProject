<?php


$epay_url="https://uat.esewa.com.np/epay/main";
$pid='ORD_'.random_int(11111,9999999);
$failedurl="http://localhost/roomProject/esewa/esewa_payment_failed.php?q=fu";
$successurl="http://localhost/roomProject/esewa/esewa_payment_success.php?q=su";
$merchant_code="EPAYTEST";
$fraudcheck_url="https://uat.esewa.com.np/epay/transrec";
?>