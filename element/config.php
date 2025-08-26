<?php
$host = "localhost";
$username = "lucluc75_master";
$password = "lucioMonitoringControl";
$db = "lucluc75_master";

// $host = "localhost";
// $username = "root";
// $password = "123";
// $db = "uninus smarthome";

$koneksi = new mysqli($host, $username, $password, $db);

// test koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

?>