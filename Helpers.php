<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 22-09-2016
 * Time: 15:35
 */
namespace commerce;
use commerce\DBConnection;

require ("Constants.php");
require_once "config.php";

class Helpers
{
    public static function loginUserId(){
        $cookie=$_COOKIE[Constants::LOGIN_COOKIE];
        if(!is_null($cookie)){
           $userIdQuery = "select `user_id` from `sessions` WHERE `session_id`={$cookie}";
            $userResult = DBConnection::getConnection()->query($userIdQuery);
            $userId = $userResult->fetch_row();
            return $userId[0];
        } else {
            return null;
        }
    }

}