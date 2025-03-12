<?php

include_once('./config/koneksi.php');

$id = $_GET['id'];
$query = "SELECT * FROM registrasi WHERE id_user = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Foto</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?page=user">Edit Foto</a></li>
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

                        <form action="logic/user/update.php" method="post">

                            <div class="form-group mb-3">
                                <input type="hidden" name="id" placeholder="Input ID" class="form-control" value="<?= $data['id_user'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" placeholder="Input Nama" class="form-control" value="<?= $data['name'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Input Email" class="form-control" value="<?= $data['email'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Input Password" class="form-control" value="<?= $data['password'] ?>">
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