<?php
/**
 * Created by PhpStorm.
 * User: Poko
 * Date: 05-11-2016
 * Time: 21:04
 */
use Curl\Curl;

require("Curl.php");
$curl = new Curl();
$curl->get('http://requestb.in/xd0wcnxd?q=a');
if ($curl->error) {
    echo "Error";
} else {
    echo "Success";
}

?>