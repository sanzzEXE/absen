<?php
include "../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: index.php?page=pegawai");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai=$id"));

if (isset($_POST['update'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat    = $_POST['alamat'];
    $telp      = $_POST['telp'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];

    mysqli_query($koneksi, "UPDATE pegawai SET 
        nama_pegawai='$nama_pegawai', 
        tgl_lahir='$tgl_lahir', 
        alamat='$alamat', 
        telp='$telp', 
        username='$username', 
        password='$password' 
        WHERE id_pegawai=$id
    ") or die(mysqli_error($koneksi));

    header("Location: index.php?page=pegawai&pesan=edit");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4 text-center">✏️ Edit Data Pegawai</h2>

    <form method="post" class="border rounded p-4 shadow-sm bg-light">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nama Pegawai</label>
                <input type="text" name="nama_pegawai" class="form-control" value="<?= htmlspecialchars($data['nama_pegawai']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="<?= htmlspecialchars($data['tgl_lahir']) ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Telepon</label>
                <input type="text" name="telp" maxlength="15" class="form-control" value="<?= htmlspecialchars($data['telp']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username']) ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($data['password']) ?>" required>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" name="update" class="btn btn-success me-2">💾 Update</button>
            <a href="index.php?page=pegawai" class="btn btn-secondary">↩️ Kembali</a>
        </div>
    </form>
</div>
