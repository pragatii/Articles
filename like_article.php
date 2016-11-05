<?php

namespace commerce;

use commerce\DBConnection;


require("Helpers.php");
require_once "config.php";
if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {
    $location = "timeline.php";
    $_user = Helpers::loginUserId();
    $_article = $_GET["article_id"];
    $_type = "like";
    // $_value = "1";
    $checkQuery = "select * from `actions` where `article_id`= '{$_article}' and `user_id`='{$_user}' and `type`='{$_type}'";
    $result = DBConnection::getConnection()->query($checkQuery);
    // var_dump($result);
    $articleList = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump($articleList);
//var_dump(empty($articleList));

    if (empty($articleList)) {
        $_value = "1";
        $query = "insert into `actions` (`user_id`,`article_id`,`type`,`value`) values('{$_user}', '{$_article}', '{$_type}', '{$_value}')";
        DBConnection::getConnection()->query($query);
        // header("location: $location");
    } else {
        $unlike_value = "0";
        $like_value = "1";
        $flipLikeQuery = "select `value` from  `actions` where `article_id`= '{$_article}' and `user_id`='{$_user}' and `type`='{$_type}'";
        $likeResult = DBConnection::getConnection()->query($flipLikeQuery);
        $likeValue = $likeResult->fetch_row();
        var_dump($likeValue);
        if ($likeValue[0] == "0") {
            $updatequery = "update `actions` set `value`= '{$like_value}' where `article_id`= '{$_article}' and `user_id`='{$_user}' and `type`='{$_type}' ";
            var_dump($updatequery);
            DBConnection::getConnection()->query($updatequery);
            //header("location: $location" );
        } else {
            $updatequery = "delete from `actions` where `article_id`= '{$_article}' and `user_id`='{$_user}' and `type`='{$_type}' ";
            var_dump($updatequery);
            DBConnection::getConnection()->query($updatequery);
            // header("location: $location" );
        }
    }
    header("location: $location" );
} else {
    echo "You Are Not Logged in!!";
}
?>