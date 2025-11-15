<?php
include "../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: index.php?page=mpk");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM mpk WHERE id_mpk='$id'"));

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $id_siswa      = $_POST['id_siswa'];
    $id_kelas     = $_POST['id_kelas'];
    $password = md5($_POST['password']);
   
   mysqli_query($koneksi, "UPDATE mpk SET 
    username='$username',
    id_siswa='$id_siswa',
    id_kelas='$id_kelas',
    password='$password'
    WHERE id_mpk='$id'") or die(mysqli_error($koneksi));


    header("Location: index.php?page=mpk&pesan=edit");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container mt-5">
    <h2 class="mb-4">Edit Data Siswa</h2>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Siswa</label>
            <select name="id_siswa" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                <?php
                $qsiswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                while ($siswa = mysqli_fetch_assoc($qsiswa)) {
                    $selected = ($siswa['id_siswa'] == $data['id_siswa']) ? "selected" : "";
                    echo "<option value='{$siswa['id_siswa']}' $selected>{$siswa['nama_siswa']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                <?php
                $qKelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                while ($kelas = mysqli_fetch_assoc($qKelas)) {
                    $selected = ($kelas['id_kelas'] == $data['id_kelas']) ? "selected" : "";
                    echo "<option value='{$kelas['id_kelas']}' $selected>{$kelas['nama_kelas']}</option>";
                }
                ?>
            </select>
        </div>
        
            <div class="col-md-3 mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
            </div>

        <!-- password -->
        <div class="mb-3">
            <label class="form-label">password</label>
            <input type="text" name="password" class="form-control" 
                   value="<?= $data['password']; ?>" required>
                </div>
        <!-- Tombol -->
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php?page=mpk" class="btn btn-secondary">Kembali</a>
    </form>
</div>
