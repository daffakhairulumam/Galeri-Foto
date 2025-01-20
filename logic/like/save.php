<?php
include('../../config/koneksi.php');

// Ambil data dari URL
$id_foto = isset($_GET['id']) ? $_GET['id'] : null;

// Validasi input
$id_foto = mysqli_real_escape_string($conn, $id_foto);

if ($id_foto) {
    // Query untuk mendapatkan jumlah like saat ini
    $query = "SELECT jumlah_likes FROM up_foto WHERE id = '$id_foto'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $current_likes = $row['jumlah_likes'];

        // Update jumlah like
        $new_likes = $current_likes + 1;
        $update_query = "UPDATE up_foto SET jumlah_likes = $new_likes WHERE id = '$id_foto'";

        if (mysqli_query($conn, $update_query)) {
            header("Location: ../../index.php?page=dashboard");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Foto tidak ditemukan.";
    }
} else {
    echo "ID foto tidak ditemukan.";
}

mysqli_close($conn);
