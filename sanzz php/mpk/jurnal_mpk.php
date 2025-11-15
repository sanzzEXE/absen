<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include "../koneksi.php";

if (!isset($_SESSION['mpk'])) {
    header("Location: login.php");
    exit;
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'] ?? date('Y-m-d');
    $kegiatan = trim($_POST['kegiatan'] ?? '');
    $id_kelas = (int) $_SESSION['id_kelas'];

    if ($kegiatan != "") {
        mysqli_query(
            $koneksi,
            "INSERT INTO jurnal (id_kelas, tanggal, kegiatan)
             VALUES ('$id_kelas', '$tanggal', '".mysqli_real_escape_string($koneksi,$kegiatan)."')"
        );
        $msg = "Jurnal berhasil disimpan!";
    } else {
        $msg = "Isi kegiatan terlebih dahulu!";
    }
}

$rows = [];
$q = mysqli_query($koneksi, "SELECT * FROM jurnal WHERE id_kelas='$id_kelas' ORDER BY tanggal DESC LIMIT 20");
while ($r = mysqli_fetch_assoc($q)) $rows[] = $r;
?>
<!DOCTYPE html>
<html>
<head>
<title>Jurnal</title>
<link rel="stylesheet" href="3pilihan.css">
</head>
<body>

<div class="container">
<h2>Jurnal Kegiatan</h2>

<?php if(!empty($msg)) echo "<p class='flash-msg'>$msg</p>"; ?>

<form method="post">
<label>Tanggal</label><br>
<input type="date" name="tanggal" value="<?= date('Y-m-d') ?>"><br><br>

<label>Kegiatan</label><br>
<textarea name="kegiatan" rows="3" style="width:100%"></textarea><br><br>

<button type="submit" class="btn-submit">Simpan</button>
</form>

<h3>Riwayat Jurnal</h3>
<ul>
<?php foreach ($rows as $r): ?>
<li><?= htmlspecialchars($r['tanggal'])." - ".htmlspecialchars($r['kegiatan']) ?></li>
<?php endforeach; ?>
</ul>

<br>
<a href="data.php" class="back-link">⬅ Kembali</a>

</div>
</body>
</html>
