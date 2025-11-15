<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $nama_guru = $_POST['nama_guru'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password

    mysqli_query($koneksi, "INSERT INTO guru (nama_guru, tgl_lahir, alamat, telp, username, password)
                            VALUES ('$nama_guru','$tgl_lahir','$alamat','$telp','$username', '$password')");
    header("Location: index.php?page=guru&pesan=tambah");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4 text-center">👨‍🏫 Tambah Data Guru</h2>

    <form method="post" class="border rounded p-4 shadow-sm bg-light">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nama Guru</label>
                <input type="text" name="nama_guru" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Telepon</label>
                <input type="text" name="telp" maxlength="15" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" name="simpan" class="btn btn-success me-2">💾 Simpan</button>
            <a href="index.php?page=guru" class="btn btn-secondary">↩️ Kembali</a>
        </div>
    </form>
</div>
