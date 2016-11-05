<?php use commerce\DBConnection;
use commerce\Helpers;
require ("config.php");
require ("Helpers.php");

session_start(); ?>

<?php
$location="timeline.php";

$query = "SELECT * from `user` ";
$result = DBConnection::getConnection()->query($query);
$user_login = $result->fetch_all(MYSQLI_ASSOC);
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $emailAuth = $_POST['email'];
    $auth_pass = md5($_POST['password']);


    foreach ($user_login as $user_auth) {
        if ($user_auth["email"] === $emailAuth && $user_auth["password"] === $auth_pass) {
            echo "You are logged in!!!";
            echo "email " . $user_auth["email"] . "   password " . $user_auth["password"];
            $flag = true;
            session_unset();
            $random = mt_rand();
            setcookie("login_cookie", $random);
            header("location: $location" );

            $query="SELECT `id` from `user` where `email`='{$emailAuth}'";
            $result=DBConnection::getConnection()->query($query);
            $userId=$result->fetch_row();
            var_dump(Helpers::loginUserId());
            $insertQuery="insert into `sessions` (`session_id`,`user_id`) VALUES ('{$random}','{$userId[0]}')";
            DBConnection::getConnection()->query($insertQuery);
            break;
        } else {
            $flag = false;
        }
    }
    if (isset($flag) && !$flag) {
        $_SESSION["error"] = 1;
    }
} else {
    echo 'post not set';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body style="background-color: midnightblue;">
<div  style="width:400px;  margin-top:100px; margin-left: 500px; background-color: midnightblue; color: aliceblue">
    <h1 align="middle">LOG IN!!</h1>
</div>
<div class="well" style="width:600px; height: 400px ; margin:0px auto;">
<form class="form-horizontal" method="post" align="middle">
    <div class="form-group">
        <label class="col-md-4 control-label">EMAIL:</label>
        <div class="col-md-6">
            <input name="email" class="form-control" type="email"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">PASSWORD:</label>
        <div class="col-md-6">
            <input name="password" class="form-control" type="password"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12 btn">
            <button type="submit" class="btn btn-primary">Login
            </button>


        </div>
        <a href="index.php">Don't have an account <strong> Sign UP </strong></a>

    </div>
</form></div>
<?php
if (isset($_SESSION["error"])) {
    if ($_SESSION["error"] == 1) {
        echo "<p> Wrong Credentials </p>";
    }

}
var_dump($_SESSION);
?>
</body>
</html>
