<?php
include "../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: index.php?page=jurnal");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jurnal WHERE id_jurnal='$id'"));

if (isset($_POST['update'])) {
    $tgl_mengajar = $_POST['tgl_mengajar'];
    $id_guru      = $_POST['id_guru'];
    $id_kelas     = $_POST['id_kelas'];
    $materi       = $_POST['materi'];
    $ket          = $_POST['ket'];

    mysqli_query($koneksi, "UPDATE jurnal SET 
        tgl_mengajar='$tgl_mengajar',
        id_guru='$id_guru',
        id_kelas='$id_kelas',
        materi='$materi',
        ket='$ket'
        WHERE id_jurnal='$id'");

    header("Location: index.php?page=jurnal&pesan=edit");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Edit Jurnal</h2>
    <form method="post">
        <!-- Tanggal -->
        <div class="mb-3">
            <label class="form-label">Tanggal Mengajar</label>
            <input type="date" name="tgl_mengajar" class="form-control" 
                   value="<?= $data['tgl_mengajar']; ?>" required>
        </div>

        <!-- Guru -->
        <div class="mb-3">
            <label class="form-label">Guru</label>
            <select name="id_guru" class="form-select" required>
                <option value="">-- Pilih Guru --</option>
                <?php 
                $guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama_guru ASC");
                while ($g = mysqli_fetch_assoc($guru)) { ?>
                    <option value="<?= $g['id_guru']; ?>" 
                        <?= ($g['id_guru'] == $data['id_guru']) ? 'selected' : ''; ?>>
                        <?= $g['nama_guru']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Kelas -->
        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                <?php 
                $kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                while ($k = mysqli_fetch_assoc($kelas)) { ?>
                    <option value="<?= $k['id_kelas']; ?>" 
                        <?= ($k['id_kelas'] == $data['id_kelas']) ? 'selected' : ''; ?>>
                        <?= $k['nama_kelas']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Materi -->
        <div class="mb-3">
            <label class="form-label">Materi</label>
            <input type="text" name="materi" class="form-control" 
                   value="<?= $data['materi']; ?>" required>
        </div>

        <!-- Keterangan -->
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="ket" class="form-control" 
                   value="<?= $data['ket']; ?>" required>
        </div>

        <!-- Tombol -->
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php?page=jurnal" class="btn btn-secondary">Kembali</a>
    </form>
</div>
