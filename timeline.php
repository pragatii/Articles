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
    while($row = $result->fetch_assoc() ) {
        array_push($articleList, $row);
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
    <h2 align="middle" style="color: aliceblue">Latest Updates </h2>
    <?php foreach ($articleList as $item) {
        $query1 = "select `name` from `user` where `id`= " . $item['writer_id'];
        $result1 = DBConnection::getConnection()->query($query1);
        $userName = $result1->fetch_row();
        $fetchActionQuery = "select `user_id`, `value` from `actions` where `article_id` = '{$item['id']}' and `type` = 'like'";
        $likesDb = DBConnection::getConnection()->query($fetchActionQuery);
        $likes=[];
        while($row = $likesDb->fetch_assoc() ) {
            array_push($likes, $row);
        }

        //var_dump($likes);

        ?>

        <div class="container">


            <ul class="list-group">
                    <li class="list-group-item" style="width:600px; height: 150px ; margin:0px auto;"><?php

                        echo "Title " . $item["title"]; ?>
                        <div class="form-group" align="left"><?php
                            echo "Created by : " . $userName[0];

                            ?>


                            <div class="form-group" align="right">
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
                                $flag =false;
                                foreach ($likes as $like){
                                    if($like["user_id"]==Helpers::loginUserId()){
                                      $flag=true;
                                        break;
                                    }
                                }

                                ?>

                                <?php
                                if($flag){
                                echo '<a href= "like_article.php?article_id= ' . $item['id'] . ' ">'; echo count($likes);?> Unlike</a>
                                    <?php }
                                    else {
                                        echo '<a href= "like_article.php?article_id= ' . $item['id'] . ' ">'; echo count($likes);?> Like</a>

                                        <?php } ?>


                                <?php echo '<a href= "comment_article.php?article_id= ' . $item['id'] . ' ">' ?>
                                Comment </a>



                            </div>

                        </div>
                        <div class="form-group" align="right"><?php

                            echo "  Created at : " . $item["created_at"]
                            ?>

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