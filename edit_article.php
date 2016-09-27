<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 27-09-2016
 * Time: 21:50
 */
namespace commerce;

use commerce\DBConnection;


require("Helpers.php");
require_once "config.php";


if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {

    $query = "SELECT `id`,`title`,`description`,`link` FROM `articles` where `id` =" . $_GET['article_id'];
    var_dump($query);
    $result = DBConnection::getConnection()->query($query);
    var_dump($result);

    $currentArticle = $result->fetch_row();
    var_dump($currentArticle);
    // $title=$currentArticle[0]["title"];


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
    </head>
    <body style="background-color: midnightblue;">
    <div style="width:400px;  margin-top:100px; margin-left: 500px; background-color: midnightblue; color: aliceblue">
        <h1 align="middle">ADD NEW ARTICLE</h1>
    </div>
    <div class="well" style="width:600px; height: 400px ; margin:0px auto;">
        <form class="form-horizontal" method="post" aligm="middle" action="edit_submit.php">
            <div class="form-group">
                <label class="col-md-4 control-label">TITLE:</label>
                <div class="col-md-6">
                    <?php echo '<input name="title" class="form-control" type="text" value=' . $currentArticle[1] . '>' ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">DESCRIPTION:</label>
                <div class="col-md-6">
                    <?php echo '<input name="description" class="form-control" type="text" value=' . $currentArticle[2] . '>' ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">LINK:</label>
                <div class="col-md-6">
                    <?php echo '<input name="link" class="form-control" type="text" value=' . $currentArticle[3] . '>' ?>
                </div>
            </div>
            <input name="id"  type="hidden" value=' <?php  $currentArticle[0]  ?>' />

            <div class="form-group">
                <div class="col-md-12 btn">

                    <button type="submit" class="btn btn-primary">

                        SAVE
                    </button>


                </div>


            </div>
        </form>
    </div>
    </body>
    </html>

    <?php

} else {
    echo "You Are Not Logged in!!";
}
?>