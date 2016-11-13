<?php
use commerce\DBConnection;

//require_once "config.php";
require ("config.php");
//var_dump($_POST);
$_name=$_POST['name'];
$_email=$_POST['email'];
$_pass=md5($_POST['password']);
$date=$_POST['dob'];
//$image=file_get_contents($_POST['image']);
var_dump($_FILES['image']);
$location="login.php";
if(isset($_FILES)){
    if(isset($_FILES['image']['tmp_name'])){
        $dir="uploads/";
        $filePath="$dir".time().basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES['image']['tmp_name'],$filePath);
    }

}

$query= "insert into `user` (`name`,`email`,`password`,`dob`,`profile_pic`) values('{$_name}', '{$_email}', '{$_pass}', '{$date}', '{$filePath}')";

//var_dump($query);
DBConnection::getConnection()->query($query);
header("location: $location" );


?>