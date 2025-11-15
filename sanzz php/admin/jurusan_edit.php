<?php
include "../koneksi.php";

// Cek apakah parameter id dikirim
if (!isset($_GET['id'])) {
    header("Location: index.php?page=jurusan");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jurusan WHERE id_jurusan=$id"));

// Proses update data
if (isset($_POST['update'])) {
    $nama_jurusan = $_POST['nama_jurusan'];
    $singkatan    = $_POST['singkatan'];

    mysqli_query($koneksi, "UPDATE jurusan SET 
        nama_jurusan='$nama_jurusan', 
        singkatan='$singkatan' 
        WHERE id_jurusan=$id
    ") or die(mysqli_error($koneksi));

    header("Location: index.php?page=jurusan&pesan=edit");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4 text-center">✏️ Edit Data Jurusan</h2>

    <form method="post" class="border rounded p-4 shadow-sm bg-light">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control" 
                       value="<?= htmlspecialchars($data['nama_jurusan']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Singkatan</label>
                <input type="text" name="singkatan" maxlength="5" class="form-control" 
                       value="<?= htmlspecialchars($data['singkatan']) ?>" required>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" name="update" class="btn btn-success me-2">💾 Update</button>
            <a href="index.php?page=jurusan" class="btn btn-secondary">↩️ Kembali</a>
        </div>
    </form>
</div>
