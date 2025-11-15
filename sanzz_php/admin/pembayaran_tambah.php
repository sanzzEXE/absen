<?php
include "../koneksi.php";

// Proses simpan data
if (isset($_POST['simpan'])) {
    $id_siswa       = $_POST['id_siswa'];
    $id_pegawai     = $_POST['id_pegawai'];
    $tgl_pembayaran = $_POST['tgl_pembayaran'];
    $bulan          = (int)$_POST['bulan']; // pastikan integer
    $nominal        = $_POST['nominal'];
    $metode         = $_POST['metode'];

    mysqli_query($koneksi, "INSERT INTO pembayaran (id_siswa, id_pegawai, tgl_pembayaran, bulan, nominal, metode)
                            VALUES ('$id_siswa','$id_pegawai','$tgl_pembayaran','$bulan','$nominal','$metode')")
        or die(mysqli_error($koneksi));

    header("Location: index.php?page=pembayaran&pesan=tambah");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Pembayaran</h2>
    <form method="post">

        <!-- Siswa -->
        <div class="mb-3">
            <label class="form-label">Siswa</label>
            <select name="id_siswa" class="form-select" required>
                <option value="">-- Pilih Siswa --</option>
                <?php 
                $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC") 
                        or die(mysqli_error($koneksi));
                while ($s = mysqli_fetch_assoc($siswa)) { ?>
                    <option value="<?= $s['id_siswa']; ?>"><?= $s['nama_siswa']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Pegawai -->
        <div class="mb-3">
            <label class="form-label">Pegawai</label>
            <select name="id_pegawai" class="form-select" required>
                <option value="">-- Pilih Pegawai --</option>
                <?php 
                $pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai ASC") 
                         or die(mysqli_error($koneksi));
                while ($p = mysqli_fetch_assoc($pegawai)) { ?>
                    <option value="<?= $p['id_pegawai']; ?>"><?= $p['nama_pegawai']; ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Tanggal Pembayaran -->
        <div class="mb-3">
            <label class="form-label">Tanggal Pembayaran</label>
            <input type="date" name="tgl_pembayaran" class="form-control" required>
        </div>

        <!-- Bulan -->
        <div class="mb-3">
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-select" required>
                <option value="">-- Pilih Bulan --</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>

        <!-- Nominal -->
        <div class="mb-3">
            <label class="form-label">Nominal</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>

        <!-- Metode -->
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode" class="form-select" required>
                <option value="">-- Pilih Metode --</option>
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
        </div>

        <!-- Tombol -->
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=pembayaran" class="btn btn-secondary">Kembali</a>
    </form>
</div>
