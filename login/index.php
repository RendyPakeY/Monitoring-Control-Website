<?php
session_start();

if(isset($_SESSION['nama'])){
    header("Location: ../");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Monitoring Control</title>
    <link rel="stylesheet" href="../assets/css/style-login.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/img/logo.png">
</head>

<body>
    <div id="preload"></div>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="../assets/img/logo.png" alt="Logo">
                <h1>Monitoring<br>Control</h1>
            </div>

            <form action="../element/login.php" method="post">
                <label for="Username">Username</label>
                <input name="username" type="text" placeholder="Masukan usermame..">
                <label for="Password">Password</label>
                <input name="password" type="password" placeholder="Masukan password..">
                <p>
                <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == 1)echo "<i class='fa-solid fa-circle-xmark'></i>Akun anda tidak ditemukan !";
                }
                ?>
                </p>
                <input type="submit" class="button-green" value="Masuk">
            </form>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/cc079fac56.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>