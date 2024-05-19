<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
     <?php require('inc/links.php')?>
    
    <style>
        .pop:hover{
          border-top-color: #2ec1ac !important;
          transform:scale(1.03);
          transition:all 0.3s;
        }
    </style>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

  <?php
        require('inc/header.php')
    ?>

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">ABOUT US</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
    Sit aperiam corporis architecto! Libero distinctio,
     repudiandae laboriosam reprehenderit inventore deleniti error.</p>
</div>

<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-lg-6 col-md-5 mb-4">
            <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                 Mollitia adipisci vitae ad enim deserunt repellat <br>
                 quisquam exercitationem tenetur harum consequatur!
            </p>
        </div>
        <div class="col-lg-5 col-md-4 mb-4">
            <img src="Images/about/about.jpg" class="w-100">
        </div>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 mt-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                <img src="Images/about/hotel.svg" alt="hotel" width="70px">
                <h4 class="mt-3">100+ Rooms</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                <img src="Images/about/customers.svg" alt="hotel" width="70px">
                <h4 class="mt-3">200+ Customers</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                <img src="Images/about/rating.svg" alt="hotel" width="70px">
                <h4 class="mt-3">1000+ ratings</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                <img src="Images/about/staff.svg" alt="hotel" width="70px">
                <h4 class="mt-3">100+ staff</h4>
            </div>
        </div>
    </div>
</div>

<h3 class="my-5 fw-bold h-font text-center mt-5">Management Team</h3>
<div class="container px-4">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper mb-5">
            <?php
                $about_r=selectAll('team_details');
                $path=ABOUT_IMG_PATH;
                while($row=mysqli_fetch_assoc($about_r)){
                    echo<<<data
                    <div class="swiper-slide bg-white text-center rounded overflow-hidden">
                        <img src="$path$row[picture]" class="w-100" >
                        <h4 class="mt-2">$row[name]</h4>
                    </div>
                    data;
                }
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<?php require('inc/footer.php'); ?>





  <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView:4,
        spaceBetween:40,

      pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
      },
    });
  </script>

    
</body>
</html>