<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 25-09-2016
 * Time: 20:59
 */
namespace commerce;

use commerce\DBConnection;


require ("Helpers.php");
require_once "config.php";
if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {

    $query = "select * from `articles` ORDER BY `created_at`";
    $result = DBConnection::getConnection()->query($query);
    $articleList = $result->fetch_all(MYSQLI_ASSOC);

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
    <h2 align="middle" style="color: aliceblue">Latest Updates </h2>
    <?php foreach ($articleList as $item) {
        ?>

        <div class="container" >


            <ul class="list-group">
              <?php  if(Helpers::loginUserId()==$item["writer_id"]){ ?>
                <li class="list-group-item" style="width:600px; height: 100px ; margin:0px auto;"><?php

                    echo "Title " . $item["title"]; ?>

                    <div class="form-group"  align="right" >

                        <?php echo '<a href= "edit_article.php?article_id= '.$item['id'].' ">' ?>    <button type="submit" class="btn btn-primary">
                                Edit
                            </button></a>
                          <?php echo '<a href= "delete_article.php?article_id= '.$item['id'].' ">' ?>  <button type="submit" class="btn btn-primary">
                                Delete
                                </button>
                            </a>





                    </div>




                </li>
            <?php }
            else{ ?>
                <li class="list-group-item" style="width:600px; height: 50px ; margin:0px auto;"><?php

                    echo "Title " . $item["title"]; ?></li>
                <?php } ?>

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
    echo "You Are Not Logged in!!";
}
?>