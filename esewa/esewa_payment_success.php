<?php 
// include 'config_esewa.php';
// echo "<h1> Payment Success. Thank you for choosing us.";
// $oid=$_GET['oid'];
// $amt=$_GET['amt'];
// $ref=$_GET['refId'];
// echo "<br>";
// echo "Order ID: ".$oid."<br>";
// echo "Amount:".$amt."<br>";
// echo "Reference:".$ref."<br>";




require('C:\xampp\htdocs\roomProject\admin\inc\db_config.php');
require('C:\xampp\htdocs\roomProject\admin\inc\essentials.php');
require('config_esewa.php');

$ref=$_GET['refId'];
$amt=$_GET['amt'];
$oid=$_GET['oid'];
$data =[
    'amt'=> $amt,
    'rid'=> $ref,
    'pid'=>$oid,
    'scd'=> $merchant_code
];

    $curl = curl_init($fraudcheck_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    

date_default_timezone_set("Asia/Kathmandu");
session_start();
unset($_SESSION['room']);


function regenrate_session($uid){
    $user_q=select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$uid],'i');
    $user_fetch=mysqli_fetch_assoc($user_q);

    $_SESSION['login']=true;
    $_SESSION['uId']=$user_fetch['id'];
    $_SESSION['uName']=$user_fetch['name'];
    $_SESSION['uPic']=$user_fetch['profile'];
    $_SESSION['uPhone']=$user_fetch['phonenum'];
}

header("Pragma:no-cache");
header("Cache-Control:no-cache");
header("Expires:0");
// $oid=$_GET['oid'];
// echo $oid;
$slct_query="SELECT `booking_id`,`user_id` FROM `booking_order` WHERE `order_id`='$_GET[oid]'";
$slct_res=mysqli_query($con,$slct_query);
if(mysqli_num_rows($slct_res)==0){
    redirect('home.php');
}
$slct_fetch=mysqli_fetch_assoc($slct_res);

if(isset($_SESSION['login'])&& $_SESSION['login']==true){

    regenrate_session($slct_fetch['user_id']);
}

if( $response="Success"){
    echo $response; 
 $upd_query="UPDATE `booking_order` SET `booking_status`='booked',`trans_id`='$ref',
                                        `trans_amt`=$amt,`trans_status`='$response'
                                        WHERE `booking_id`='$slct_fetch[booking_id]' ";

 mysqli_query($con,$upd_query);
}

else {
    $upd_query="UPDATE `booking_order` SET `booking_status`='Failed',`trans_id`=$ref,`trans_amt`=$amt,`trans_status`=$response WHERE `booking_id`='$slct_fetch[booking_id]' ";
  mysqli_query($con,$upd_query);
 
}
redirect('../pay_status.php?order='.$oid);
?>