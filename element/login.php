<?php
include "config.php";

$post_usr = $_POST['username'];    
$post_pass = $_POST['password'];

$verify = "SELECT * FROM akun WHERE username = '$post_usr' AND password = '$post_pass'";
$result = $koneksi->query($verify);

if ($result->num_rows == 1) {
    // Pengguna ditemukan, izinkan pengguna untuk masuk
    session_start();
    while($dataOut = $result->fetch_assoc()){
        $_SESSION['nama'] = $dataOut['username'];
        $_SESSION['akses'] = $dataOut['akses'];
        $_SESSION['foto'] = $dataOut['foto'];
        $_SESSION['id'] = $dataOut['id'];
    }
    header("Location: ../"); // Gantilah dengan halaman setelah login
} else {
    // Pengguna tidak ditemukan atau password salah
    header("Location: ../login?error=1"); // Gantilah dengan halaman setelah login
}

unset($_POST['password']);
unset($_POST['username']);
return;
$koneksi->close();
?>