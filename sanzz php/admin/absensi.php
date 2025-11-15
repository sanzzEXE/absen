<?php
include "../koneksi.php";

$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $query = "SELECT absensi.*, siswa.nama_siswa, siswa.tgl_lahir 
              FROM absensi, siswa
              WHERE absensi.id_siswa = siswa.id_siswa
              AND siswa.nama_siswa LIKE '%$cari%'
              ORDER BY absensi.id_absensi DESC";
} else {
    $query = "SELECT absensi.*, siswa.nama_siswa, siswa.tgl_lahir 
              FROM absensi, siswa
              WHERE absensi.id_siswa = siswa.id_siswa
              ORDER BY absensi.id_absensi DESC";
}

$result = mysqli_query($koneksi, $query);

// Tambahkan ini untuk cek error query
if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-2">
    <h2 class="mb-2 text-center">📚 Data Absensi</h2>

    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php 
            if ($_GET['pesan'] == 'tambah') echo "✅ Data absensi berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data absensi berhasil diperbarui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data absensi berhasil dihapus!";
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mb-3">
        <form class="d-flex" method="get" action="">
            <input type="hidden" name="page" value="absensi">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari nama siswa..." value="<?= $cari ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </form>
        <a href="absensi_tambah.php" class="btn btn-primary">+ Tambah Absensi</a>
    </div>

   <!-- Tabel Data Ringkas -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal Absensi</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $No = 1; 
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $No++ ?></td>
                        <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                        <td><?= htmlspecialchars($row['tgl_absensi']) ?></td>
                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                        <td>
                            <!-- Tombol untuk membuka modal detail absensi -->
                            <button 
                                class="btn btn-info btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#detailModal<?= $row['id_absensi'] ?>">
                                🔍 Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Detail untuk baris ini (id berdasarkan id_absensi) -->
                    <div class="modal fade" id="detailModal<?= $row['id_absensi'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Detail Absensi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p><strong>Nama:</strong> <?= htmlspecialchars($row['nama_siswa']) ?></p>
                                    <p><strong>Tanggal Lahir:</strong> <?= htmlspecialchars($row['tgl_lahir']) ?></p>
                                    <p><strong>Keterangan:</strong> <?= htmlspecialchars($row['keterangan']) ?></p>
                                </div>
                                <div class="modal-footer">
                                    <a href="absensi_edit.php?id=<?= $row['id_absensi'] ?>" class="btn btn-warning">✏️ Edit</a>
                                    <a href="absensi_hapus.php?id=<?= $row['id_absensi'] ?>" 
                                       class="btn btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus absensi ini?')">🗑️ Hapus</a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>