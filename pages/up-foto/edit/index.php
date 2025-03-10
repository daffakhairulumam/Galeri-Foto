<?php

include_once('./config/koneksi.php');

$id = $_GET['id'];
$query = "SELECT * FROM up_foto WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Foto</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="indexx.php?page=up-foto">Edit Foto</a></li>
                <li class="breadcrumb-item active">Edit Foto</li>
            </ol>
        </nav>
    </div><!--end page title-->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Foto</h5>

                        <form action="logic/foto/update.php" method="post" class="" enctype="multipart/form-data">

                            <div class="form-group mb-3">
                                <input type="hidden" name="id" placeholder="Input ID" class="form-control" value="<?= $data['id'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Username</label>
                                <input type="text" name="username" placeholder="Input Username" class="form-control" value="<?= $data['username'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input type="text" name="nama" placeholder="Input Nama" class="form-control" value="<?= $data['nama'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" placeholder="Input Deskripsi" class="form-control"><?= $data['deskripsi'] ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Gambar</label>
                                <input type="file" name="image" class="form-control" value="<?= ['images'] ?>">
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