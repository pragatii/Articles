<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 27-09-2016
 * Time: 21:50
 */
namespace commerce;

use commerce\DBConnection;


require ("Helpers.php");
require_once "config.php";
if (isset($_COOKIE[Constants::LOGIN_COOKIE])) {





}
else {
    echo "You Are Not Logged in!!";
}
?>