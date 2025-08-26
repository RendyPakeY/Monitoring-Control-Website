<?php
include "../../element/config.php";

// Ambil JSON dari body POST
$json = file_get_contents('php://input');
$data = json_decode($json);

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');

if($data->type == "electric"){
    $tegangan = $data->tegangan;
    $arus = $data->arus;
    $daya = $data->daya;
    $query  = "INSERT INTO `riwayat`(`type`, `tanggal`, `value`) VALUES ('tegangan','$tanggal','$tegangan');";
    $query .= "INSERT INTO `riwayat`(`type`, `tanggal`, `value`) VALUES ('arus','$tanggal','$arus');";
    $query .= "INSERT INTO `riwayat`(`type`, `tanggal`, `value`) VALUES ('daya','$tanggal','$daya');";
    if (mysqli_multi_query($koneksi, $query)) {
        echo "electric Success";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} elseif($data->type == "room1"){
    $suhu = $data->suhu;
    $hum = $data->hum;
    $co = $data->co;
    $query  = "INSERT INTO `riwayat`(`type`, `tanggal`, `value`) VALUES ('suhu1','$tanggal','$suhu');";
    $query .= "INSERT INTO `riwayat`(`type`, `tanggal`, `value`) VALUES ('hum1','$tanggal','$hum');";
    $query .= "INSERT INTO `riwayat`(`type`, `tanggal`, `value`) VALUES ('co1','$tanggal','$co');";
    if (mysqli_multi_query($koneksi, $query)) {
        echo "Room 1 Success";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} elseif($data->type == "room2"){
    $suhu = $data->suhu;
    $hum = $data->hum;
    $co = $data->co;
    $query  = "INSERT INTO `riwayat`(`type`, `tanggal`, `value`) VALUES ('suhu2','$tanggal','$suhu');";
    $query .= "INSERT INTO `riwayat`(`type`, `tanggal`, `value`) VALUES ('hum2','$tanggal','$hum');";
    $query .= "INSERT INTO `riwayat`(`type`, `tanggal`, `value`) VALUES ('co2','$tanggal','$co');";
    if (mysqli_multi_query($koneksi, $query)) {
        echo "Room 2 Success";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Unknown type";
}
?>