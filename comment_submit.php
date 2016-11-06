<?php
use commerce\DBConnection;
use commerce\Helpers;

require("Helpers.php");
require_once "config.php";


$_value=$_POST['textarea'];
$_user = Helpers::loginUserId();
$_article = $_POST["article_id"];
$location = "comment_article.php?article_id=$_article";

var_dump($location);
$_type="comment";

//$location="login.php";

$query = "insert into `actions` (`user_id`,`article_id`,`type`,`value`) values('{$_user}', '{$_article}', '{$_type}', '{$_value}')";

var_dump($query);
DBConnection::getConnection()->query($query);
header("location: $location" );

?>