<?php
include('./config/koneksi.php');

$countFoto = getFoto();

function getFoto($id = null)
{
    $conn = mysqli_connect("localhost", "root", "", "galeri_foto");
    if ($id) {
        $query = "SELECT * FROM up_foto WHERE id = '$id'";
    } else {
        $query = "SELECT * FROM up_foto";
    }

    $result = mysqli_query($conn, $query);
    return $result;
}

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="container mt-3">
            <div class="row">
                <?php
                foreach ($countFoto as $value) { ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <a href="#modal-<?= $value['id'] ?>" data-bs-toggle="modal">
                                <img src="public/img/product/<?= $value['images'] ?>" class="card-img-top" alt="Foto Produk">
                            </a>
                            <div class="card-body">
                                <p></p><a href="logicc/like/save.php?id=<?= $value['id'] ?>&jumlah_like=1" class="text-secondary">
                                    <i class="bi bi-heart"></i> Like
                                </a>
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
                                    <a href="logicc/like/save.php?id=<?= $value['id'] ?>&jumlah_like=1" class="text-secondary">
                                        <i class="bi bi-heart"></i> Like
                                    </a>
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