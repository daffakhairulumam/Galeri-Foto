<main id="main" class="main">
    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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

                        <!-- <div class="text-end mb-3">
                            <a href="index.php?page=up-foto/create">
                                <button type="button" class="btn btn-primary">
                                    Tambah
                                </button>
                            </a>
                        </div> -->

                        <!-- Table with stripped rows -->
                        <table class="table table-bordered" id="table-users">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <!-- <th>Password</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once './config/koneksi.php';

                                // Get the current user's ID from session
                                $current_user_id = $_SESSION['id_user']; // Assuming you store user ID in session

                                // Modify query to only show photos uploaded by the current user
                                $sql = "SELECT * FROM registrasi WHERE id_user = $current_user_id";

                                $data = mysqli_query($conn, $sql);

                                foreach ($data as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $value['email'] ?></td>
                                        <!-- <td><?= $value['password'] ?></td> -->
                                        <td>
                                            <a href="index.php?page=user/edit&id=<?= $value['id_user'] ?>">
                                                <button type="button" class="btn btn-primary">
                                                    Edit
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
        $('#table-users').DataTable();
    })
</script>