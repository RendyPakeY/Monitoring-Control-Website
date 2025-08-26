<?php
include "../../element/config.php";

session_start();

$username = $_POST["username"];
$id = $_SESSION['id'];

$query = "UPDATE akun SET username = '$username' WHERE akun.id = '$id'";

$koneksi->query($query);

unset($_SESSION['username']);
$_SESSION['nama'] = $username;
header("Location: ../../settings.php?code=4");
?>