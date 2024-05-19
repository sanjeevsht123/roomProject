<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Dashboard</title>
    <?php require("inc/links.php");?>
</head>
<body class="bg-light">
   
   <?php 
        require('inc/header.php');
        $is_shutdown=mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings`"));

        $current_bookings=mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(CASE WHEN booking_status='booked' AND arrival=0 THEN 1 END) AS `new_bookings`,
        COUNT(CASE WHEN booking_status='cancelled' AND refund=0 THEN 1 END) AS `refund_bookings`
        FROM `booking_order`"));


        $unread_queries=mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count` FROM `user_queries` WHERE `seen`=0"));
        
       
        $current_users=mysqli_fetch_assoc(mysqli_query($con,"SELECT
            COUNT(id) AS `total`,
            COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`,
            COUNT(CASE WHEN `status`=0 THEN 1 END) AS `inactive`
            FROM `user_cred`"));
   
   ?> 
    <div class="container-fluid " id="main-contain">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden ">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3>Dashboard</h3>
                </div>


                <div class="row mb-4">

                    <div class="col-md-3 mb-4">
                        <a href="new_bookings.php" class="text-decoration-none">
                            <div class="card text-center text-success p-3">
                                <h6 class="mt-2 mb-3">New Bookings</h6>
                                <h1 class="mt-2 mb-3"><?php echo $current_bookings['new_bookings'] ?></h1>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="refund_bookings.php" class="text-decoration-none">
                            <div class="card text-center text-danger p-3">
                                <h6 class="mt-2 mb-3">Refund Bookings</h6>
                                <h1 class="mt-2 mb-3"><?php echo $current_bookings['refund_bookings'] ?></h1>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="user_queries.php" class="text-decoration-none">
                            <div class="card text-center text-info p-3">
                                <h6 class="mt-2 mb-3">User Queries</h6>
                                <h1 class="mt-2 mb-3"><?php echo $unread_queries['count'] ?></h1>
                            </div>
                        </a>
                    </div>

                </div>


                <!-- <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5>Booking Analytics</h5>
                    <select class="form-select shadow-none bg-light w-auto">
                        <option value="1">Past 30 Days</option>
                        <option value="2">Past 90 Days</option>
                        <option value="3">Past 1 Year</option>
                        <option value="4">All time</option>
                    </select>
                </div> -->

                
                <!-- <div class="row mb-3">

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary">
                            <h6>Total Bookings</h6>
                            <h1 class="mt-2 mb-0">5</h1>
                            <h4 class="mt-2 mb-0">Rs.5</h1>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-success">
                            <h6>Active Bookings</h6>
                            <h1 class="mt-2 mb-0">5</h1>
                            <h4 class="mt-2 mb-0">Rs.5</h1>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary">
                            <h6>Cancel Bookings</h6>
                            <h1 class="mt-2 mb-0">5</h1>
                            <h4 class="mt-2 mb-0">Rs. 5</h1>
                        </div>
                    </div>

                </div> -->


                <!-- <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5>User,Queries Analytics</h5>
                    <select class="form-select shadow-none bg-light w-auto">
                        <option value="1">Past 30 Days</option>
                        <option value="2">Past 90 Days</option>
                        <option value="3">Past 1 Year</option>
                        <option value="4">All time</option>
                    </select>
                </div>

                <div class="row mb-3">

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-success">
                            <h6>New Registration</h6>
                            <h1 class="mt-2 mb-0">5</h1>
                            <h4 class="mt-2 mb-0">Rs.5</h1>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-primary">
                            <h6>Queries</h6>
                            <h1 class="mt-2 mb-0">5</h1>
                            <h4 class="mt-2 mb-0">Rs.5</h1>
                        </div>
                    </div>
                </div> -->


                <h5>Users</h5>
                <div class="row mb-3">
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-info p-3">
                            <h6>Total Users</h6>
                            <h1 class="mt-2 mb-4"><?php echo $current_users['total']?></h1>  
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-warning p-3">
                            <h6>Active Users</h6>
                            <h1 class="mt-2 mb-4"><?php echo $current_users['active']?></h1>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-danger p-3">
                            <h6>Inactive Users</h6>
                            <h1 class="mt-2 mb-4"><?php echo $current_users['inactive']?></h1>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <?php 
   require('inc/scripts.php');
   ?> 
</body>
</html>