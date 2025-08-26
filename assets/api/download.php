<?php
require '../../vendor/autoload.php'; // pastikan sesuai path ke autoload.php
include "../../element/config.php";

$type = $_GET['type'];
date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d H:i:s');

if($type == "room1"){
    $query = "SELECT * FROM `riwayat` WHERE type in ('hum1','suhu1','co1')";
    $hasil = $koneksi->query($query);
    $name = "room1";
}
if($type == "room2"){
    $query = "SELECT * FROM `riwayat` WHERE type in ('hum2','suhu2','co2')";
    $hasil = $koneksi->query($query);
    $name = "room2";
}
if($type == "pub"){
    $query = "SELECT * FROM `riwayat` WHERE type in ('tegangan ','arus','daya')";
    $hasil = $koneksi->query($query);
    $name = "kelistrikan";
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Buat file spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$sheet->setCellValue('A1', 'Tanggal');
$sheet->setCellValue('B1', 'Tipe');
$sheet->setCellValue('C1', 'Value');

// Data dimulai dari baris ke-2
$row = 2;
while($data = $hasil->fetch_assoc()) {
    $sheet->setCellValue("A$row", $data['tanggal']);
    $sheet->setCellValue("B$row", $data['type']);
    $sheet->setCellValue("C$row", $data['value']);
    $row++;
}

// Styling header
$sheet->getStyle('A1:C1')->getFont()->setBold(true);
$sheet->getStyle('A1:C1')->getFill()->setFillType(Fill::FILL_SOLID)
                                   ->getStartColor()->setRGB('99ff99');

// Auto-width kolom
foreach (range('A', 'C') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Output ke browser
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Laporan-Riwayat-'.$name.'-'.$date.'.xls"');
header('Cache-Control: max-age=0');

$writer = new Xls($spreadsheet);
$writer->save('php://output');
exit;
