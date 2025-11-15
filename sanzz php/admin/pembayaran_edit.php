<?php
include "../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php?page=pembayaran");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_pembayaran='$id'"));

if (isset($_POST['update'])) {
    $id_siswa       = $_POST['id_siswa'];
    $id_pegawai     = $_POST['id_pegawai'];
    $tgl_pembayaran = $_POST['tgl_pembayaran'];
    $bulan          = (int)$_POST['bulan'];
    $nominal        = $_POST['nominal'];
    $metode         = $_POST['metode'];

    mysqli_query($koneksi, "UPDATE pembayaran SET 
        id_siswa='$id_siswa',
        id_pegawai='$id_pegawai',
        tgl_pembayaran='$tgl_pembayaran',
        bulan='$bulan',
        nominal='$nominal',
        metode='$metode'
        WHERE id_pembayaran='$id'
    ") or die(mysqli_error($koneksi));

    header("Location: index.php?page=pembayaran&pesan=edit");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Pembayaran</h2>
    <form method="post">

        <!-- Siswa -->
        <div class="mb-3">
            <label class="form-label">Siswa</label>
            <select name="id_siswa" class="form-select" required>
                <option value="">-- Pilih Siswa --</option>
                <?php 
                $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC") 
                        or die(mysqli_error($koneksi));
                while ($s = mysqli_fetch_assoc($siswa)) { 
                    $selected = ($s['id_siswa'] == $data['id_siswa']) ? 'selected' : '';
                    echo "<option value='{$s['id_siswa']}' $selected>{$s['nama_siswa']}</option>";
                } ?>
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
                while ($p = mysqli_fetch_assoc($pegawai)) { 
                    $selected = ($p['id_pegawai'] == $data['id_pegawai']) ? 'selected' : '';
                    echo "<option value='{$p['id_pegawai']}' $selected>{$p['nama_pegawai']}</option>";
                } ?>
            </select>
        </div>

        <!-- Tanggal Pembayaran -->
        <div class="mb-3">
            <label class="form-label">Tanggal Pembayaran</label>
            <input type="date" name="tgl_pembayaran" class="form-control" value="<?= $data['tgl_pembayaran']; ?>" required>
        </div>

        <!-- Bulan -->
        <div class="mb-3">
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-select" required>
                <option value="">-- Pilih Bulan --</option>
                <?php 
                $bulanList = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                ];
                foreach ($bulanList as $num => $nama) {
                    $selected = ($data['bulan'] == $num) ? 'selected' : '';
                    echo "<option value='$num' $selected>$nama</option>";
                }
                ?>
            </select>
        </div>

        <!-- Nominal -->
        <div class="mb-3">
            <label class="form-label">Nominal</label>
            <input type="number" name="nominal" class="form-control" value="<?= $data['nominal']; ?>" required>
        </div>

        <!-- Metode -->
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode" class="form-select" required>
                <option value="">-- Pilih Metode --</option>
                <option value="Cash" <?= ($data['metode'] == 'Cash') ? 'selected' : ''; ?>>Cash</option>
                <option value="Transfer" <?= ($data['metode'] == 'Transfer') ? 'selected' : ''; ?>>Transfer</option>
            </select>
        </div>

        <!-- Tombol -->
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php?page=pembayaran" class="btn btn-secondary">Kembali</a>
    </form>
</div>
