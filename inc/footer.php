
<div class="container-fluid bg-white mt-5">
  <div class="row">
    <div class="col-lg-4 p-4">
      <h3 class="h-font fw-bold fs-3 mb-4">
        <?php echo $general_r['site_title'] ?>
      </h3>
      <p>
        <?php echo $general_r['site_about'] ?>
      </p>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Links</h5>
      <a href="home.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
      <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
      <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
      <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
      <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Follow us</h5>
      <a href="<?php echo $contact_r['tw'] ?>" class="d-inline-block mb-2 text text-decoration-none">
          <i class="bi bi-twitter me-1">Twitter</i>
        </a><br>
        <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-2 text text-decoration-none">
          <i class="bi bi-facebook me-1">Facebook</i>
        </a><br>
        <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-2 text text-decoration-none">
          <i class="bi bi-instagram me-1">Instagram</i>
        </a><br>
    </div>
  </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by SanjTech</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
  let register_form=document.getElementById('register-form');
  register_form.addEventListener('submit',(e)=>{
    e.preventDefault();
    register();
  });

  function register()
   {
      let data=new FormData();

    data.append('name',register_form.elements['name'].value);
    data.append('email',register_form.elements['email'].value);
    data.append('phonenum',register_form.elements['phonenum'].value);
    data.append('profile',register_form.elements['profile'].files[0]);
    data.append('address',register_form.elements['address'].value);
    data.append('pincode',register_form.elements['pincode'].value);
    data.append('dob',register_form.elements['dob'].value);
    data.append('pass',register_form.elements['pass'].value);
    data.append('cpass',register_form.elements['cpass'].value);
    data.append('register','');


    
    let xhr=new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload=function(){
      var myModal = document.getElementById('registerModal');
      var modal = bootstrap.Modal.getInstance(myModal); 
      modal.hide();
      if(this.responseText=='pass_missmatch'){
        alert("erro","Error Occured");
      }
      else if(this.responseText=='email_already'){
        alert("erro","Error Occured");
      }
      else if(this.responseText=='phone_already'){
        alert("erro","Error Occured");
      }
      else if(this.responseText=='inv_img'){
        alert("erro","Error Occured");
      }
      else if(this.responseText=='upd_failed'){
        alert("erro","Error Occured");
      }
      else if(this.responseText=='ins_failed'){
        alert("erro","Error Occured");
      }
      else{
        alert("Registration successful");
        register_form.reset();
      }
      

    }

    xhr.send(data);
}

let login_form=document.getElementById('login-form');

login_form.addEventListener('submit',(e)=>{
    e.preventDefault();
    login();
  });

  function login()
   {
      let data=new FormData();

    data.append('email_mob',login_form.elements['email_mob'].value);
    data.append('pass',login_form.elements['pass'].value);
    data.append('login','');

    console.log(data)

    
    let xhr=new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload=function(){
      var myModal = document.getElementById('loginModal');
      var modal = bootstrap.Modal.getInstance(myModal); 
      modal.hide();


      if(this.responseText=='inv_email_mob'){
        alert("erro","Invalid Email or Mobile Number !");
      }
      else if(this.responseText=='not_verified'){
        alert("erro","Email is not verified !");
      }
      else if(this.responseText=='inactive'){
        alert("erro","Account Suspended !");
      }
      else if(this.responseText=='invalid_pass'){
        alert("erro","Invalid Password");
      }
      else{
        window.location=window.location.pathname;
      }
      

    }

    xhr.send(data);
}
function chcekLoginToBook(status,room_id){
  if(status){
    window.location.href='confirm_booking.php?id='+room_id;
  }
  else{
    alert('error','Please login');
  }
}
</script>


