<?php
use commerce\DBConnection;

//require_once "config.php";
require ("config.php");
$_name=$_POST['name'];
$_email=$_POST['email'];
$_pass=md5($_POST['password']);
$date=$_POST['dob'];
$location="login.php";

$query= "insert into `user` (`name`,`email`,`password`,`dob`) values('{$_name}', '{$_email}', '{$_pass}', '{$date}')";

var_dump($query);
DBConnection::getConnection()->query($query);
header("location: $location" );

?>