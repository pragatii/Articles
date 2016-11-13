<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 25-09-2016
 * Time: 20:59
 */
namespace commerce;

use commerce\DBConnection;


require("Helpers.php");
require_once "config.php";
if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {

    $query = "select * from `articles` ORDER BY `created_at`";
    $result = DBConnection::getConnection()->query($query);
    $articleList = [];
    while ($row = $result->fetch_assoc()) {
        array_push($articleList, $row);
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
<body style="background-color: midnightblue;">
    <nav class="navbar navbar-default navbar-fixed-top" ">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"> Logout </a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <h2 align="middle" style="color: aliceblue ; margin-top: 70px">Latest Updates </h2>
    <?php foreach ($articleList as $item) {
        $query1 = "select `name`,`profile_pic` from `user` where `id`= " . $item['writer_id'];
        $result1 = DBConnection::getConnection()->query($query1);
        $userName = $result1->fetch_row();
       // var_dump($userName);
        $fetchActionQuery = "select `user_id`, `value` from `actions` where `article_id` = '{$item['id']}' and `type` = 'like'";
        $fetchCommentQuery = "select `user_id`, `value` from `actions` where `article_id` = '{$item['id']}' and `type` = 'comment'";
        $likesDb = DBConnection::getConnection()->query($fetchActionQuery);
        $commentsDb = DBConnection::getConnection()->query($fetchCommentQuery);
        $comments = [];
        while ($row = $commentsDb->fetch_assoc()) {
            array_push($comments, $row);
        }

        $likes = [];
        while ($row = $likesDb->fetch_assoc()) {
            array_push($likes, $row);
        }

        //var_dump($likes);

        ?>

        <div class="container" >


            <ul class="list-group">
                <li class="list-group-item" style="width:600px; height: 150px ; margin:0px auto;">
                    <div class="form-group" style="float : left ; width: 60%">
                        <div style="float: left ; width: 30%">
                            <?php
                            if ($userName[1] != null) {
                                $image_source = "$userName[1]";

                                ?>
                                <?php echo '<img alt="Responsive image" class="rounded mx-auto d-block" style="width: 80%; height:80%" src=" ' . $image_source . ' " >' ?>

                            <?php }
                            else { ?>
                                <img src="no-user-image.gif" alt="Responsive image" class="img-rounded">
                            <?php } ?>

                            <div class="form-group">
                                <h5 style="font-family: Arial"><strong><?php echo $userName[0]; ?></strong>

                                </h5>
                            </div>
                        </div>
                        <div style="float: right;width: 70% " class="col-md-6">
                            <?php

                            echo "Title:   " . $item["title"]; ?>
                            <br>
                            <?php

                            echo "Description:   " . $item["description"]; ?>
                            <br>
                            <?php

                            echo "Link:    " . $item["link"]; ?>
                        </div>

                    </div>

                    <div class="form-group" align="right" style="float: right; width: 40%;">
                        <?php if (Helpers::loginUserId() == $item["writer_id"]) { ?>


                            <?php echo '<a href= "edit_article.php?article_id= ' . $item['id'] . ' ">' ?>
                            <button type="submit" class="btn btn-primary">
                                Edit
                            </button>
                            </a>
                            <?php echo '<a href= "delete_article.php?article_id= ' . $item['id'] . ' ">' ?>
                            <button type="submit" class="btn btn-primary">
                                Delete
                            </button>


                            </a>

                        <?php }
                        ?>

                        <?php
                        $flag = false;
                        foreach ($likes as $like) {
                            if ($like["user_id"] == Helpers::loginUserId()) {
                                $flag = true;
                                break;
                            }
                        }

                        ?>
                        <div class="form-group" style="margin-top: 10%">
                            <?php
                            if ($flag) {
                                echo '<a href= "like_article.php?article_id= ' . $item['id'] . ' ">';
                                echo count($likes); ?> Unlike</a>
                            <?php } else {
                                echo '<a href= "like_article.php?article_id= ' . $item['id'] . ' ">';
                                echo count($likes); ?> Like</a>

                            <?php } ?>


                            <?php echo '<a href= "comment_article.php?article_id= ' . $item['id'] . ' ">';
                            echo count($comments); ?>

                            Comment </a>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px"><h6
                                style="font-style: italic; font-size: 15px; color: darkgray"><?php

                                echo "  Created at : " . $item["created_at"]
                                ?></h6>

                        </div>

                    </div>

        </div>


        </li>


        </ul>
        </div>


        </body>
        </html>

        <?php
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>
    <body>
    <div class="form-group">
        <div class="col-md-12 btn">
            <a href="article_form.php">
                <Button class="btn btn-primary">ADD ARTICLE</Button>
            </a>
            <a href="logout.php">
                <Button class="btn btn-primary">LOG OUT</Button>
            </a>
        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    echo "You Are Not Logged in!!"; ?>
    <div><a href="login.php">
            <Button class="btn btn-primary">LOG IN</Button>
        </a>
    </div>

<?php }
?>