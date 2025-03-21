<?php

    require('../admin/inc/db_config.php');
    require('../admin/inc/essentials.php');
    date_default_timezone_get();
    session_start();

    if(isset($_GET['fetch_rooms'])){
       //receive and decode availability data
       $chk_avail=json_decode($_GET['chk_avail'],true);


       //checkin and checkout filter validation
       if($chk_avail['checkin']!='' && $chk_avail['checkout']!=''){

        $today_date=new DateTime(date("Y-m-d"));
        $checkin_date=new DateTime($chk_avail['checkin']);
        $checkout_date=new DateTime($chk_avail['checkout']);
    
        if($checkin_date==$checkout_date){
            echo "<h3 class='text-center text-danger'>No rooms to show</h3>"; 
            exit;   
        }
        else if($checkout_date<$checkin_date){
            echo "<h3 class='text-center text-danger'>No rooms to show</h3>";
            exit;  
        }
        else if($checkout_date<$today_date){
            echo "<h3 class='text-center text-danger'>No rooms to show</h3>";
            exit;  
        }
       }

       //guest data decode
       $guests=json_decode($_GET['guests'],true);

       $adults=($guests['adults']!='')?$guests['adults']:0;
       $children=($guests['children']!='')?$guests['children']:0;




        //count no of rooms and output variable to store room card
        $count_rooms=0;
        $output="";



        $room_res=select("SELECT * FROM `rooms` WHERE `adult`>=? AND `children`>=? AND `status`=? AND `removed`=?",[$adults,$children,1,0],'iiii');

        while($room_data=mysqli_fetch_assoc($room_res)){


            //check availability logic
            if($chk_avail['checkin']!='' && $chk_avail['checkout']!=''){
                $tb_query="SELECT COUNT(*) AS `total_bookings` FROM `booking_order`
                WHERE booking_status=? AND room_id=?
                AND check_out > ? AND check_in < ?";
        
                $values=['booked',$room_data['id'],$chk_avail['checkin'],$chk_avail['checkout']];
                $tb_fetch=mysqli_fetch_assoc(select($tb_query,$values,'siss'));
        
                if(($room_data['quantity']-$tb_fetch['total_bookings'])==0){
                    continue;
                }
            }
            //get feature of the room

            $fea_q=mysqli_query($con,"SELECT f.name FROM `feature` f 
            INNER JOIN `room_features` rfea ON f.id=rfea.features_id
            WHERE rfea.room_id='$room_data[id]' ");

            $features_data="";
            while($fea_row=mysqli_fetch_assoc($fea_q)){
                
                $features_data .="<span class='badge rounded-pill bg-ligth text-dark text-wrap'>
                $fea_row[name]
                </span>";
                
            }

            //get feature of the room





            //get facilities of the room

            $fac_q=mysqli_query($con,"SELECT f.name FROM `facilities` f 
            INNER JOIN `room_facilities` rfac ON f.id=rfac.facilities_id
            WHERE rfac.room_id='$room_data[id]' ");

            $facilities_data="";
            while($fac_row=mysqli_fetch_assoc($fac_q)){
                $facilities_data .="<span class='badge rounded-pill bg-ligth text-dark text-wrap'>$fac_row[name]</span>";
            }



            //get facilities of the room


            //get thumbnail of the room

            $room_thumb=ROOMS_IMG_PATH."thumbnail.jpg";
            $thumb_q=mysqli_query($con,"SELECT * FROM `room_images`
            WHERE `room_id`='$room_data[id]' AND `thumb`='1' ");

            if(mysqli_num_rows($thumb_q)>0){
                $thumb_res=mysqli_fetch_assoc($thumb_q);
                $room_thumb=ROOMS_IMG_PATH.$thumb_res['image'];
            }

            //get thumbnail of the room
            $login=0;
            if(isset($_SESSION['login'])&& $_SESSION['login']==true){
                $login=1;
            }
            $book_btn="<button onclick='chcekLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now </button>";

          
            
            $output.="
                <div class='card mb-4 border-0 shadow'>
                    <div class='row g-0 p-3 align-items-center'>
                    <div class='col-md-5'>
                        <img src='$room_thumb' class='img-fluid rounded' alt='img'>
                    </div>

                    <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                        <h4 class='mb-4'>$room_data[name]</h4>

                        <div class='features mb-3'>
                            <h6 class='mb-1'>Features<h6 class='mb-1'>
                            $features_data
                        </div>

                        <div class='facalities mb-3'>
                            <h6 class='mb-1'>Facalities<h6 class='mb-1'>
                            $facilities_data
                        </div>

                        <div class='guest'>
                            <h6 class='mb-1'>Guest<h6 class='mb-1'>
                            <span class='badge rounded-pill bg-ligth text-dark text-wrap'>$room_data[adult] Adults</span>
                            <span class='badge rounded-pill bg-ligth text-dark text-wrap'>$room_data[children] Childrens</span>
                        </div>
                    </div>

                    <div class='col-md-2 text-center'>
                        <h6 class='mb-4'>₹ $room_data[price] per night</h6>
                        <a href='#' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>$book_btn</a>
                        <a href='room_details.php?id=$room_data[id]' class='btn btn-sm w-100 btn-outline-dark shadow-none'>More Details</a>

                    </div>

                    </div>
                </div>

            ";

            $count_rooms++;

        }


        if($count_rooms>0){
            echo $output;
        }
        else{
            echo "<h3 class='text-center text-danger'>No rooms to show</h3>";
        }

    }


?>


