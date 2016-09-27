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

if((isset($_POST['title']))&&(isset($_POST['description']))){
$title=$_POST['title'];
    $description=$_POST['description'];
    $link=$_POST['link'];
    $writerId=Helpers::loginUserId();
    $createdAt=date("Y-m-d H:i:s");
    $updatedAt=date("Y-m-d H:i:s");
    $location="timeline.php";

    $query= "insert into `articles` (`title`,`description`,`link`,`writer_id`,`created_at`,`updated_at`) values('{$title}', '{$description}', '{$link}','{$writerId}','{$createdAt}','{$updatedAt}')";
    var_dump($query);
    DBConnection::getConnection()->query($query);
    header("location: $location");
}
if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"></head>
<body style="background-color: midnightblue;">
<div  style="width:400px;  margin-top:100px; margin-left: 500px; background-color: midnightblue; color: aliceblue">
    <h1 align="middle">ADD NEW ARTICLE</h1>
</div>
<div class="well" style="width:600px; height: 400px ; margin:0px auto;">
    <form class="form-horizontal" method="post"  aligm="middle">
        <div class="form-group">
            <label class="col-md-4 control-label">TITLE:</label>
            <div class="col-md-6">
                <input name="title" class="form-control" type="text"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">DESCRIPTION:</label>
            <div class="col-md-6">
                <input name="description" class="form-control" type="text"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">LINK:</label>
            <div class="col-md-6">
                <input name="link" class="form-control" type="text"/>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-12 btn">
                <button type="submit" class="btn btn-primary">
                    CREATE
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

