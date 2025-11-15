<?php
session_start();
include __DIR__ . '/koneksi.php';

$role = $_POST['role'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($role === 'mpk') {

    $q = mysqli_query($koneksi, "SELECT * FROM mpk WHERE username='$username' LIMIT 1");
    $data = mysqli_fetch_assoc($q);

    if ($data && $data['password'] === $password) {

        $_SESSION['mpk'] = $data['id_mpk'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['id_kelas'] = $data['id_kelas'];

        header("Location: mpk/data.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Username atau password salah!";
        header("Location: mpk/login.php");
        exit;
    }

}

else if ($role === 'admin') {

    $q = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' LIMIT 1");
    $data = mysqli_fetch_assoc($q);

    if ($data && $data['password'] === $password) {

        $_SESSION['admin'] = $data['id_admin'];
        $_SESSION['username'] = $data['username'];

        header("Location: admin/dashboard.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Username atau password salah!";
        header("Location: admin/index.php");
        exit;
    }

}

else {
    echo "Role tidak valid!";
    exit;
}
