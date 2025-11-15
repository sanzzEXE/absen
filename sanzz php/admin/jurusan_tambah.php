<?php
include "../koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_jurusan = $_POST['nama_jurusan'];
    $singkatan    = $_POST['singkatan'];

    mysqli_query($koneksi, "INSERT INTO jurusan (nama_jurusan, singkatan) VALUES ('$nama_jurusan','$singkatan')");
    header("Location: index.php?page=jurusan&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4 text-center">👨‍🏫 Tambah Data jurusan</h2>

    <form method="post" class="border rounded p-4 shadow-sm bg-light">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nama jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Singkatan</label>
                <input type="text" name="singkatan" class="form-control" required>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" name="simpan" class="btn btn-success me-2">💾 Simpan</button>
            <a href="index.php?page=jurusan" class="btn btn-secondary">↩️ Kembali</a>
        </div>
    </form>
</div>
