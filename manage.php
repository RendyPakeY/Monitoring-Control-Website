<?php
include "element/config.php";
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: login/");
}
if ($_SESSION['akses'] !== "Operator") {
    header("Location: assets/../");
}

$query = "SELECT * FROM akun";
$akun = $koneksi->query($query);
$query = "SELECT * FROM akun WHERE id =" . $_SESSION['id'];
$img = $koneksi->query($query)->fetch_assoc()['foto'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Manager | Monitoring Control</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style-manage.css">
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
                if($img == ""){
                    echo "no.jpg";
                }else{
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
                    echo "<a href='manage.php'><i class='fa-solid fa-users-gear selected'></i></a>";
                }
                ?>                
                <a href="settings.php"><i class="fa-solid fa-address-card"></i></a>
            </div>
        </section>
        <!--Start PHP menu Logic -->
        <section class="content">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama pengguna</th>
                            <th>Password</th>
                            <th>Akses</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbd">
                        <?php
                        $no = 1;
                        while ($x = $akun->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>$no</td>
                                <td>" . $x['username'] . "</td>
                                <td>" . $x['password'] . "</td>
                                <td>" . $x['akses'] . "</td>
                                <td><i class='fa-solid fa-trash' onclick='hapusAkun(" . '"' . $x['id'] . '"' . ")'></i></td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="form" id="form">
                <div class="form-value">
                    <div class="form-top">
                        <h1>Pendaftaran akun</h1>
                        <i class="fa-solid fa-xmark" onclick="openAdd()"></i>
                    </div>
                    <form action="assets/api/addUser.php" method="post">
                        <div class="form-value">
                            <div class="kinan">
                                <label for="">Nama pengguna</label>
                                <input type="text" name="username">
                                <label for="">Password</label>
                                <input type="password" name="password">
                            </div>
                            <div class="kinan">
                                <label for="">Akses</label>
                                <select name="akses" id="akses" name="akses">
                                    <option value="Operator">Operator</option>
                                    <option value="Tamu">Tamu</option>
                                </select>
                                <label for="">Konfirmasi Password</label>
                                <input type="password" name="passcon">
                            </div>
                        </div>
                        <div class="bottom">
                            <p>
                                <?php
                                if (isset($_GET['code'])) {
                                    if ($_GET['code'] == 1) echo "<i class='fa-solid fa-circle-xmark'></i> Harap konfirmasi password dengan benar !";
                                    if ($_GET['code'] == 2) echo "<i class='fa-solid fa-circle-check'></i> Akun berhasil dibuat !";
                                }
                                ?>

                            </p>
                            <input type="submit" class="button-green" value="Buat akun">
                        </div>
                    </form>
                </div>
            </div>
            <div class="add" onclick="openAdd()">
                <i class="fa-solid fa-user-plus"></i>
            </div>
        </section>
    </main>
    <script src="https://kit.fontawesome.com/cc079fac56.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>