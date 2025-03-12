<?php
include('./config/koneksi.php');

// Start session if not already started
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

$countFoto = getFoto();

// function getFoto($id = null)
// {
//     $conn = mysqli_connect("localhost", "root", "", "galeri_foto");

//     // Get current user's info
//     $current_user_id = $_SESSION['id_user'];
//     $current_user_query = "SELECT * FROM registrasi WHERE id_user = '$current_user_id'";
//     $current_user_result = mysqli_query($conn, $current_user_query);
//     $current_user = mysqli_fetch_assoc($current_user_result);

//     if ($id) {
//         $query = "SELECT * FROM up_foto WHERE id = '$id'";
//     } else {
//         // Semua user hanya bisa melihat postingan mereka sendiri
//         $query = "SELECT * FROM up_foto WHERE id_user = '$current_user_id'";
//     }

//     $result = mysqli_query($conn, $query);
//     return $result;
// }


function getFoto($id = null)
{
    $conn = mysqli_connect("localhost", "root", "", "galeri_foto");

    $query = "SELECT * FROM up_foto";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Function to check if user has liked a photo
function hasUserLikedPhoto($user_id, $photo_id)
{
    $conn = mysqli_connect("localhost", "root", "", "galeri_foto");
    $query = "SELECT * FROM user_likes WHERE user_id = '$user_id' AND photo_id = '$photo_id'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="container mt-3">
            <div class="row">
                <?php
                foreach ($countFoto as $value) {
                    // Check if user has already liked this photo
                    $hasLiked = hasUserLikedPhoto($_SESSION['id_user'], $value['id']);
                ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <a href="#modal-<?= $value['id'] ?>" data-bs-toggle="modal">
                                <img src="public/img/product/<?= $value['images'] ?>" class="card-img-top" alt="Foto Produk">
                            </a>
                            <div class="card-body">
                                <?php if ($hasLiked): ?>
                                    <a href="logic/like/save.php?id=<?= $value['id'] ?>" class="text-danger">
                                        <i class="bi bi-heart-fill"></i> Unlike
                                    </a>
                                <?php else: ?>
                                    <a href="logic/like/save.php?id=<?= $value['id'] ?>" class="text-secondary">
                                        <i class="bi bi-heart"></i> Like
                                    </a>
                                <?php endif; ?>
                                <p class="card-text">Jumlah Suka: <span><?= $value['jumlah_likes'] ?></span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-<?= $value['id'] ?>" tabindex="-1" aria-labelledby="modalLabel-" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel-<?= $value['id'] ?>"><?= $value['username'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="public/img/product/<?= $value['images'] ?>" class="img-fluid mb-3" alt="Foto Produk">
                                    <p><strong>Nama:</strong> <?= $value['nama'] ?></p>
                                    <p><?= $value['deskripsi'] ?></p>
                                    <?php if ($hasLiked): ?>
                                        <a href="logic/like/save.php?id=<?= $value['id'] ?>" class="text-danger">
                                            <i class="bi bi-heart-fill"></i> Unlike
                                        </a>
                                    <?php else: ?>
                                        <a href="logic/like/save.php?id=<?= $value['id'] ?>" class="text-secondary">
                                            <i class="bi bi-heart"></i> Like
                                        </a>
                                    <?php endif; ?>
                                    <p>Jumlah Suka: <span><?= $value['jumlah_likes'] ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                <?php } ?>
            </div>
        </div>
    </section>

</main><!-- End #main -->