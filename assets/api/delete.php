<?php
include "../../element/config.php";

session_start();

$id = $_GET["id"];

$query = "DELETE FROM akun WHERE id=$id";

$koneksi->query($query);

if($_SESSION['id'] !== $id){
    header("Location: ../../manage.php");
}else{
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../../login/");
}
?>