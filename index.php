<?php
include "element/config.php";
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: login/");
}
$query = "SELECT * FROM akun WHERE id =" . $_SESSION['id'];
$img = $koneksi->query($query)->fetch_assoc()['foto'];
$query = "SELECT * FROM room WHERE 1";
$room = $koneksi->query($query);

while ($x = $room->fetch_assoc()) {
    if ($x['room1'] == 1) {
        $room1 = 'on';
    } else {
        $room1 = 'off';
    }
    if ($x['room2'] == 1) {
        $room2 = 'on';
    } else {
        $room2 = 'off';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | Monitoring Control</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style-home.css">
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
                <a href="#"><i class="fa-solid fa-house selected"></i></a>
                <?php
                if ($_SESSION['akses'] === "Operator") {
                    echo "<a href='manage.php'><i class='fa-solid fa-users-gear'></i></a>";
                }
                ?>
                <a href="settings.php"><i class="fa-solid fa-address-card"></i></a>
            </div>
        </section>
        <!--Start PHP menu Logic -->
        <section class="content">
            <!--  ROOM 1  -->
            <div class="box-content">
                <div class="content-top">
                    <i class="fa-solid fa-building"></i>
                    <h1>Room 1</h1>
                </div>
                <div class="content-value">
                    <div class="content-center">
                        <div class="volt center-layout">
                            <i class="fa-solid fa-bolt-lightning icon"></i>
                            <div class="hr"></div>
                            <div class="center-value">
                                <p>V<br>I</p>
                                <p>:<br>:</p>
                                <p class="data data-r1" id="room-1-monitor-listrik">120V<br>10A</p>
                            </div>
                        </div>
                        <div class="monitor center-layout">
                            <i class="fa-solid fa-chart-simple icon"></i>
                            <div class="hr"></div>
                            <div class="center-value">
                                <p><i class="temp fa-solid fa-temperature-three-quarters"></i><br><i
                                        class="fa-solid fa-droplet"></i><br><i class="fa-solid fa-cloud"></i></p>
                                <p>:<br>:<br>:</p>
                                <p class="data data-room-r1" id="room-1-monitor-kondisi">120V<br>10A<br>1200W</p>
                            </div>
                        </div>
                    </div>
                    <div class="content-bottom">
                        <div class="box-bottom" id="room-1-lampu" onclick="handleControl('r1-lampu')">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <div class="box-bottom" id="room-1-listrik" onclick="handleControl('r1-listrik')">
                            <i class="fa-solid fa-plug"></i>
                        </div>
                        <div class="box-bottom" id="room-1-ac" onclick="handleControl('r1-ac')">
                            <i class="fa-solid fa-fan"></i>
                        </div>
                    </div>
                    <div class="access" id="access1">
                        <p>Maaf, perangkat tidak dapat digunakan</p>
                    </div>
                </div>
            </div>
            <!-- ROOM 2 -->
            <div class="box-content">
                <div class="content-top">
                    <i class="fa-solid fa-building"></i>
                    <h1>Room 2</h1>
                </div>
                <div class="content-value">
                    <div class="content-center">
                        <div class="volt center-layout">
                            <i class="fa-solid fa-bolt-lightning icon"></i>
                            <div class="hr"></div>
                            <div class="center-value">
                                <p>V<br>I</p>
                                <p>:<br>:</p>
                                <p class="data data-r2" id="room-2-monitor-listrik">120V<br>10A</p>
                            </div>
                        </div>
                        <div class="monitor center-layout">
                            <i class="fa-solid fa-chart-simple icon"></i>
                            <div class="hr"></div>
                            <div class="center-value">
                                <p><i class="temp fa-solid fa-temperature-three-quarters"></i><br><i
                                        class="fa-solid fa-droplet"></i><br><i class="fa-solid fa-cloud"></i></p>
                                <p>:<br>:<br>:</p>
                                <p class="data data-room-r2" id="room-2-monitor-kondisi">120V<br>10A<br>1200W</p>
                            </div>
                        </div>
                    </div>
                    <div class="content-bottom">
                        <div class="box-bottom" id="room-2-lampu" onclick="handleControl('r2-lampu')">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <div class="box-bottom" id="room-2-listrik" onclick="handleControl('r2-listrik')">
                            <i class="fa-solid fa-plug"></i>
                        </div>
                        <div class="box-bottom" id="room-2-ac" onclick="handleControl('r2-ac')">
                            <i class="fa-solid fa-fan"></i>
                        </div>
                    </div>
                    <div class="access" id="access2">
                        <p>Maaf, perangkat tidak dapat digunakan</p>
                    </div>
                </div>
            </div>
            <!-- PUBLIC CONTROL -->
            <div class="box-content">
                <div class="content-top">
                    <i class="public fa-solid fa-users"></i>
                    <h1>Public</h1>
                </div>
                <div class="content-value">
                    <div class="content-center">
                        <div class="volt center-layout">
                            <i class="fa-solid fa-bolt-lightning icon"></i>
                            <div class="hr"></div>
                            <div class="center-value">
                                <p>P</p>
                                <p>:</p>
                                <p class="data data-pb" id="pb-monitor-listrik">250W</p>
                            </div>
                        </div>
                        <div class="monitor center-layout monitor-public">
                            <i class="fa-solid fa-arrow-up-from-ground-water"></i>
                            <h1 class="water" id="pb-monitor-kondisi">52%</h1>
                        </div>
                    </div>
                    <div class="content-bottom">
                        <div class="box-bottom <?php echo $room1; ?>" id="pub-r1" onclick="access('pub-r1')">
                            <div class="room">
                                <i class="fa-solid fa-building"></i>
                                <h1>Ruang 1</h1>
                            </div>
                        </div>
                        <div class="box-bottom <?php echo $room2; ?>" id="pub-r2" onclick="access('pub-r2')">
                            <div class="room">
                                <i class="fa-solid fa-building"></i>
                                <h1>Ruang 2</h1>
                            </div>
                        </div>
                        <div class="box-bottom" id="pub-pompa" onclick="handleControl('pub-pompa')">
                            <i class="fa-solid fa-faucet"></i>
                        </div>
                    </div>
                    <div class="access">
                        <p>Maaf, perangkat tidak dapat digunakan</p>
                    </div>
                </div>
            </div>
            <!-- Homepage -->
        </section>
        <section class="side-content">
            <div class="side-container">
                <canvas id="room1" height="200"></canvas>
                <h1>Grafik kondisi Room 1</h1>
                <p>Grafik ini memuat riwayat kondisi dalam ruangan.</p>
                <button class="button-green riwayat" onclick="download('room1')">Download riwayat data</button>
            </div>
            <div class="side-container">
                <canvas id="room2" height="200"></canvas>
                <h1>Grafik kondisi Room 2</h1>
                <p>Grafik ini memuat riwayat kondisi dalam ruangan.</p>
                <button class="button-green riwayat" onclick="download('room2')">Download riwayat data</button>
            </div>
            <div class="side-container">
                <canvas id="listrik" height="200"></canvas>
                <h1>Grafik kelistrikan</h1>
                <p>Grafik ini memuat riwayat konsumsi daya listrik dalam ruangan.</p>
                <button class="button-green riwayat" onclick="download('pub')">Download riwayat data</button>
            </div>
        </section>
    </main>
    <script src="https://kit.fontawesome.com/cc079fac56.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/mqtt.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        if ("<?php echo $akses; ?>" == "Operator") {
            function handleControl(id) {
                var dataSend;
                switch (id) {
                    case "r1-listrik":
                        if (data.plnState1 == 1) {
                            dataSend = "off";
                            data.plnState1 = 0;
                        } else {
                            dataSend = "on";
                            data.plnState1 = 1;
                        }
                        client.publish("myEsp/lucio/pln1", dataSend);
                        break;
                    case "r1-lampu":
                        if (data.lampState1 == 1) {
                            dataSend = "off";
                            data.lampState1 = 0;
                        } else {
                            dataSend = "on";
                            data.lampState1 = 1;
                        }
                        client.publish("myEsp/lucio/lamp1", dataSend);
                        break;
                    case "r1-ac":
                        if (data.acState1 == 1) {
                            dataSend = "off";
                            data.acState1 = 0;
                        } else {
                            dataSend = "on";
                            data.acState1 = 1;
                        }
                        client.publish("myEsp/lucio/ac1", dataSend);
                        break;
                    case "r2-listrik":
                        if (data.plnState2 == 1) {
                            data.plnState2 = 0;
                            dataSend = "off";
                        } else {
                            dataSend = "on";
                            data.plnState2 = 1;
                        }
                        client.publish("myEsp/lucio/pln2", dataSend);
                        break;
                    case "r2-lampu":
                        if (data.lampState2 == 1) {
                            dataSend = "off";
                            data.lampState2 = 0;
                        } else {
                            dataSend = "on";
                            data.lampState2 = 1;
                        }
                        client.publish("myEsp/lucio/lamp2", dataSend);
                        break;
                    case "r2-ac":
                        if (data.acState2 == 1) {
                            dataSend = "off";
                            data.acState2 = 0;
                        } else {
                            dataSend = "on";
                        }
                        data.acState2 = 1;
                        client.publish("myEsp/lucio/ac2", dataSend);
                        break;
                    case "pub-pompa":
                        if (data.pumpState == 1) {
                            dataSend = "off";
                            data.pumpState = 0;
                        } else {
                            dataSend = "on";
                            data.pumpState = 1;
                        }
                        client.publish("myEsp/lucio/pump", dataSend);
                        break;
                }
                saklar("room-1-listrik", data.plnState1);
                saklar("room-1-lampu", data.lampState1);
                saklar("room-1-ac", data.acState1);
                saklar("room-2-listrik", data.plnState2);
                saklar("room-2-lampu", data.lampState2);
                saklar("room-2-ac", data.acState2);
                saklar("pub-pompa", data.pumpState);

            }
        }
    </script>
</body>

</html>