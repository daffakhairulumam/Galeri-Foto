<main id="main" class="main">

    <div class="pagetitle">
        <h1>Foto</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Foto</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Foto</h5>

                        <!-- Table with stripped rows -->
                        <table class="table table-bordered" id="table-foto">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Jumlah Likes</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                include_once './config/koneksi.php';

                                $sql = "SELECT * FROM up_foto";

                                $data = mysqli_query($conn, $sql);

                                foreach ($data as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['username'] ?></td>
                                        <td><?= $value['nama'] ?></td>
                                        <td><?= $value['jumlah_likes'] ?></td>
                                        <td><?= $value['deskripsi'] ?></td>
                                        <td>
                                            <img src="public/img/product/<?= $value['images'] ?>" width="50px">
                                        </td>
                                        <td>
                                            <a href="logic/foto/delete.php?id=<?= $value['id'] ?>" onclick="javascript:return confirm('Hapus Data Foto ?');">
                                                <button type="button" class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>
    $(document).ready(function() {
        $('#table-foto').DataTable();
    })
</script>