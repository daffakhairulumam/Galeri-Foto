<?php
include('../../config/koneksi.php');

// Memulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getFoto($id = null, $search = null)
{
    $conn = mysqli_connect("localhost", "root", "", "galeri_foto");

    if ($id) {
        $query = "SELECT * FROM up_foto WHERE id = '$id'";
    } else {
        // Tampilkan semua foto tanpa perlu login
        $query = "SELECT * FROM up_foto";

        // Tambahkan kondisi pencarian jika parameter search ada
        if ($search) {
            $query = "SELECT * FROM up_foto WHERE nama LIKE '%$search%' OR deskripsi LIKE '%$search%'";
        }
    }

    $result = mysqli_query($conn, $query);
    return $result;
}

// Ambil parameter pencarian jika ada
$search_term = isset($_GET['search']) ? $_GET['search'] : null;
$countFoto = getFoto(null, $search_term);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Halaman Utama - Galeri Foto</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../assets/img/galeri-foto.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .photo-container {
            position: relative;
            margin-bottom: 20px;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .welcome-banner {
            text-align: center;
            margin-bottom: 30px;
        }

        .like-button {
            cursor: pointer;
        }

        .like-button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .like-tooltip {
            display: none;
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            z-index: 100;
        }

        .like-button.disabled:hover .like-tooltip {
            display: block;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Pinterest style navbar */
        .navbar {
            height: 72px;
            padding: 0 16px;
        }

        .navbar .container-fluid {
            height: 100%;
        }

        .navbar-brand-container {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .pinterest-navbar {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .search-btn {
            background: none;
            border: none;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 24px;
            cursor: pointer;
            margin-left: 8px;
            transition: background-color 0.2s;
        }

        .search-btn:hover {
            background-color: #e9e9e9;
        }

        .search-btn.active {
            background-color: black;
            color: white;
        }

        /* Mengganti warna link Galeri Foto menjadi hitam */
        .navbar-brand span {
            color: #000;
        }

        .navbar a {
            text-decoration: none;
            color: #000;
        }

        .search-form {
            flex-grow: 1;
            max-width: 840px;
            margin: 0 8px 0 16px;
            position: relative;
        }

        .search-form .input-group {
            width: 100%;
            position: relative;
        }

        /* Sembunyikan input pencarian secara default */
        .search-form input {
            height: 45px;
            border-radius: 25px;
            /* Memastikan kedua ujung lonjong */
            background-color: #e9e9e9;
            border: none;
            padding: 0 52px 0 16px;
            font-size: 16px;
            display: none;
            /* Sembunyikan secara default */
            width: 100%;
        }

        /* Tampilkan input pencarian saat form aktif */
        .search-form.active input {
            display: block;
        }

        .search-form input:focus {
            background-color: white;
            box-shadow: 0 0 0 4px rgba(0, 132, 255, 0.2);
            border: none;
        }

        .search-form .btn-close {
            position: absolute;
            right: 48px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background: none;
            border: none;
            font-size: 16px;
            color: #666;
            cursor: pointer;
            display: none;
        }

        /* Tombol pencarian di sebelah kanan */
        .search-form .btn-search {
            position: absolute;
            right: 4px;
            top: 4px;
            bottom: 4px;
            background: none;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: #666;
            display: flex;
            align-items: center;
            justify-content: center;
            display: none;
        }

        .search-form.active .btn-search {
            display: flex;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .auth-buttons .btn {
            margin: 0 8px;
            border-radius: 24px;
            font-weight: 600;
            padding: 8px 16px;
        }

        .search-icon {
            font-size: 20px;
            color: #666;
        }

        .alert-info {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100px;
            /* Sesuaikan tinggi jika perlu */
            text-align: center;
        }

        .center-alert {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 50vh;
            /* Menengahkan di tengah layar */
        }


        /* Adjust display properties based on screen size */
        @media (max-width: 992px) {
            .search-form {
                max-width: 50%;
            }
        }

        @media (max-width: 768px) {
            .search-form.active {
                position: absolute;
                left: 80px;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                z-index: 1000;
                background: white;
            }
        }
    </style>

</head>

<body>
    <main>
        <!-- Navigation Bar Pinterest Style -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-0 fixed-top">
            <div class="container-fluid px-2">
                <div class="pinterest-navbar">
                    <!-- Logo -->
                    <a class="navbar-brand" href="#">
                        <img src="../../assets/img/galeri-foto.png" alt="Galeri Foto" width="30px">
                    </a>

                    <!-- Galeri Foto link with black text -->
                    <b><a href="../dashboard/main-page.php"><span>Galeri Foto</span></a></b>

                    <!-- search Button -->
                    <button id="searchBtn" class="search-btn">Search</button>

                    <!-- Search Form -->
                    <form method="GET" action="" class="search-form" id="searchForm">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari makan malam sederhana, model, dll." name="search" id="searchInput" value="<?= isset($_GET['search']) ? ($_GET['search']) : '' ?>">
                            <button type="button" class="btn-close" id="clearSearch" aria-label="Close">&times;</button>
                            <button class="btn btn-search" type="submit" id="searchButton">
                                <i class="bi bi-search search-icon"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Auth Buttons -->
                    <div class="auth-buttons">
                        <a href="../../pages/auth/login.php" class="btn btn-danger">Masuk</a>
                        <a href="../../pages/auth/register.php" class="btn btn-outline-secondary">Daftar</a>
                    </div>
                </div>
            </div>
        </nav>

        <section class="section dashboard">
            <div class="container mt-5 pt-5">
                <div class="row welcome-banner">
                    <!-- Welcome Banner - Only show when not searching -->
                    <?php if (!$search_term) { ?>
                        <div class="row welcome-banner">
                            <div class="col-md-6 mx-auto text-center">
                                <img src="../../assets/img/galeri-foto.png" alt="" width="150px" class="mb-3">
                                <h2>Selamat Datang di Galeri Foto</h2>
                                <p>Lihat koleksi foto menarik dari pengguna kami</p>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Search Results Info - Only show when searching AND no results found -->
                    <?php if ($search_term && mysqli_num_rows($countFoto) == 0) { ?>
                        <div class="alert alert-info text-center" style="background-color: #d9f2f7; color: #0a6680; border: none; width: 100%; padding: 15px; margin-top: 20px; margin-bottom: 20px; border-radius: 6px;">
                            Hasil pencarian tidak ada
                        </div>
                    <?php } ?>

                    <!-- Gallery Container -->
                    <div class="gallery-container">
                        <?php
                        // Display search results or all photos
                        if (mysqli_num_rows($countFoto) > 0) {
                            while ($photo = mysqli_fetch_assoc($countFoto)) {
                        ?>
                                <div class="photo-container">
                                    <div class="card">
                                        <img src="../../public/img/product/<?= $photo['images'] ?>" class="card-img-top" alt="<?= $photo['nama'] ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $photo['nama'] ?></h5>
                                            <p class="card-text"><?= $photo['deskripsi'] ?></p>
                                            <p class="card-text"><small class="text-muted">By: <?= $photo['username'] ?></small></p>

                                            <div class="d-flex align-items-center">
                                                <?php if (isset($_SESSION['id_user'])) { ?>
                                                    <button class="btn btn-sm like-button">
                                                        <i class="bi bi-heart-fill text-danger"></i>
                                                        <span class="like-count"><?= $photo['jumlah_likes'] ?></span> likes
                                                    </button>
                                                <?php } else { ?>
                                                    <span class="like-button disabled" data-bs-toggle="tooltip" title="Login untuk menyukai foto">
                                                        <i class="bi bi-heart-fill text-danger"></i>
                                                        <span class="like-count"><?= $photo['jumlah_likes'] ?></span> likes
                                                        <!-- <span class="like-tooltip">Login untuk menyukai foto</span> -->
                                                    </span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <!-- <div class="col-12 d-flex justify-content-center align-items-center center-alert">
                            <div class="alert alert-info">
                                <?php if ($search_term) { ?>
                                    Tidak ada foto yang ditemukan dengan kata kunci "<?= ($search_term) ?>"
                                <?php } else { ?>
                                    Belum ada foto yang diupload
                                <?php } ?>
                            </div>
                        </div> -->
                        <?php
                        }
                        ?>
                    </div>
                </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../assets/js/main.js"></script>

    <!-- Initialize tooltips and functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Elemen-elemen yang dibutuhkan
            const searchInput = document.getElementById('searchInput');
            const clearSearch = document.getElementById('clearSearch');
            const searchBtn = document.getElementById('searchBtn');
            const searchForm = document.getElementById('searchForm');
            const searchButton = document.getElementById('searchButton');

            // Fungsi untuk menutup form pencarian
            function closeSearchForm() {
                searchForm.classList.remove('active');
                searchBtn.classList.remove('active');
            }

            // Fungsi untuk membuka form pencarian
            function openSearchForm() {
                searchForm.classList.add('active');
                searchBtn.classList.add('active');
                searchInput.focus();
            }

            // Toggle form pencarian saat tombol search diklik
            searchBtn.addEventListener('click', function() {
                if (searchForm.classList.contains('active')) {
                    closeSearchForm();
                } else {
                    openSearchForm();
                }
            });

            // Tampilkan tombol hapus saat ada nilai di input pencarian
            searchInput.addEventListener('input', function() {
                clearSearch.style.display = searchInput.value.length > 0 ? 'block' : 'none';
            });

            // Inisialisasi tampilan tombol hapus
            clearSearch.style.display = searchInput.value.length > 0 ? 'block' : 'none';

            // Hapus nilai input pencarian saat tombol hapus diklik
            clearSearch.addEventListener('click', function() {
                searchInput.value = '';
                clearSearch.style.display = 'none';
                searchInput.focus();
            });

            // Tutup form pencarian saat klik di luar form
            document.addEventListener('click', function(event) {
                const isClickInsideForm = searchForm.contains(event.target);
                const isClickOnsearchBtn = searchBtn.contains(event.target);

                if (!isClickInsideForm && !isClickOnsearchBtn && searchForm.classList.contains('active') && !searchInput.value) {
                    closeSearchForm();
                }
            });

            // Jika ada parameter pencarian, aktifkan form pencarian
            <?php if (isset($_GET['search']) && $_GET['search'] !== '') { ?>
                searchForm.classList.add('active');
                searchBtn.classList.add('active');
            <?php } ?>
        });
    </script>
</body>

</html>