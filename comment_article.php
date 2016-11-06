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
    var_dump($_article);
    $_type = "comment";
    // $_value = "1";



}
?>
<!DOCTYPE html>
<html lang="en" xmlns:color="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:midnightblue ;">
<h2 align="middle" style="color: aliceblue">All Comments </h2>
<div class="container">


    <ul class="list-group">

            <?php
            $checkQuery = "select `value` from `actions` where `article_id`= '{$_article}' and `type`='{$_type}'";
           // var_dump($checkQuery);
            $result = DBConnection::getConnection()->query($checkQuery);
            //var_dump($result);
            $commentList =[];
            while($row = $result->fetch_assoc() ) {
                array_push($commentList, $row);
            }
            //var_dump($commentList);

            if (!(empty($commentList))) {
            foreach ($commentList as $item) { ?>


        <li class="list-group-item" style="width:600px; height: 150px ; margin:0px auto;"><?php

            echo $item["value"];

            }

            }
            ?>
        </li>

        <form class="form-vertical" method="post" action="comment_submit.php">

                <textarea class=" form-control
        " rows="3" placeholder="Add your comment" name="textarea"
                          style="width:600px; height: 150px ; margin:0px auto;"></textarea>
            <?php echo '<input name="article_id"  type="hidden"  value=' . $_article . '>' ?>


            <div class="col-md-12 btn">
                <button type="submit" class="btn btn-primary">
                    ADD NEW COMMENT
                </button>


            </div>
        </form>
        <div class="col-md-12 btn">
            <a href="timeline.php">
                <button type="submit" class="btn btn-primary">
                    BACK
                </button>
            </a>
        </div>
</div>
</li>
</body>
</html>