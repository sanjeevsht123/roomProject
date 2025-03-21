<?php

require("inc/db_config.php");
require("inc/essentials.php");
session_start();
if((isset($_SESSION['adminLogin'])&& $_SESSION['adminLogin']==true)){
   redirect('dashboard.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <?php require("inc/links.php") ?>
    <style>
        .login-form{
            position: absolute;
            top:50%;
            left: 50%;
            transform:translate(-50%,-50%);
            width: 400px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="login-form text-center bg-white rounded shadow overflow-none">
        <form method="POST">
            
            <h4 class="text-white bg-dark ">Admin Login Panel</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control text-center" placeholder="Username" autocomplete="off">
                </div>

                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control text-center" placeholder="Password" autocomplete="off">
                </div>

                <button name="login" class="text-white custom-bg btn shadow-none" type="submit">Login</button>
            </div>
        </form>
    </div>

    <?php
    if(isset($_POST['login'])){
        $frm_data=filteration($_POST);
         $query="SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
         $values=[$frm_data['admin_name'],$frm_data['admin_pass']];
         

         
         $res=select($query,$values,"ss");
         if($res->num_rows==1){
           $row=mysqli_fetch_assoc($res);
           $_SESSION['adminLogin']=true;
           $_SESSION['adminId']=$row['id'];
           redirect("dashboard.php");
         }
         else{
           alert("error","Login failed -Invalid Creditantial");
         }
    
    }
    ?>  

<?php require("inc/scripts.php") ?>    
</body>
</html>