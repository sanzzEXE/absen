<?php
$host = "localhost";
$user = "root";       // default XAMPP
$pass = "";            // kosongkan kalau belum diubah
$db   = "ssri_school"; // nama database kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
