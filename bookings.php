<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
     <?php require('inc/links.php')?>
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

  <?php
        require('inc/header.php');
        if(!(isset($_SESSION['login'])&& $_SESSION['login']==true)){
          redirect('rooms.php');
        }
  ?>


<div class="container">
  <div class="row">

    <div class="col-12 my-5 px-4">
      <h2 class="fw-bold ">Booking</h2>
      <div style="font-size:14px;">
        <a href="home.php" class="text-secondary text-decoration-none">Home</a>
        <span class="text-secondary"> > </span>

        <span class="text-secondary"> > </span>
        <a href="rooms.php" class="text-secondary text-decoration-none">Bookings</a>
      </div>
    </div>

    <?php
      $query="SELECT bo.*,bd.* FROM `booking_order` bo
      INNER JOIN `booking_details` bd ON bo.booking_id=bd.booking_id
      WHERE((bo.booking_status='booked')
      OR(bo.booking_status='cancelled')
      OR(bo.booking_status='payment failed'))
      AND(bo.user_id=?)
      ORDER BY bo.booking_id DESC";

      $result=select($query,[$_SESSION['uId']],'i');

      while($data=mysqli_fetch_assoc($result)){
      $date=date("d-m-Y",strtotime($data['datentime']));
      $checkin=date("d-m-Y",strtotime($data['check_in']));
      $checkout=date("d-m-Y",strtotime($data['check_out']));

      $status_bg="";
      $btn="";

      if($data['booking_status']=='booked'){
        $status_bg="bg-success";

          if($data['arrival']==1){
            $btn="<a href='generate_pdf.php&gen_pdf&id=$data[booking_id]'class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
            
          }
          else{
            $btn="<button onclick='cancel_bookin($data[booking_id])' type='button' class='btn btn-danger btn-sm shadow-none'>Cancel</button>";
          }
      }
      else if($data['booking_status']=='cancelled'){
        $status_bg="bg-danger";
        if($data['refund']==0){
          $btn="<span class='badge bg-primary'>Refund in Process</span>";
        }
        else{
          $btn="<a href='generate_pdf.php&gen_pdf&id=$data[booking_id]'class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
        }
      }
      else{
        $status_bg="bg-warning";
        $btn="<a href='generate_pdf.php&gen_pdf&id=$data[booking_id]'class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
      }

      echo<<<bookings
        <div class='col-md-4 px-4 mb-4'>
          <div class='bg-white p-3 rounded shadow-sm'>
            <h5 class='fw-bold'>$data[room_name]</h5>
            <p>Rs.$data[price] per night</p>
            <p>
              <b>Check in: </b>$checkin<br>
              <b>Check out: </b>$checkout
            </p>
            <p>
              <b>Amount: </b>Rs. $data[price]<br>
              <b>Order Id: </b>$data[order_id]<br>
              <b>Date: </b>$date
            </p>
            <p>
              <span class='badge $status_bg'>$data[booking_status]</span>
            </p>
            $btn
          </div>
        </div>
      bookings;
      }
    ?>

  </div>
</div>



<?php require('inc/footer.php'); ?>

<script>
  function cancel_bookin(id){
    if(confirm('Are you sure to cancel booking?'))
    {
      let xhr=new XMLHttpRequest();
      xhr.open("POST","ajax/cancel_booking.php",true);
      xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

      xhr.onload=function(){
          if(this.responseText==1){
            window.location.href="bookings.php?cancel_status=true";
          }
          else{
            alert('error','Cancelation failed');
          }
      }

      xhr.send('cancel_booking&id='+id);
    }
  }
</script>
    
</body>
</html>