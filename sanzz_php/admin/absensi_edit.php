<?php
include "../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: index.php?page=absensi");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_absensi=$id"));

if (isset($_POST['update'])) {
   $tgl_absensi = $_POST['tgl_absensi'];
    $id_siswa = $_POST['id_siswa'];
    $keterangan   = $_POST['keterangan'];

    // update sesuai struktur tabel
   mysqli_query($koneksi, "UPDATE absensi SET 
    tgl_absensi='$tgl_absensi',
    id_siswa='$id_siswa',
    keterangan='$keterangan'
    WHERE id_absensi=$id");

    header("Location: index.php?page=absensi&pesan=edit");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit absensi</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Tanggal Absensi</label>
            <input type="date" name="tgl_absensi" class="form-control" 
                   value="<?= $data['tgl_absensi']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">siswa</label>
            <select name="id_siswa" class="form-select" required>
                <option value="">-- Pilih siswa --</option>
                <?php 
                $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                while ($g = mysqli_fetch_assoc($siswa)) { ?>
                    <option value="<?= $g['id_siswa']; ?>" 
                        <?= ($g['id_siswa'] == $data['id_siswa']) ? 'selected' : ''; ?>>
                        <?= $g['nama_siswa']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
            <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" 
                   value="<?= $data['keterangan']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php?page=absensi" class="btn btn-secondary">Kembali</a>
    </form>
</div>
