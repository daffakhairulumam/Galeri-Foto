<?php
include_once('./config/koneksi.php');

$user = getUser($_SESSION['id_user']);

function getUser()
{

    $conn = mysqli_connect("localhost", "root", "", "galeri_foto");

    $idUser = $_SESSION['id_user'];

    $query = "SELECT * FROM registrasi WHERE id_user = '$idUser'";
    $result = mysqli_query($conn, $query);

    return $result;
}

?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Foto</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="indexx.php?page=up-foto">Foto</a></li>
                <li class="breadcrumb-item active">Tambah Foto</li>
            </ol>
        </nav>
    </div><!--end page title-->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Foto</h5>

                        <form action="logic/foto/save.php" method="post" class="" enctype="multipart/form-data">

                            <div class="form-group mb-3">
                                <input type="hidden" name="id" placeholder="Input ID" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <input type="hidden" name="id_user" placeholder="Input ID User" class="form-control" value="<?= $_SESSION['id_user'] ?>">
                            </div>

                            <div class=" form-group mb-3">
                                <label>Username</label>
                                <input type="text" name="username" placeholder="Input Username" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" placeholder="Input Nama" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" placeholder="Input Deskripsi" class="form-control"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Gambar</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <hr>

                            <div class="text-end">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" name="Submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>