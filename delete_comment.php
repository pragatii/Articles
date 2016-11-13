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
    $_article = $_GET["article_id"];

    $location="comment_article.php?article_id=$_article";

    $query = "delete  from `actions` where `id`=" .$_GET["comment_id"];
    $result= DBConnection::getConnection()->query($query);
    var_dump($result);
    header("location: $location" );

    if ($result) {
        ?>
        <h4>Blog successfully deleted!</h4>
    <?php }


}
else {
    echo "You Are Not Logged in!!";
}
?>