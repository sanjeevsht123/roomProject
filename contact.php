<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
     <?php require('inc/links.php')?>
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

  <?php
        require('inc/header.php')
    ?>

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">Our Facalities</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
    Sit aperiam corporis architecto! Libero distinctio,
     repudiandae laboriosam reprehenderit inventore deleniti error.</p>
</div>


<?php

$contact_q="SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values=[1];
$contact_r=mysqli_fetch_assoc(select($contact_q,$values,'i'));
?>

<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4">
        <iframe height="320px "class="rounded w-100 mb-5" src="<?php echo $contact_r['iframe']?>"  loading="lazy"></iframe>
        <h3>Address</h3>
        <a href="<?php echo $contact_r['gmap']?>" target="_blank" class="inline-block text-deocretion-none text-dark">
          <i class="bi bi-geo-alt-fill"></i><?php echo $contact_r['address']?>
        </a>

        <h5 class="mt-3">Call Us</h5>
        <a href="tel: <?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone-inbound-fill"></i> +<?php echo $contact_r['pn1']?>
        </a><br>
        <?php
            if($contact_r['pn2']!=''){
              echo <<<data
                <a href="tel: +$contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-dark">
                <i class="bi bi-telephone-inbound-fill"></i> + $contact_r[pn2]</a>
              data;
            }
        ?>


        <h5 class="mt-3">Email</h5>
        <a href="mailTo: <?php echo $contact_r['email']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-envelope-fill"></i><?php echo $contact_r['email']?>
        </a>


        <h5 class="mt-3">Follow Us</h5>
        <a href="<?php echo $contact_r['tw']?>" class="d-inline-block text-dark fs-5 me-2">
          <i class="bi bi-twitter me-1"></i>
        </a>

        <a href="<?php echo $contact_r['fb']?>" class="d-inline-block  text-dark fs-5 me-2">
            <i class="bi bi-facebook me-1"></i>
        </a>

        <a href="<?php echo $contact_r['insta']?>" class="d-inline-block text-dark fs-5 ">
            <i class="bi bi-instagram me-1"></i>
        </a>
      </div>
    </div>

    

    <div class="col-lg-6 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 ">
        <form method="POST">
          <h5>Send Message</h5>
        <div class="mt-3">
            <label  class="form-label">Name</label>
            <input type="text" name="name" required class="form-control">
        </div>

        <div class="mt-3">
            <label  class="form-label">Email</label>
            <input type="email"  name="email" required class="form-control">
        </div>

        <div class="mt-3">
            <label  class="form-label">Subject</label>
            <input type="text"  name="subject"  required class="form-control">
        </div>

        <div class="mt-3">
            <label  class="form-label">Message</label>
            <textarea  class="form-control shadow-none"  required name="message" rows="10"></textarea>
        </div>

        <button type="submit"  name="send" class="btn btn-dark text-white custom-bg mt-3 ">Submit</button>
        </form>
      </div>
    </div>

  </div>
</div>

<?php
if(isset($_POST['send'])){
  $frm_data=filteration($_POST);

  $q="INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
  $values=[$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

  $res=insert($q,$values,'ssss');

  if($res==1){
    alert('success','Mail Sent');
  }
  else{
    alert('error','Error Occured');
  }


}

?>

<?php require('inc/footer.php'); ?>



</body>
</html>