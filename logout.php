<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 25-09-2016
 * Time: 22:17
 */
namespace commerce;

use commerce\DBConnection;


require("Helpers.php");
require_once "config.php";
if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {
    $loginUserId = Helpers::loginUserId();
    $query = "delete from `sessions` where `user_id`='{$loginUserId}' ";
    DBConnection::getConnection()->query($query);
    setcookie(Constants::LOGIN_COOKIE, "", time() - 3600);
    $location = "login.php";
    header("Location: $location");
}

?>