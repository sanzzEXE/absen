<?php
include "../koneksi.php";

// Proses simpan data
if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $id_siswa = $_POST['id_siswa'];
    $id_kelas = $_POST['id_kelas'];
    $password = md5($_POST['password']);

    $insert = mysqli_query($koneksi, "INSERT INTO mpk (username, id_siswa, id_kelas, password) 
                                      VALUES ('$username', '$id_siswa', '$id_kelas', '$password')")
              or die("Query Gagal: " . mysqli_error($koneksi));

    header("Location: index.php?page=mpk&pesan=tambah");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Data MPK</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Siswa</label>
            <select name="id_siswa" class="form-select" required>
                <option value="">-- Pilih Siswa --</option>
                <?php 
                $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC") or die(mysqli_error($koneksi));
                while ($g = mysqli_fetch_assoc($siswa)) { ?>
                    <option value="<?= $g['id_siswa']; ?>"><?= $g['nama_siswa']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                <?php 
                $kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC") or die(mysqli_error($koneksi));
                while ($k = mysqli_fetch_assoc($kelas)) { ?>
                    <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" name="password" class="form-control" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=mpk" class="btn btn-secondary">Kembali</a>
    </form>
</div>
