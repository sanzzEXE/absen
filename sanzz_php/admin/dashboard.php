
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Web Absen</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="content">
    <header>
        <h1 class="judul">RPL-SMK Negeri 1 Sukawati</h1>
        <h3 class="deskripsi"><b>Selamat Datang Di Website Sekolah</b></h3>
    </header>

    <div class="menu">
        <ul>
            <li><a href="dashboard.php?page=home">Home</a></li>
            <li><a href="dashboard.php?page=guru">Guru</a></li>
            <li><a href="dashboard.php?page=siswa">Siswa</a></li>
            <li><a href="dashboard.php?page=mpk">MPK</a></li>
            <li><a href="dashboard.php?page=pegawai">Pegawai</a></li>
            <li><a href="dashboard.php?page=jurusan">Jurusan</a></li>
            <li><a href="dashboard.php?page=kelas">Kelas</a></li>
            <li><a href="dashboard.php?page=absensi">Absensi</a></li>
            <li><a href="dashboard.php?page=jurnal">Jurnal</a></li>
            <li><a href="dashboard.php?page=pembayaran">Pembayaran</a></li>
        </ul>
    </div>

    <div class="badan">
    <?php
    if (isset($_GET['page'])){
        $page = $_GET['page'];
        switch ($page){
            case 'home':
                include "home.php";
                break;
            case 'guru':
                include "guru.php";
                break;
            case 'pegawai':
                include "pegawai.php";
                break;
            case 'jurusan':
                include "jurusan.php";
                break;
            case 'kelas':
                include "kelas.php";
                break;
            case 'mpk':
                include "mpk.php";
                break;
             case 'jurnal':
                include "jurnal.php";
                break;
            default:
            case 'pembayaran':
                include "pembayaran.php";
            break;
            case 'siswa':
                include "siswa.php";
            break;
            case 'absensi':
                include "absensi.php";
            break;
                echo "<center><h3>Maaf, halaman tidak ditemukan</h3></center>";
        }
    } else {
        include "home.php";
    }
    ?>
    </div>
</div>
</body>
</html>