<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 27-09-2016
 * Time: 19:38
 */
namespace commerce;

use commerce\DBConnection;


require ("Helpers.php");
require_once "config.php";
if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {
    $location="timeline.php";

    $query = "delete * from `articles` where `id`='{$_GET["article_id"]}'";
     DBConnection::getConnection()->query($query);
    header("location: $location" );

}
else {
    echo "You Are Not Logged in!!";
}
?>