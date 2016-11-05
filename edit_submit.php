<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 28-09-2016
 * Time: 00:29
 */
namespace commerce;

use commerce\DBConnection;


require("Helpers.php");
require_once "config.php";
if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {
    $newTime=date("Y-d-m H:i:s");
  var_dump($newTime);
    $location="timeline.php";


    $query = "update `articles` set `title`='{$_POST['title']}' , `description`='{$_POST['description']}',`link`='{$_POST['link']}', `created_at`='{$_POST['created_at']}', `writer_id`='{$_POST['writer_id']}' where `id`='{$_POST['id']}'";
   // var_dump($query);
    $result= DBConnection::getConnection()->query($query);
    var_dump($result);
    header("location: $location" );


 ?>
    <?php

} else {
    echo "You Are Not Logged in!!";
}
?>
