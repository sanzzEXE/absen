<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['mpk'])) {
    header("Location: login.php");
    exit;
}

$page = $_GET['page'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Data MPK</title>
<link rel="stylesheet" href="3pilihan.css">
<style>
/* ===== MENU KOTAK PUTIH ===== */
.mpk-menu-pilihan {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 100px;
  margin-top: 80px;
}

.mpk-menu-btn {
  display: flex;
  flex-direction: column; /* Mengubah arah flex menjadi kolom untuk menampung dua baris teks */
  justify-content: center;
  align-items: center;
  text-align: center; /* Teks di tengah */
  width: 350px;
  height: 250px;
  background: rgba(255, 255, 255, 0.9);
  color: #0b6b5a;
  font-size: 24px; /* Ukuran font lebih besar untuk judul */
  font-weight: 700;
  text-decoration: none;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  line-height: 1.2; /* Mengatur jarak antar baris */
}

.mpk-menu-btn span {
    font-size: 16px; /* Ukuran font lebih kecil untuk deskripsi */
    font-weight: 500;
    margin-top: 5px;
    display: block; /* Memastikan deskripsi berada di baris baru */
}

.mpk-menu-btn:hover {
  background: #0b6b5a;
  color: white;
  transform: translateY(-6px);
  box-shadow: 0 8px 25px rgba(11, 107, 90, 0.3);
}


/* ===== CONTAINER DENGAN SHADOW (DITEBALKAN) ===== */
.mpk-container {
    padding: 30px;
    background-color: #ffffff;
    border-radius: 12px;
    /* Nilai box-shadow diubah untuk shadow yang lebih tebal dan jelas */
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); /* Offset y, blur, dan opasitas ditingkatkan */
    margin-top: 20px;
    margin-bottom: 20px;
}
/* ===== NAVBAR ===== */
.mpk-navbar{
  background: linear-gradient(90deg,#0fa986,#0b8b74); /* teal gradient matching index */
  color: #fff;
  box-shadow: 0 6px 20px rgba(11,107,90,0.12);
}
.mpk-navbar-container{
  max-width:1000px;
  height: 100px;
  margin:0 auto;
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:14px 20px;
}
.mpk-navbar-title{font-size:20px;margin:0;font-weight:700}
.mpk-navbar-user{display:flex;align-items:center;gap:12px}
.mpk-navbar-user span{color:rgba(255,255,255,0.95);font-weight:600}
.mpk-logout-btn{background:#fff;color:#0b6b5a;padding:8px 12px;border-radius:10px;text-decoration:none;font-weight:700}
.mpk-logout-btn:hover{opacity:0.95}

/* Center page content and add comfortable padding */
.mpk-content{max-width:1000px;margin:0 auto;padding:30px}

/* Responsif */
@media (max-width: 768px) {
  .mpk-menu-btn {
    width: 140px;
    height: 110px;
    font-size: 18px;
  }
  .mpk-menu-btn span {
      font-size: 12px;
      margin-top: 2px;
  }
  .mpk-menu-pilihan {
      gap: 30px;
      margin-top: 40px;
  }
}
</style>
</head>
<body>

<header class="mpk-navbar">
  <div class="mpk-navbar-container">
    <h1 class="mpk-navbar-title">📋 Sistem Data MPK</h1>
    <div class="mpk-navbar-user">
      <span>👋 Halo, <?= htmlspecialchars($_SESSION['username']); ?></span>
      <a href="logout.php" class="mpk-logout-btn">Logout</a>
    </div>
  </div>
</header>

<main class="mpk-content"> <div class="mpk-container"> <?php
  // Tampilkan pesan flash (jika ada) sebagai toast
  if (session_status() === PHP_SESSION_NONE) session_start();
  $flash_msg = '';
  if (!empty($_SESSION['msg'])) {
    $flash_msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
  if ($flash_msg) {
    // render toast with close button
    echo '<div id="toast" class="toast success" role="alert">'
       . '<div class="toast-msg">' . htmlspecialchars($flash_msg) . '</div>'
       . '<button class="toast-close" aria-label="Tutup">×</button>'
       . '</div>';
    echo "<script>(function(){var t=document.getElementById('toast');if(!t)return;setTimeout(function(){t.classList.add('show')},50);var b=t.querySelector('.toast-close');b.addEventListener('click',function(){t.classList.remove('show');setTimeout(function(){t.remove()},350)});setTimeout(function(){if(t)t.classList.remove('show')},4500);})();</script>";
  }
     if ($page == 'home') {
    echo "
    <h2><center>Selamat Datang di Dashboard MPK</center></h2>
    <p><center>Silakan pilih menu di bawah ini</center></p>
    <div class='mpk-menu-pilihan'>
      <a href='?page=absensi' class='mpk-menu-btn'>
        📝 Kelola Absensi
        <span>Input dan catat kehadiran siswa</span>
      </a>

      <a href='history.php' class='mpk-menu-btn'>
        📑 History Absensi
        <span>Lihat data absensi yang sudah tersimpan</span>
      </a>
    </div>
          ";
    } elseif ($page == 'absensi') {
      include "absensi_mpk.php";
    } elseif ($page == 'jurnal') {
      include "jurnal_mpk.php";
      }
      else {
          echo "<p>Halaman tidak ditemukan.</p>";
      }
    ?>
  </div>
</main>

</body>
</html>