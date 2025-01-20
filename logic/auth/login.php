<?php

session_start();
include('../../config/koneksi.php');

if (isset($_POST['submit'])) {
    $conn = $conn;

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM registrasi WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) > 0) {

        if ($data['password'] == $password) {
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data;

            header('location:../../index.php');
        } else {
            echo "<script>alert('Password tidak sesuai')</script>";
            header("location: ../../pages/auth/login.php?error=Password tidak sesuai");
        }
    } else {
        echo "<script>alert('Akun tidak ditemukan')</script>";
        header("location: ../../pages/auth/login.php?error=Akun tidak ditemukan");
    }
}
