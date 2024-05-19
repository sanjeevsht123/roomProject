<?php
//for ForntEnd

define('SITE_URL','http://127.0.0.1/roomProject/');
define('ABOUT_IMG_PATH',SITE_URL.'Images/about/');
define('FACILITY_IMG_PATH',SITE_URL.'Images/facilities/');
define('ROOMS_IMG_PATH',SITE_URL.'Images/Rooms/');
define('USERS_IMG_PATH',SITE_URL.'Images/users/');



   //for BackEnd
    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/roomProject/Images/');
    define('ABOUT_FOLDER','about/');
    define('FACILITY_FOLDER','facilities/');

    define('ROOMS_FOLDER','Rooms/');
    define('USERS_FOLDER','users/');

    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin'])&& $_SESSION['adminLogin']==true)){
            echo"
        <script>window.location.href='admin_login.php'; </script> ";
            }
        }
    

    function redirect($url){
        echo"
        <script>window.location.href='$url'; </script> ";
    }

    function alert($type,$msg){
        echo <<<alert
        <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        alert;
    }


    function uploadImage($image,$folder){

        $valid_mime=['image/jpeg','image/png','image/webp'];
        $img_mime=$image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img';
        }
        else if(($image['size']/(1024*1024))>2){

            return 'inv_size';// Invalid size
        }
        else{
            $ext =pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname='IMG_'.random_int(11111,99999).".$ext";
            $img_path=UPLOAD_IMAGE_PATH.$folder.$rname;
           if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
           }
           else{
            return 'upd_failed';
           }
        }
    }


    function deleteImage($image,$folder){
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        }
        else{
            return false;
        }
    }

    function uploadSVGImage($image,$folder){

        $valid_mime=['image/svg+xml'];
        $img_mime=$image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img';
        }
        else if(($image['size']/(1024*1024))>2){

            return 'inv_size';// Invalid size
        }
        else{
            $ext =pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname='IMG_'.random_int(11111,99999).".$ext";
            $img_path=UPLOAD_IMAGE_PATH.$folder.$rname;
           if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
           }
           else{
            return 'upd_failed';
           }
        }
    }

    function uploadUserImage($image){
        $valid_mime=['image/jpeg','image/png','image/webp'];
        $img_mime=$image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img';
        }
        
        else{
            $ext =pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname='IMG_'.random_int(11111,99999).".$ext";
            $img_path=UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

            // if($ext=='png'||  $ext=='PNG'){
            //    $img=imagecreatefrommpng($image['tmp_name']);
            // }
            // else if($ext=='webp'||$exr='WEBP'){
            //    $img=imagecreatefromwebp($image['tmp_name']);
               

            // }
            // else{
            //     $img=imagecreateforjpeg($image['tmp_name']);
            // }



            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }

?>