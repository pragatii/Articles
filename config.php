<?php

namespace commerce;

use mysqli;

class DBConnection
{
    public static function getConnection() {
        $connection = new mysqli('localhost', 'root', '', 'commerce');
        if ($connection->connect_error) {
            echo $connection->error;
            die;
        }
        return $connection;
    }
}

?>