<?php
include('./config/koneksi.php');

$foto = getFoto();
$countFoto = mysqli_num_rows($foto);

$users = getUsers();
$countUsers = mysqli_num_rows($users);

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

function getUsers($id = null)
{
    $conn = mysqli_connect("localhost", "root", "", "galeri_foto");
    if ($id) {
        $query = "SELECT * FROM registrasi WHERE id = '$id'";
    } else {
        $query = "SELECT * FROM registrasi";
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
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- kategori Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card kategori-card">

                            <div class="card-body">
                                <h5 class="card-title">Foto</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bar-chart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $countFoto ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- kategori Card -->
                    <div class="col-xxl-3 col-md-3">
                        <div class="card info-card kategori-card">

                            <div class="card-body">
                                <h5 class="card-title">Users</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $countUsers ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End kategori Card -->

    </section>

</main><!-- End #main -->