<?php
// Place this code in logic/like/save.php

include('../../config/koneksi.php');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

$user_id = $_SESSION['id_user'];
$photo_id = $_GET['id'] ?? 0;

if (!$photo_id) {
    header("Location: ../../index.php");
    exit;
}

// Check if user has already liked this photo
$check_like = mysqli_query($conn, "SELECT * FROM user_likes WHERE user_id = '$user_id' AND photo_id = '$photo_id'");

if (mysqli_num_rows($check_like) > 0) {
    // User already liked this photo, so unlike it
    mysqli_query($conn, "DELETE FROM user_likes WHERE user_id = '$user_id' AND photo_id = '$photo_id'");

    // Update the like count in the photos table
    mysqli_query($conn, "UPDATE up_foto SET jumlah_likes = jumlah_likes - 1 WHERE id = '$photo_id'");

    // Redirect back
    header("Location: ../../index.php");
    exit;
} else {
    // User hasn't liked this photo yet, so add the like
    mysqli_query($conn, "INSERT INTO user_likes (user_id, photo_id) VALUES ('$user_id', '$photo_id')");

    // Update the like count in the photos table
    mysqli_query($conn, "UPDATE up_foto SET jumlah_likes = jumlah_likes + 1 WHERE id = '$photo_id'");

    // Redirect back
    header("Location: ../../index.php");
    exit;
}
