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
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?page=up-foto">Foto</a></li>
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

                        <form action="logic/foto/save.php" method="post" class="" enctype="multipart/form-data" id="photoUploadForm">

                            <div class="form-group mb-3">
                                <input type="hidden" name="id" placeholder="Input ID" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <input type="hidden" name="id_user" placeholder="Input ID User" class="form-control" value="<?= $_SESSION['id_user'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label>Gambar <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="imageInput" class="form-control" required accept="image/*">
                                <small id="photoHelp" class="text-danger">Pilih foto terlebih dahulu sebelum mengisi data lainnya</small>
                                <div id="imagePreviewContainer" style="display: none; margin-top: 10px;">
                                    <img id="imagePreview" src="#" alt="Preview gambar" style="max-width: 300px; max-height: 200px;" class="img-thumbnail">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Username</label>
                                <input type="text" name="username" id="usernameInput" placeholder="Input Username" class="form-control" required disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" id="namaInput" placeholder="Input Nama" class="form-control" required disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsiInput" placeholder="Input Deskripsi" class="form-control" required disabled></textarea>
                            </div>

                            <hr>

                            <div class="text-end">
                                <button type="reset" class="btn btn-warning" onclick="resetForm()">Reset</button>
                                <button type="submit" name="Submit" id="submitButton" class="btn btn-success" disabled>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('imageInput');
            const photoHelp = document.getElementById('photoHelp');
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const usernameInput = document.getElementById('usernameInput');
            const namaInput = document.getElementById('namaInput');
            const deskripsiInput = document.getElementById('deskripsiInput');
            const submitButton = document.getElementById('submitButton');

            // Fungsi untuk mengaktifkan atau menonaktifkan input
            function toggleInputs(enable) {
                usernameInput.disabled = !enable;
                namaInput.disabled = !enable;
                deskripsiInput.disabled = !enable;
                submitButton.disabled = !enable;
            }

            // Cek apakah gambar dipilih ketika input berubah
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    // Sembunyikan teks petunjuk
                    photoHelp.style.display = 'none';

                    // Aktifkan input lainnya
                    toggleInputs(true);

                    // Tampilkan preview gambar
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreviewContainer.style.display = 'block';
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    // Tampilkan teks petunjuk kembali
                    photoHelp.style.display = 'block';

                    // Nonaktifkan input lainnya
                    toggleInputs(false);

                    // Sembunyikan preview gambar
                    imagePreviewContainer.style.display = 'none';
                }
            });

            // Validasi pengiriman form
            document.getElementById('photoUploadForm').addEventListener('submit', function(e) {
                if (!imageInput.files || !imageInput.files[0]) {
                    e.preventDefault();
                    alert('Harap pilih foto terlebih dahulu sebelum mengisi data lainnya.');
                }
            });

            // Fungsi reset
            window.resetForm = function() {
                photoHelp.style.display = 'block';
                imagePreviewContainer.style.display = 'none';
                imageInput.value = '';
                toggleInputs(false);

                // Reset nilai input
                usernameInput.value = '';
                namaInput.value = '';
                deskripsiInput.value = '';
            };
        });
    </script>
</main>