<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'galeri_foto';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
return $conn;
