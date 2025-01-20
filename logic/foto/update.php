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
    header("Location: ../../index.php?page=up-foto/edit&id=$id");
} else {
    if ($ukuran < 1044070) {
        $xx = $rand . '_' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], '../../public/img/product/' . $xx);

        $sql = "UPDATE up_foto SET username = '$username', nama = '$nama', deskripsi = '$deskripsi', images = '$xx' WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../../index.php?page=up-foto");
        } else {
            echo "Error" . "<br>" . mysqli_error($conn);
        }
    } else {
        header("Location: ../../index.php?page=up-foto/edit&id=$id");
    }
}
