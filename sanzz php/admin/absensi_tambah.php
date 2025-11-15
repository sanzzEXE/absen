<?php
include "../koneksi.php";
if (isset($_POST['simpan'])) {
    $tgl_absensi = $_POST['tgl_absensi'];
    $id_siswa = $_POST['id_siswa'];
    $keterangan   = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT INTO absensi (tgl_absensi, id_siswa, keterangan) VALUES ('$tgl_absensi','$id_siswa','$keterangan')");
    header("Location: index.php?page=absensi&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Absensi</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Tanggal Absensi</label>
            <input type="date" name="tgl_absensi" class="form-control" required>
        </div>
        <!-- siswa -->
        <div class="mb-3">
            <label class="form-label">siswa</label>
            <select name="id_siswa" class="form-select" required>
                <option value="">-- Pilih siswa --</option>
                <?php 
                $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC") 
                        or die(mysqli_error($koneksi));
                while ($g = mysqli_fetch_assoc($siswa)) { ?>
                    <option value="<?= $g['id_siswa']; ?>"><?= $g['nama_siswa']; ?></option>
                <?php } ?>
            </select>
        
        </div>
          <div class="mb-3">
            <label class="form-label">Keterangan</label>
           <input type="text" name="keterangan" class="form-control" required>

        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=absensi" class="btn btn-secondary">Kembali</a>
    </form>
</div>