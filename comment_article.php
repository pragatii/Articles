<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 04-11-2016
 * Time: 00:13
 */
namespace commerce;

use commerce\DBConnection;


require("Helpers.php");
require_once "config.php";
if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {
    $location = "timeline.php";
    $_user = Helpers::loginUserId();
    $_article = $_GET["article_id"];
    $_type = "comment";
    // $_value = "1";
    $checkQuery = "select * from `actions` where `article_id`= '{$_article}' and `user_id`='{$_user}' and `type`='{$_type}'";
    $result = DBConnection::getConnection()->query($checkQuery);
    // var_dump($result);
    $commentList = $result->fetch_all(MYSQLI_ASSOC);
    var_dump($commentList);


}
?>
<!DOCTYPE html>
<html lang="en" xmlns:color="http://www.w3.org/1999/xhtml">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color: midnightblue;">
<h2 align="middle" style="color: aliceblue">All Comments </h2>
<div class="container">


    <ul class="list-group">
        <li class="list-group-item" style="width:600px; height: 150px ; margin:0px auto;">
            <?php
            if (!(empty($commentList))) {

            }
            ?>
            <div class="form-group">
            <form class="form-vertical" method="post" action="comment_submit.php"  >

                <textarea class="form-control" rows="3" placeholder="Add your comment" name="textarea"></textarea>
                <input type="hidden" value= "<?php  $_GET["article_id"] ?>  " name="article_id">
                <div class="form-group" align="right">
                    <a>

                        <div class="col-md-12 btn">
                    <button type="submit" class="btn btn-primary">
                        ADD COMMENT
                    </button>
                        </a>
                    </div>
                    </div>
            </div>
        </li>
</body>
</html>