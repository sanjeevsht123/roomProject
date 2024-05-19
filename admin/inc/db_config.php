<?php
$host="localhost";
$db_name="room_booking";
$uname="root";
$pass="";

$con=mysqli_connect($host,$uname,$pass,$db_name);


if(!$con){
    die("Not Connected");
}


function filteration($data){

    foreach($data as $key=>$value){
        $data[$key]=trim($value);
        $data[$key]=stripcslashes($value);
        $data[$key]=htmlspecialchars($value);
        $data[$key]=strip_tags($value);
    }
    return $data;
}

function select($sql,$values,$datatypes){
    $con=$GLOBALS['con'];
    if($stmt=mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res=mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            die("Query cannot be executed- Select");
        }
    }
    else{
        die("Query cannot be prepared -select");
    }
}

function selectAll($table){
    $con=$GLOBALS['con'];
    $res=mysqli_query($con,"SELECT * FROM $table");
    return $res;
}

function update($sql,$values,$datatypes){
    $con=$GLOBALS['con'];
    if($stmt=mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res=mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt-close($stmt);
            die("Query cannot be executed- Update");
        }
    }
    else{
        die("Query cannot be prepared -Update");
    }
}

function insert($sql,$values,$datatypes){
    $con=$GLOBALS['con'];
    if($stmt=mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res=mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query cannot be executed- Insert");
        }
    }
    else{
        die("Query cannot be prepared -Insert");
    }
}

function delete($sql,$values,$datatypes){
    $con=$GLOBALS['con'];
    if($stmt=mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res=mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt-close($stmt);
            die("Query cannot be executed- Delete");
        }
    }
    else{
        die("Query cannot be prepared -Delete");
    }
}

?>