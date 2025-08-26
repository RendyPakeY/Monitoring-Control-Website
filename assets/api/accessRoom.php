<?php
include "../../element/config.php";

$room = $_GET['room'];
$value = $_GET['value'];

if($room == "pub-r1"){
    $query = "UPDATE `room` SET `room1`='$value' WHERE 1";
}
if($room == "pub-r2"){
    $query = "UPDATE `room` SET `room2`='$value' WHERE 1";
}

$koneksi->query($query);

echo "okajbdaojdbahidbajodbaduohd";
error_reporting(E_ALL);
ini_set("display_errors", 1);
echo "OK";
?>