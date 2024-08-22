<main id="main" class="main">

    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>

                        <!-- Table with stripped rows -->
                        <table id="table-user">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Passwoard</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                include_once './config/koneksi.php';

                                $sql = 'SELECT * FROM registrasi';

                                $data = mysqli_query($conn, $sql);

                                foreach ($data as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $value['email'] ?></td>
                                        <td><?= $value['password'] ?></td>
                                        <td>
                                            <a href="logic/users/delete.php?id=<?= $value['id'] ?>" onclick="javascript:return confirm('Hapus Data Barang ?');">
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
        $('#table-user').DataTable();
    })
</script>