<?php

include('../../config/koneksi.php');

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$query = "UPDATE registrasi SET name = '$nama', email = '$email', password = '$password' WHERE id_user = '$id'";

if (mysqli_query($conn, $query)) {
    header("Location: ../../index.php?page=user");
} else {
    echo "Error" . "<br>" . mysqli_error($conn);
}
