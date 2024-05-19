<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <?php require('inc/links.php')?>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<?php
        require('inc/header.php')
  ?>


<div class="container">
  <div class="row">

    <div class="col-12 my-5 px-4">
      <h2 class="fw-bold ">Payment Status</h2>
    </div>

    <?php
        $frm_data=$_GET;
        if(!(isset($_SESSION['login'])&& $_SESSION['login']==true)){
            redirect('home.php');
        }
        $booking_q="SELECT bo.*,bd.* FROM `booking_order` bo 
        INNER JOIN `booking_details` bd ON bo.booking_id=bd.booking_id
        WHERE bo.order_id=? AND bo.user_id=? AND bo.booking_status!=?";

        $booking_res=select($booking_q,[$frm_data['order'],$_SESSION['uId'],'pending'],'sis');
        if(mysqli_num_rows($booking_res)==0){
            redirect('home.php');
        }
        $booking_fetch=mysqli_fetch_assoc($booking_res);
        if($booking_fetch['trans_status']=="Success"){
            echo<<< data
              <div class="col-12 px-4">
                <p class="fw-bold alert alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    Payment Done. Booking Successful.
                    <br><br>
                    <a href='bookings.php'>Go to Bookings </a>
                </p>
              </div>
            data;
        }
        else{
            echo<<< data
              <div class="col-12 px-4">
                <p class="fw-bold alert alert-success">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Payment Failed.
                    <br><br>
                    <a href='bookings.php'>Go to Bookings </a>
                </p>
              </div>
            data;
        }
    ?>
    
   
  </div>
</div>



<?php require('inc/footer.php'); ?>


    
</body>
</html>