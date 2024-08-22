<?php

include_once('../../config/koneksi.php');

$id = $_POST['id'];
$username = $_POST['username'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];

//upload gambar 

$rand = rand();
$ekstensi = array('jpg', 'jpeg', 'png');
$filename = $_FILES['image']['name'];
$ukuran = $_FILES['image']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array($ext, $ekstensi)) {
    header("Location: ../../indexx.php?page=up-foto/create");
} else {
    if ($ukuran < 1044070) {
        $xx = $rand . '_' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], '../../public/img/product/' . $xx);

        $sql = "INSERT INTO up_foto (username, nama, deskripsi, images) VALUES ('$username', '$nama', '$deskripsi', '$xx')";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../../indexx.php?page=up-foto");
        } else {
            echo "Error" . "<br>" . mysqli_error($conn);
        }
    } else {
        header("Location: ../../indexx.php?page=up-foto/create");
    }
}
