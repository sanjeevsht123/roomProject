<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
     <?php require('inc/links.php')?>
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

  <?php
        require('inc/header.php')
  ?>

  <?php
 
  if(!isset($_GET['id'])){
    redirect('rooms.php');
  }
  $data=filteration($_GET);
  $room_res=select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

  if(mysqli_num_rows($room_res)==0){
    redirect('rooms.php');
  }

  $room_data=mysqli_fetch_assoc($room_res);

 
  ?>



<div class="container">
  <div class="row">

    <div class="col-12 my-5 px-4">
      <h2 class="fw-bold "><?php echo $room_data["name"] ?></h2>
      <div style="font-size:14px;">
        <a href="home.php" class="text-secondary text-decoration-none">Home</a>
        <span class="text-secondary"> > </span>
        <a href="rooms.php" class="text-secondary text-decoration-none">Rooms</a>
      </div>
    </div>

    <div class="col-lg-7 col-md-12 px-4  mb-4">
      <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

              <?php

                // get Image of the room

                   $room_img=ROOMS_IMG_PATH."thumbnail.jpg";
                   $img_q=mysqli_query($con,"SELECT * FROM `room_images`
                   WHERE `room_id`='$room_data[id]' ");

                    if(mysqli_num_rows($img_q)>0){

                      $active_class='active';
                    while ($img_res=mysqli_fetch_assoc($img_q))
                      {
                        echo"
                          <div class='carousel-item $active_class'>
                            <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100' >
                          </div>";                   
                      $active_class='';
                    }
                    }
                    else{
                      echo"
                      <div class='carousel-item active'>
                        <img src='$room_img' class='d-block w-100' >
                      </div>";
                    }

                //get Image of the room

              ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div class="col-lg-5 col-md-12 px-4">

      <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-body">
          <?php
            echo<<<price
                <h4 class='mb-5'>$room_data[price] per night </h4>
            price;

            // echo<<<rating
            // <div class="mb-3">
            //   <span class="badge bg-ligth rounded-pill">
            //     <i class="bi bi-star-fill text-warning"></i>
            //     <i class="bi bi-star-fill text-warning"></i>
            //     <i class="bi bi-star-fill text-warning"></i>
            //     <i class="bi bi-star-fill text-warning"></i>
            //     <i class="bi bi-star-fill text-warning"></i>
            //   </span>
            //   </div>
            // rating;


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

            echo<<<features
              <div class="features mb-5">
                <h6 class="mb-1">Features<h6 class="mb-1">
                $features_data
              </div>

            features;

            //get feature of the room




            //get facilities of the room

            $fac_q=mysqli_query($con,"SELECT f.name FROM `facilities` f 
            INNER JOIN `room_facilities` rfac ON f.id=rfac.facilities_id
            WHERE rfac.room_id='$room_data[id]' ");

            $facilities_data="";
            while($fac_row=mysqli_fetch_assoc($fac_q)){
              $facilities_data .="<span class='badge rounded-pill bg-ligth text-dark text-wrap'>$fac_row[name]</span>";
            }

            echo<<<facilities

              <div class="facalities mb-5">
                <h6 class="mb-1">Facalities<h6 class="mb-1">
                $facilities_data
              </div>

            facilities;



            // //get facilities of the room



            echo<<<guest
              <div class="guest">
                  <h6 class="mb-1">Guest<h6 class="mb-5">
                  <span class="badge rounded-pill bg-ligth text-dark text-wrap">$room_data[adult] Adults</span>
                  <span class="badge rounded-pill bg-ligth text-dark text-wrap">$room_data[children] Childrens</span>
              </div>
            guest;

            echo<<<area
              <div class="area mb-5">
                <h6 class="mb-1">Area<h6 class="mb-1">
                <span class="badge rounded-pill bg-ligth text-dark text-wrap">
                $room_data[area] sq. ft.
                </span>
              </div>

            area;
                  //get thumbnail of the room
              $login=0;
              if(isset($_SESSION['login'])&& $_SESSION['login']==true){
                $login=1;
              }
              $book_btn="<button onclick='chcekLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now </button>";



            echo<<<book
              <a href="#" class="btn w-100 text-white custom-bg shadow-none mb-1">
              $book_btn
              </a>
            book;

              ?>
        </div>
      </div>
    </div>

    <div class="col-12 mt-4 mb-5 px-4">
      <div class="mb-4">
        <h5>Description</h5>
        <p>
          <?php echo $room_data['description'] ?>
        </p>
      </div>

    </div>

    <div class="col-12 mt-4 mb-2 px-4">
      <div class="mb-4">
        <h5>Recomendations</h5>
        
      </div>

    </div>
  </div>
</div>


<!-- ALOGRITHM -->
<?php

  // Function to calculate cosine similarity
  function cosineSimilarity($vec1, $vec2)
  {
      $dotProduct = 0;
      $magnitude1 = 0;
      $magnitude2 = 0;

      foreach ($vec1 as $key => $value) {
          if (isset($vec2[$key]) && is_numeric($value) && is_numeric($vec2[$key])) {
              $dotProduct += $value * $vec2[$key];
              $magnitude1 += $value * $value;
              $magnitude2 += $vec2[$key] * $vec2[$key];
          }
      }

      $magnitude = sqrt($magnitude1) * sqrt($magnitude2);

      return $magnitude != 0 ? $dotProduct / $magnitude : 0;
  }



  // Get selected room's attributes from the database
  $selectedRoomId = $_GET['id']; // Assuming you are using POST to send selected room ID
  $selectedRoomAttributes = array();

  $sql = "SELECT * FROM rooms WHERE id = $selectedRoomId ";


  // $sql = "SELECT rooms.name,rooms.adult,rooms.children,rooms.price,GROUP_CONCAT(facilities.name) as facilities
  //       FROM rooms
  //       JOIN room_facilities ON rooms.id = room_facilities.room_id
  //       JOIN facilities ON room_facilities.facilities_id = facilities.id
  //       WHERE rooms.id = $selectedRoomId AND status=1 AND removed=0";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $selectedRoomAttributes = array(
              // 'facilities' => explode(",", $row['area']),
              'name' => $row['name'],
              'num_adults' => $row['adult'],
              'num_children' => $row['children'],
              'price' => $row['price']
          );
      }
  }

  // Get all other room attributes from the database
  $allRoomsAttributes = array();

  $sql = "SELECT * FROM rooms WHERE id != $selectedRoomId AND status=1 AND removed=0";
  // $sql = "SELECT rooms.*,GROUP_CONCAT(facilities.name) as facilities
  // FROM rooms
  // JOIN room_facilities ON rooms.id = room_facilities.room_id
  // JOIN facilities ON room_facilities.facilities_id = facilities.id
  // WHERE rooms.id != $selectedRoomId AND status=1 AND removed=0";
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $allRoomsAttributes[$row['id']] = array(
              // 'facilities' => explode(",", $row['area']),
              'name' => $row['name'],
              'num_adults' => $row['adult'],
              'num_children' => $row['children'],
              'price' => $row['price']
          );
      }
  }

  // Calculate cosine similarity for each room
  $similarities = array();

  foreach ($allRoomsAttributes as $roomId => $attributes) {
      $similarity = cosineSimilarity($selectedRoomAttributes, $attributes);
      $threshold = 0.9; // Set your desired threshold here
      if ($similarity >= $threshold) {
          $similarities[$roomId] = $similarity;
      }
      
  }

  arsort($similarities);
  // Display recommended rooms (limited to top 5)
  $top5Similarities = array_slice($similarities, 0, 5, true); // Get the top 5 similarities

  foreach ($top5Similarities as $roomId => $similarity) {
      // Fetch room details from the database
      $sql = "SELECT * FROM rooms WHERE id = $roomId";
      $result = $con->query($sql);

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          // $facilities = implode(",",explode(",", $row['facilities']));
          
          //Room image
          echo"<div class='container '>
          <div class='row'>
          <div class='col-lg-3 col-md-6 mb-3'>
          ";
          $room_img=ROOMS_IMG_PATH."thumbnail.jpg";
          $img_q=mysqli_query($con,"SELECT * FROM room_images
          WHERE `room_id`=$roomId ");

          if(mysqli_num_rows($img_q)>0){

            $active_class='active';
          while ($img_res=mysqli_fetch_assoc($img_q))
            {
              echo"
                <div class='carousel-item $active_class'>
                  <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100' >
                </div>";                   
            $active_class='';
          }
          }
          else{
            echo"
            <div class='carousel-item active'>
              <img src='$room_img' class='d-block w-100' >
            </div>";
          }
          echo"</div>";
          //Room image


          // Display room details
          echo<<< recom
            <div class="col-lg-3 mb-3"
              <div class="card">
                <div class="card-body">
                  <p class="card-text fw-bold text-center"> $row[name] </p>
                  <p class="card-text">Number of Adults:  $row[adult] </p>
                  <p class="card-text">Number of Children:  $row[children] </p>
                  <p class="card-text">Price:  $row[price] </p>
                  <a href="room_details.php?id=$roomId" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                </div>
              </div>
            </div>
          </div>
          </div>
          recom;
      }
  }

  // Close the database connection
  $con->close();

?>
<?php require('inc/footer.php'); ?>
    
</body>
</html>