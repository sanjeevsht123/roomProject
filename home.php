<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
     <?php require('inc/links.php')?>
    
    <style>
        .check_availability{
          margin-top: -50px;
          z-index: 2;
          position: relative;
         
        }
    </style>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

    <?php
          require('inc/header.php')
      ?>

  <div class="container-fluid">
    <!-- Swiper -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="Images/Slider/1.jpg"  class="w-100 d-block img-fluid"/>
          </div>
          <div class="swiper-slide">
          <img src="Images/Slider/3.jpg" class="w-100 d-block img-fluid" />
          </div>
          <div class="swiper-slide">
          <img src="Images/Slider/2.jpg"  class="w-100 d-block img-fluid"/>
          </div>
          <div class="swiper-slide">
          <img src="Images/Slider/4.jpg" class="w-100 d-block img-fluid" />
          </div>
        </div>
      </div>

    <!-- Swiper JS -->
  </div>

  <!-- Check Avilable-->
  <div class="container check_availability">
    <div class="row ">
      <div class="col-lg-12 bg-white p-4 rounded shadow">
        <h5 class="mb-4">Check Availability</h5>

        <form action="rooms.php">
          <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
              <label  class="form-label">Check-In</label>
              <input type="date" class="form-control" name="checkin" required>
            </div>
            <div class="col-lg-3 mb-3">
              <label  class="form-label">Check-Out</label>
              <input type="date" class="form-control" name="checkout" required>
            </div>
            <div class="col-lg-3 mb-3">
              <label  class="form-label" >Adult</label>
              <select class="form-select shadow-none" name="adult">

              <?php
                $guests_q=mysqli_query($con,"SELECT MAX(adult) AS `max_adult`,MAX(children) AS `max_children` FROM `rooms`
                WHERE `status`='1' AND `removed`='0'");

                $guests_res=mysqli_fetch_assoc($guests_q);
                for($i=1;$i<=$guests_res['max_adult'];$i++){
                  echo"<option value='$i'>$i</option>";
                }
              ?>
              </select>
            </div>
            <div class="col-lg-2 mb-3">
              <label  class="form-label">Children</label>
              <select class="form-select shadow-none" name="children">
               <?php
                  for($i=1;$i<=$guests_res['max_children'];$i++){
                    echo"<option value='$i'>$i</option>";
                  }
               ?>
              </select>
            </div>
            <input type="hidden" name="check_availability">



            <div class="col-lg-1 mb-lg-2 mt-2">
              <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Our Rooms -->
  <h2 class="mt-5 mb-4 pt-4 text-center fw-bold h-font">Our Rooms</h2>
  <div class="container">
    <div class="row">
      <?php

        $room_res=select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?  ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

        while($room_data=mysqli_fetch_assoc($room_res)){


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


          echo <<<data
            <div class="col-lg-4 col-md-6 my-3">
              <div class="card border-0 shadow" style="width: 350px; margin: auto;">
                <img src="$room_thumb" class="card-img-top">
                <div class="card-body">
                  <h5 class="card-title">$room_data[name]</h5>

                  <h6 class="mb-4">₹ $room_data[price] per night</h6>

                  <div class="facilities mb-4">
                    <h6 class="mb-1">Facilities<h6 class="mb-1">
                    $features_data
                  </div>

                  <div class="features mb-4">
                    <h6 class="mb-1">Features<h6 class="mb-1">
                    $facilities_data
                  </div>

                  <div class="guest mb-4">
                    <h6 class="mb-1">Guest<h6 class="mb-1">
                      <span class="badge rounded-pill bg-ligth text-dark text-wrap">$room_data[adult] adults</span>
                      <span class="badge rounded-pill bg-ligth text-dark text-wrap">$room_data[children] Children</span>
                  </div>


                  <div class="d-flex justify-content-evenly mb-2">
                    <a href="#" class="btn btn-sm text-white custom-bg shadow-none">$book_btn</a>
                    <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                  </div>
                </div>
              </div>
            </div>




          

          data;


        }




      ?>

      <div class="col-lg-12 text-center mt-5">
        <a href="rooms.php" class="btn btn-outline-dark btn-sm rounded-0 fw-bold shadow-none">More Rooms>>></a>
      </div>

    </div>
  </div>


  <!-- Our Facilities -->
  <h2 class="mt-5 mb-4 pt-4 text-center fw-bold h-font">Our Facalities</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
      <?php
      // $res=selectAll('facilities');
      $res=mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5 ");
      $path=FACILITY_IMG_PATH;
      
      while($row=mysqli_fetch_assoc($res)){
        echo<<< data
          <div class="col-lg-2 col-md-2 text-center rounded py-4 my-3 shadow">
            <img src="$path$row[icon]" alt="wifi" width="80px">
            <h6 class="mt-3">$row[name]</h6>
          </div>
        data;
      }
      ?>


    
    
      <div class="col-lg-12 text-center mt-5">
        <a href="facilities.php" class="btn btn-outline-dark btn-sm rounded-0 fw-bold shadow-none">More Facalities >>></a>
      </div>
    </div>
  </div>


  <!-- Testimonials -->
  <h2 class="mt-5 mb-4 pt-4 text-center fw-bold h-font">Testimonials</h2>

  <div class="container mt-5">
    <div class="swiper swiper-testimonials">
      
      <div class="swiper-wrapper mb-5">

        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="" alt="pf1" width="30px">
            <h6 class="m-0 ms-2">User 1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime 
            sed unde architecto nulla officiis, ut ad maiores at vero, 
            qui minus beatae impedit pariatur reprehenderit eos ullam mollitia
            tenetur quae.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>

      <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="" alt="pf1" width="30px">
            <h6 class="m-0 ms-2">User 1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime 
            sed unde architecto nulla officiis, ut ad maiores at vero, 
            qui minus beatae impedit pariatur reprehenderit eos ullam mollitia
            tenetur quae.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
      </div>

      <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="" alt="pf1" width="30px">
            <h6 class="m-0 ms-2">User 1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime 
            sed unde architecto nulla officiis, ut ad maiores at vero, 
            qui minus beatae impedit pariatur reprehenderit eos ullam mollitia
            tenetur quae.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
      </div>

    </div>
    <div class="swiper-pagination mb-4"></div>
    <div class="col-lg-12 text-center mt-5">
      <a href="about.php" class="btn-outline-dark btn btn-sm rounded-0 fw-bold shadow-none">Know More >>>>></a>
    </div>
  </div>

  <!-- Reach us -->


  <h2 class="mt-5 mb-4 pt-4 text-center fw-bold h-font">Reach Us</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 mb-lg-0 mb-4 p-4 bg-white rounded">
        <iframe height="320px rounded"class="w-100" src="<?php echo $contact_r['iframe'] ?>"  loading="lazy"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white rounded p-4 mb-4">
          <h5>Call Us</h5>
          <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-inbound-fill"></i> +<?php echo $contact_r['pn1'] ?></a>
            <br>

            <?php
              if($contact_r['pn2']!=''){
                echo <<<data
                  <a href="tel: +$contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-dark">
                  <i class="bi bi-telephone-inbound-fill"></i> + $contact_r[pn2]</a>
                data;
              }
            ?>
        </div>

        <div class="bg-white rounded p-4 mb-4">
          <h5>Follow Us</h5>

          <?php
              if($contact_r['tw']!=''){
                echo <<<data
                  <a href="$contact_r[tw]" class="d-inline-block mb-3 p-1">
                  <span class="badge bg-ligth text-dark fs-6 p-2">
                    <i class="bi bi-twitter me-1">Twitter</i>
                  </span>
                  </a>
                data;
              }
            ?>


          <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3 p-1 m-0">
            <span class="badge bg-ligth text-dark fs-6 p-2">
              <i class="bi bi-facebook me-1">Facebook</i>
            </span>
            </a>

            <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block ">
              <span class="badge bg-ligth text-dark fs-6 p-2">
                <i class="bi bi-instagram me-1">Instagram</i>
              </span>
              </a>
        </div>
      </div>
    </div>
  </div>


  <!-- Footer -->

  <?php require('inc/footer.php'); ?>


  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      effect: "fade",
      loop:true,
      autoplay:{
        delay:3000,
        disableOnInteraction:false,
      }
     
    });



    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView:"3",
      loop:true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints:{
        320:{
          slidesPerView:1,
        },
        640:{
          slidesPerView:1,
        },
        768:{
          slidesPerView:2,
        },
        1024:{
          slidesPerView:3,
        },
      },
      autoplay:{
        delay:3000,
        disableOnInteraction:false,
      }
    });
  </script>
</body>
</html>