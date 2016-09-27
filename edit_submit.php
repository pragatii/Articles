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

    $query = "update `articles` set `title`='{$_POST['title']}' , `description`='{$_POST['description']}',`link`='{$_POST['link']}' where`id` =' {$_POST['id']}';
    var_dump($query);
     DBConnection::getConnection()->query($query);
   // var_dump($result);


 ?>
    <?php

} else {
    echo "You Are Not Logged in!!";
}
?>
