<?php

include_once '../../config/koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM registrasi WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: ../../index.php?page=users");
} else {
    echo "Error" . $sql . "<br>" . mysqli_error($conn);
}
