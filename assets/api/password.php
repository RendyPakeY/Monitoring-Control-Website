<?php
include "../../element/config.php";

session_start();

$password = $_POST["password"];
$passnew = $_POST["passnew"];
$passcon = $_POST["passcon"];
$id = $_SESSION['id'];

$query = "SELECT * FROM akun WHERE akun.id = '$id'";

if($koneksi->query($query)->fetch_assoc()['password'] == $password){
    if($passnew == $passcon){
        $query = "UPDATE akun SET password = '$passnew' WHERE akun.id = '$id'";
        $koneksi->query($query);
        header("Location: ../../settings.php?code=3");
    } else{
        header("Location: ../../settings.php?code=2");
    }
} else{
    header("Location: ../../settings.php?code=1");
}
?>