<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include "../koneksi.php";

if (empty($_SESSION['mpk']) || empty($_SESSION['id_kelas'])) {
    header("Location: login.php");
    exit;
}

$id_kelas = (int) $_SESSION['id_kelas'];

// Ambil siswa
$siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$id_kelas' ORDER BY nama_siswa ASC");

// Simpan absensi
if (isset($_POST['simpan'])) {

    $today = date("Y-m-d");

    foreach ($_POST['absen'] as $id_siswa => $status) {
        $id_siswa = (int)$id_siswa;

        // Validasi biar VARCHAR(10) aman
        if (!in_array($status, ["Hadir", "Izin", "Alfa"])) {
            continue;
        }

        $sql = "
            INSERT INTO absensi (id_siswa, tgl_absensi, keterangan)
            VALUES ('$id_siswa', '$today', '$status')
        ";

        mysqli_query($koneksi, $sql);
    }

    $_SESSION['msg'] = "Absensi berhasil disimpan!";
    header("Location: history.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Absensi</title>
<link rel="stylesheet" href="3pilihan.css">
</head>
<body>

<div class="container">
<h2>Absensi Kelas</h2>
<p>Tanggal: <?= date("d M Y") ?></p>

<form method="post">
<table class="absensi-table">
<tr>
  <th>No</th>
  <th>Nama Siswa</th>
  <th>Status</th>
</tr>

<?php
$no = 1;
while ($row = mysqli_fetch_assoc($siswa)) {
?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
  <td>
    <select name="absen[<?= $row['id_siswa'] ?>]" required>
      <option value="">-- Pilih --</option>
      <option value="Hadir">Hadir</option>
      <option value="Izin">Izin</option>
      <option value="Alfa">Alfa</option>
    </select>
  </td>
</tr>
<?php } ?>

</table>

<br>
<button type="submit" name="simpan" class="btn-submit">Simpan Absensi</button>
</form>

<br>
<a href="data.php" class="back-link">⬅ Kembali</a>
</div>

</body>
</html>
