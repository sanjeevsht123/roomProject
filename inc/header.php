<?php

require('admin/inc/db_config.php');
require('admin/inc/essentials.php');


$contact_q="SELECT * FROM `contact_details` WHERE `sr_no`=?";
$settings_q="SELECT * FROM `settings` WHERE `sr_no`=?";
$values=[1];
$contact_r=mysqli_fetch_assoc(select($contact_q,$values,'i'));

$settings_r=mysqli_fetch_assoc(select($settings_q,$values,'i'));


$general_q=selectAll('settings');
$general_r=mysqli_fetch_assoc($general_q);
?>


<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
<div class="container-fluid">
  <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="home.php"><?php echo $settings_r['site_title']  ?></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active me-2" aria-current="page" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active me-2" aria-current="page" href="rooms.php">Rooms</a>
      </li>
        <li class="nav-item">
        <a class="nav-link active me-2" aria-current="page" href="facilities.php">Facalities</a>
      </li>
        <li class="nav-item">
        <a class="nav-link active me-2" aria-current="page" href="contact.php">Contact</a>
      </li>
        <li class="nav-item">
        <a class="nav-link active me-2" aria-current="page" href="about.php">About</a>
      </li>
      
    </ul>
    <div class="d-flex">
        <?php
          if(isset($_SESSION['login'])&& $_SESSION['login']==true){
            $path=USERS_IMG_PATH;
            echo<<<data
              <div class="btn-group">
                <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  <img src="$path$_SESSION[uPic]" style="width:25px; height:25px;" class="me-1">
                  $_SESSION[uName]
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                  <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </div>
            data;
          }
          else{
            echo<<<data
              <button type="button" class="btn btn-outline-dark me-lg-2 me-3 shadow-none" data-bs-toggle="modal" data-bs-target="#loginModal">
                      Login
              </button>
              <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                      Register
              </button>
            data;
          }
        ?>
     
  </div>
  </div>
</div>
</nav>


<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <form id="login-form">
      <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-person-circle fs-3 me-2"></i> User Login
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body">
      <div class="mb-3">
          <label  class="form-label">Email / Phone</label>
          <input type="text" name="email_mob" required class="form-control">
      </div>

      <div class="mb-4">
          <label  class="form-label">Password</label>
          <input type="password" name="pass" required class="form-control">
      </div>

      <div class="d-flex align-items-center justify-content-between">
          <button class="btn btn-dark shadow-none " >Login</button>
          <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forget Password ??</a>
      </div>

  </div>
    
      </form>
  </div>
</div>
</div>


<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="register-form">
          <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                  <i class="bi bi-person-add fs-3 me-2"></i> User Register
              </h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="container-fluid">
              <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Name</label>
                      <input name="name" type="text" class="form-control" required>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Email</label>
                      <input name="email" type="email" class="form-control" required>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Phone</label>
                      <input type="number" name="phonenum" class="form-control" required>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Picture</label>
                      <input type="file" name="profile" class="form-control" required accept=" .jpg, .jpeg, .png, .webp">
                  </div>
                  <div class="col-md-12 ps-0 mb-3">
                    <label  class="form-label">Address</label>
                    <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Pincode</label>
                      <input type="number" name="pincode" class="form-control" required>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Date of Birth</label>
                      <input type="date" name="dob" class="form-control" required>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Password</label>
                      <input type="password" name="pass" class="form-control" required>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                      <label  class="form-label">Conform Password</label>
                      <input type="password" name="cpass" class="form-control" required>
                  </div>
              </div>
          </div>
          <div class="text-center my-1">
            <button type="submit" class="btn btn-dark shadow-none " >Register</button>
          </div>
        </div>
    
      </form>
    </div>
  </div>
</div>