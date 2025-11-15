<?php
include "../koneksi.php";

// Cek apakah ada pencarian
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $sql = "SELECT mpk.*, siswa.nama_siswa, kelas.nama_kelas 
            FROM mpk, siswa, kelas
            WHERE mpk.id_siswa = siswa.id_siswa
              AND mpk.id_kelas = kelas.id_kelas
              AND siswa.nama_siswa LIKE '%$cari%'
            ORDER BY mpk.id_mpk DESC";
} else {
    $sql = "SELECT mpk.*, siswa.nama_siswa, kelas.nama_kelas 
            FROM mpk, siswa, kelas
            WHERE mpk.id_siswa = siswa.id_siswa
              AND mpk.id_kelas = kelas.id_kelas
            ORDER BY mpk.id_mpk DESC";
}

$result = mysqli_query($koneksi, $sql) or die("Query Error: " . mysqli_error($koneksi));
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-2">
    <h2 class="mb-2 text-center">📚 Data MPK</h2>

    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php 
            if ($_GET['pesan'] == 'tambah') echo "✅ Data MPK berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data MPK berhasil diperbarui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data MPK berhasil dihapus!";
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Pencarian + Tombol Tambah -->
    <div class="d-flex justify-content-between mb-3">
        <form class="d-flex" method="get" action="">
            <input type="hidden" name="page" value="mpk">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari nama siswa..." value="<?= $cari ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </form>
        <a href="mpk_tambah.php" class="btn btn-primary">+ Tambah MPK</a>
    </div>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Nama Kelas</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td>
                            <a href="mpk_edit.php?id=<?= $row['id_mpk'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="mpk_hapus.php?id=<?= $row['id_mpk'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
            <?php } 
            } else { ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">⚠️ Data tidak ditemukan</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
