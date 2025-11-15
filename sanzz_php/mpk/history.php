<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include "../koneksi.php";

if (!isset($_SESSION['id_kelas'])) {
    header("Location: login.php");
    exit;
}

$id_kelas = (int) $_SESSION['id_kelas'];

$search_name = trim($_GET['nama'] ?? '');
$search_date = trim($_GET['tanggal'] ?? '');

$where = "s.id_kelas='$id_kelas'";

if ($search_name !== '') {
    $safe = mysqli_real_escape_string($koneksi, $search_name);
    $where .= " AND s.nama_siswa LIKE '%$safe%'";
}

if ($search_date !== '') {
    $safe = mysqli_real_escape_string($koneksi, $search_date);
    $where .= " AND a.tgl_absensi='$safe'";
}

$sql = "
    SELECT a.*, s.nama_siswa
    FROM absensi a
    JOIN siswa s ON a.id_siswa = s.id_siswa
    WHERE $where
    ORDER BY a.tgl_absensi DESC, s.nama_siswa ASC
";

$q = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Riwayat Absensi</title>
<link rel="stylesheet" href="3pilihan.css">
</head>
<body>

<div class="container">
<h2>Riwayat Absensi</h2>

<form method="get" class="search-form">
    <input type="text" name="nama" placeholder="Cari nama..." value="<?= htmlspecialchars($search_name) ?>">
    <input type="date" name="tanggal" value="<?= htmlspecialchars($search_date) ?>">
    <button class="search-btn">Cari</button>
    <a href="history.php" class="back-link">Reset</a>
</form>

<?php
$lastDate = "";
$no = 1;

if (mysqli_num_rows($q) == 0) {
    echo "<p>Tidak ada data.</p>";
} else {
    while ($row = mysqli_fetch_assoc($q)) {

        if ($lastDate != $row['tgl_absensi']) {
            if ($lastDate != "") echo "</table>";

            echo "<h3>📅 ".date("d M Y", strtotime($row['tgl_absensi']))."</h3>";

            echo "
            <table border='1' cellpadding='8' width='100%'>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Status</th>
                </tr>";
            
            $no = 1;
            $lastDate = $row['tgl_absensi'];
        }

        echo "
        <tr>
            <td>$no</td>
            <td>".htmlspecialchars($row['nama_siswa'])."</td>
            <td>".htmlspecialchars($row['keterangan'])."</td>
        </tr>";

        $no++;
    }

    echo "</table>";
}
?>

<br>
<a href="data.php" class="back-link">⬅ Kembali</a>

</div>

</body>
</html>
