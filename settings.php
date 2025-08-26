<?php
include "element/config.php";
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: login/");
}

$query = "SELECT * FROM akun WHERE id =" . $_SESSION['id'];
$img = $koneksi->query($query)->fetch_assoc()['foto'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings | Monitoring Control</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style-settings.css">
    <link rel="icon" href="assets/img/logo.png">

</head>

<body>
    <div id="preload"></div>
    <header>
        <nav>
            <div class="logo">
                <img src="assets/img/logo.png" alt="Logo">
                <h1>Monitoring<br>Control</h1>
            </div>
            <div class="account">
                <div class="information">
                    <?php
                    $nama = $_SESSION['nama'];
                    $akses = $_SESSION['akses'];
                    echo "<p>$nama</p><p>Status: $akses</p>";
                    ?>
                </div>
                <img src="assets/img/profiles/<?php
                                                if ($img == "") {
                                                    echo "no.jpg";
                                                } else {
                                                    echo "$img";
                                                }
                                                ?>" alt="profile"> <!-- Profile Picture -->
            </div>
        </nav>
    </header>
    <main>
        <section class="side-bar">
            <div class="side-bar-container">
                <a href="assets/../"><i class="fa-solid fa-house"></i></a>
                <?php
                if ($_SESSION['akses'] === "Operator") {
                    echo "<a href='manage.php'><i class='fa-solid fa-users-gear'></i></a>";
                }
                ?>
                <a href="settings.php"><i class="fa-solid fa-address-card selected"></i></a>
            </div>
        </section>
        <!--Start PHP menu Logic -->
        <section class="content">
            <!-- GANTI USERNAME -->
            <div class="form">
                <div class="form-value">
                    <div class="form-top">
                        <h1>Personal Information</h1>
                    </div>
                    <form action="assets/api/username.php" method="post">
                        <div class="form-value">
                            <div class="kinan">
                                <label for="">Nama pengguna</label>
                                <input name="username" type="text">
                            </div>
                        </div>
                        <div class="bottom">
                            <p>
                                <?php
                                if (isset($_GET['code'])) {
                                    if ($_GET['code'] == 4) echo "<i class='fa-solid fa-circle-check'></i> Username berhasil diganti !";
                                }
                                ?>

                            </p>
                            <input type="submit" class="button-green" value="Ganti">
                        </div>
                    </form>
                </div>
            </div>
            <!-- GANTI PASSWORD -->
            <div class="form">
                <div class="form-value">
                    <div class="form-top">
                        <h1>Password Account</h1>
                    </div>
                    <form action="assets/api/password.php" method="post">
                        <div class="form-value">
                            <div class="kinan">
                                <label for="">Password baru</label>
                                <input type="password" name="passnew">
                                <label for="">Konfirmasi password</label>
                                <input type="password" name="passcon">
                            </div>
                            <div class="kinan">
                                <label for="">Password saat ini</label>
                                <input type="password" name="password">
                            </div>
                        </div>
                        <div class="bottom">
                            <p>
                                <?php
                                if (isset($_GET['code'])) {
                                    if ($_GET['code'] == 1) echo "<i class='fa-solid fa-circle-xmark'></i> Password saat ini yang anda masukan salah !";
                                    if ($_GET['code'] == 2) echo "<i class='fa-solid fa-circle-xmark'></i> Harap konfirmasi password dengan benar !";
                                    if ($_GET['code'] == 3) echo "<i class='fa-solid fa-circle-check'></i> Password berhasil diganti !";
                                }
                                ?>

                            </p>
                            <input type="submit" class="button-green" value="Ganti">
                        </div>
                    </form>
                </div>
            </div>

        </section>
        <section class="side-content">
            <div class="img">
                <form action="assets/api/profile.php" id="form" method="post" enctype="multipart/form-data">
                    <label for="update"><i class="fa-solid fa-pen-to-square"></i></label>
                    <input type="file" name="update" id="update" accept="image/jpg, image/jpeg, image/png" hidden>
                    <input type="submit" hidden>
                </form>
                <img src="assets/img/profiles/<?php
                                                if ($img == "") {
                                                    echo "no.jpg";
                                                } else {
                                                    echo "$img";
                                                }
                                                ?>" alt="profile">
            </div>
            <?php
            echo "
            <h1>Halo, $nama</h1>
            <p>$akses</p>
            "
            ?>
            <a href="element/logout.php"><button class="button-red">Keluar dari akun</button></a>
        </section>

    </main>
    <script>
        document.getElementById("update").onchange = function() {
            document.getElementById("form").submit();
            console.log("hens")
        };
    </script>
    <script src="https://kit.fontawesome.com/cc079fac56.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>