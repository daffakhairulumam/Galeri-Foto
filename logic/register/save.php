<?php
include('../../config/koneksi.php');

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$pass = md5($password);

$sql_check = "SELECT * FROM registrasi WHERE email = '$email'";
$result_check = mysqli_query($conn, $sql_check);
$cek = mysqli_num_rows($result_check);

if ($cek > 0) {
?>
    <script type="text/javascript">
        alert('Email Sudah Ada Yang Pakai');
        window.location = '../../pages/auth/register.php';
    </script>
    <?php
} else {
    $sql_insert = "INSERT INTO registrasi (id_user, name, email, password) VALUES ('$id', '$nama', '$email', '$pass')";

    if (mysqli_query($conn, $sql_insert)) {
    ?>
        <script type="text/javascript">
            alert('Data berhasil Disimpan, Silahkan Masuk!');
            window.location = '../../pages/auth/login.php';
        </script>
<?php
    } else {
        echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
    }
}
?>