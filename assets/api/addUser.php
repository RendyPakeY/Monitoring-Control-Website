<?php
include "../../element/config.php";

$username = $_POST["username"];
$password = $_POST["password"];
$passcon = $_POST["passcon"];
$akses = $_POST["akses"];

$query = "INSERT INTO `akun`(`username`, `password`, `akses`) VALUES ('$username','$password','$akses')";

if($password === $passcon){
    $koneksi->query($query);
    header("Location: ../../manage.php?code=2");
}else{
    header("Location: ../../manage.php?code=1");
}

?>