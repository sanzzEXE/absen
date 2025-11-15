<?php
// Cek apakah ada pencarian
include("../koneksi.php");
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM pembayaran,siswa,pegawai
                                      WHERE pembayaran.id_siswa =siswa.id_siswa
                                      AND pembayaran.id_pegawai =pegawai.id_pegawai
                                      AND nama_siswa LIKE '%$cari%' 
                                      ORDER BY id_pembayaran DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM pembayaran,siswa,pegawai WHERE pembayaran.id_siswa = siswa.id_siswa AND pembayaran.id_pegawai = pegawai.id_pegawai ORDER BY id_pembayaran DESC");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-2">
    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php
            if ($_GET['pesan'] == 'tambah')
                echo "✅ Data pembayaran berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit')
                echo "✅ Data pembayaran berhasil diperbaharui!";
            if ($_GET['pesan'] == 'hapus')
                echo "✅ Data pembayaran berhasil dihapus!";
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <h2 class="mb-2 text-center">📚 Data pembayaran</h2>

    
    <!-- Pencarian + Tombol Tambah -->
    <div class="d-flex justify-content-between mb-3">
        <form class="d-flex" method="get" action="">
            <input type="hidden" name="page" value="pembayaran">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari pembayaran..."
                value="<?= htmlspecialchars($cari) ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </form>
        <a href="pembayaran_tambah.php" class="btn btn-primary">+ Tambah pembayaran</a>
    </div>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>tgl pembayaran</th>
                    <th>bulan</th>
                    <th>nominal</th>
                    <th>methode</th>
                    <th>pegawai</th>
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
                            <td><?= $row['tgl_pembayaran'] ?></td>
                            <td><?= $row['bulan'] ?></td>
                            <td><?= $row['nominal'] ?></td>
                            <td><?= $row['metode'] ?></td>
                            <td><?= $row['nama_pegawai'] ?></td>
                            <td>
                                <a href="pembayaran_edit.php?id=<?= $row['id_pembayaran'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="pembayaran_hapus.php?id=<?= $row['id_pembayaran'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus pembarayan ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">⚠ Data tidak ditemukan</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>