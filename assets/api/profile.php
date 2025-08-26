<?php
include "../../element/config.php";

session_start();

$user_id = $_SESSION['id'];
$img_name = $user_id . "-" . $_SESSION['nama'] .".". pathinfo($_FILES["update"]['name'], PATHINFO_EXTENSION);
$img_temp = $_FILES["update"]['tmp_name'];
$img_size= $_FILES["update"]['size'];
$update_image_folder = '../img/profiles/' . $img_name;

if ($img_size > 20000000) {
    header("Location: ../../settings.php?code=4");
} else {
    $image_update_query = mysqli_query($koneksi, "UPDATE `akun` SET foto = '$img_name' WHERE id = '$user_id'") or die('query failed');
    if ($image_update_query) {
        move_uploaded_file($img_temp, $update_image_folder);
        header("Location: ../../settings.php?code=5");
        
    };
    header("Location: ../../settings.php?code=5");
}
?>