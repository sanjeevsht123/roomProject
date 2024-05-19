<?php

require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
require('esewa/config_esewa.php');

date_default_timezone_set("Asia/Kathmandu");
session_start();

if(!(isset($_SESSION['login'])&& $_SESSION['login']==true)){
    redirect('home.php');
  }

  
  if(isset($_POST['pay_now'])){
   header("Pragma:no-cache");
   header("Cache-Control:no-cache");
   header("Expires:0");

   $ORDER_ID=$pid;
   $CUST_ID=$_SESSION['uId'];
   $TXT_AMOUNT=$_SESSION['room']['payment'];

   $frm_data=filteration($_POST);
   $query1="INSERT INTO `booking_order`( `user_id`, `room_id`, `check_in`, `check_out`,`order_id`) VALUES (?,?,?,?,?)";

   insert($query1,[$CUST_ID,$_SESSION['room']['id'],$frm_data['checkin'],$frm_data['checkout'],$ORDER_ID],'issss');

   $booking_id=mysqli_insert_id($con);

   $query2="INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,`user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";
   
   insert($query2,[$booking_id,$_SESSION['room']['name'],$_SESSION['room']['price'],$TXT_AMOUNT,$frm_data['name'],$frm_data['phonenum'],$frm_data['address']],'issssss');



  }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Checkout Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
<div class="col-md-6">
<h3><centre>Pay With<centre></h3>
<ul class="list-group">
<li class="list-group-item">
<form action="<?php echo $epay_url?>" method="POST">
<input value="<?php echo $TXT_AMOUNT;?>" name="tAmt" type="hidden">
<input value="<?php echo $TXT_AMOUNT;?>" name="amt" type="hidden">

<input value="0" name="txAmt" type="hidden">
<input value="0" name="psc" type="hidden">
<input value="0" name="pdc" type="hidden">
<input value=<?php echo $merchant_code?> name="scd" type="hidden">
<input value="<?php echo $pid?>" name="pid" type="hidden">
<input value="<?php echo $successurl?>" type="hidden" name="su">
<input value="<?php echo $failedurl?>" type="hidden" name="fu">
<input type="image" src="images/esewa.jfif">
</form>
</body>
</ul>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
</section>
</div>
<script src="js/script.js"></script>
</body>
</html>
