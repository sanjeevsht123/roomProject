<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
     <?php require('inc/links.php')?>
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

  <?php
        require('inc/header.php');


        $checkin_default='';
        $checkout_default='';
        $adult_default='';
        $children_default='';
        if(isset($_GET['check_availability'])){
          $frm_data=filteration($_GET);
          $checkin_default=$frm_data['checkin'];
          $checkout_default=$frm_data['checkout'];
          $adult_default=$frm_data['adult'];
          $children_default=$frm_data['children'];
        }
  ?>

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">Our Rooms</h2>
  <div class="h-line bg-dark"></div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 mb-4 mb-lg-0 ps-4">

      <nav class="navbar navbar-expand-lg bg-white rounded shadow">
          <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-4">Filters</h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
              <!-- Check Availability -->
                <div class="mb-3 bg-light rounded border p-3">
                  <h4 class="mb-3 d-flex align-items-center justify-content-between" style="font: size 18px;">
                    <span>Check Availability</span>
                    <button id="chk_avail_btn" onclick=chk_avail_clear() class="btn btn-sm text-secondary d-none">Reset</button>
                  </h4>
                  <label  class="form-label">Check-In</label>
                  <input type="date" class="form-control mb-3" value="<?php echo $checkin_default; ?>" id="checkin" onchange="chk_avail_filter()">
                  <label  class="form-label">Check-Out</label>
                  <input type="date" class="form-control" value="<?php echo $checkout_default; ?>" id="checkout" onchange="chk_avail_filter()">
                </div>

                <!-- Facilities -->
            


                <!-- Guest -->
                <div class="mb-3 bg-light rounded border p-3">
                  <h4 class="mb-3 d-flex align-items-center justify-content-between" style="font: size 18px;">
                    <span>Guest</span>
                    <button id="guests_btn" onclick=guests_clear() class="btn btn-sm text-secondary d-none">Reset</button>
                  </h4>

                  <div class="d-flex">
                    <div class="me-2">
                      <label  class="form-label" >Adults</label>
                      <input type="number" min="1" id="adults" value="<?php echo $adult_default; ?>" oninput="guests_filter()" class="form-control shadow-none">
                    </div>

                    <div>
                      <label  class="form-label" >Children</label>
                      <input type="number" min="1" id="children" value="<?php echo $children_default; ?>"oninput="guests_filter()" class="form-control shadow-none">
                    </div>
                  </div>

                  

                </div>

            </div>
          </div>
      </nav>

    </div>

    <div class="col-lg-9 col-md-9 px-4" id="rooms-data">
    </div>
  </div>
</div>

<script>
  let rooms_data=document.getElementById('rooms-data');
  let checkin=document.getElementById('checkin');
  let checkout=document.getElementById('checkout');
  let chk_avail_btn=document.getElementById('chk_avail_btn');
  let adults=document.getElementById('adults');
  let children=document.getElementById('children');
  let guests_btn=document.getElementById('guests_btn');

  function fetch_rooms(){


    let chk_avail=JSON.stringify({
      checkin:checkin.value,
      checkout:checkout.value
    });

    let guests=JSON.stringify({
      adults:adults.value,
      children:children.value
    });

    let xhr=new XMLHttpRequest();
    xhr.open("GET","ajax/rooms.php?fetch_rooms&chk_avail="+chk_avail+"&guests="+guests,true);
    xhr.onprogress=function(){
      rooms_data.innerHTML=`<div class="spinner-border text-info mb-3 d-block mx-auto" id="info_loader" role="status">
                            <span class="visually-hidden">Loading...</span>
                            </div>`;
    }
    xhr.onload=function(){
      rooms_data.innerHTML=this.responseText;
    }
    xhr.send();
  }


  function chk_avail_filter(){
    if(checkin.value!='' && checkout.value !=''){
      fetch_rooms();
      chk_avail_btn.classList.remove('d-none');
    }
  }


  function chk_avail_clear(){
    checkin.value=''; 
    checkout.value='';
    chk_avail_btn.classList.add('d-none');
    fetch_rooms();
    
  }


  function guests_filter(){
    if(adults.value>0 || children.value>0){
      fetch_rooms();
      guests_btn.classList.remove('d-none');
    }
  }
  
  function guests_clear(){
    adults.value='';
    children.value='';
    guests_btn.classList.add('d-none');
    fetch_rooms();
  }
  



  
  fetch_rooms();
</script>

<?php require('inc/footer.php'); ?>
    
</body>
</html>