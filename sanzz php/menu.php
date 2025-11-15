<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: lobby.php");
    exit();
}
$page = isset($_GET['page']) ? $_GET['page'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilihan Menu</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="3pilihan.css">
</head>
<body>
  <div class="container">
    <?php if ($page == ''): ?>
      <h2 class="title">Selamat Datang!</h2>
      <p class="desc">Pilih layanan di bawah ini untuk melanjutkan:</p>
      <div class="menu-pilihan">
        <a href="menu.php?page=kehadiran" class="menu-btn">
          <span class="icon">🗓️</span>
          <span>
            <span class="menu-title">Kehadiran</span>
            <span class="menu-desc">Cek dan rekap absensi harian</span>
          </span>
        </a>
        <a href="menu.php?page=jurnal" class="menu-btn">
          <span class="icon">📒</span>
          <span>
            <span class="menu-title">Jurnal</span>
            <span class="menu-desc">Catatan kegiatan dan tugas</span>
          </span>
        </a>
        <a href="menu.php?page=spp" class="menu-btn">
          <span class="icon">💸</span>
          <span>
            <span class="menu-title">SPP</span>
            <span class="menu-desc">Informasi pembayaran SPP</span>
          </span>
        </a>
      </div>
      <a href="logout.php" class="logout-btn" id="logoutBtn">Logout</a>

    <?php elseif ($page === 'spp'): ?>
      <h2 class="title">Informasi SPP</h2>
      <p class="desc">Status pembayaran SPP siswa.</p>
      <!-- Form tambah SPP (client-side demo) -->
      <form id="sppForm" style="margin-bottom:18px;display:flex;gap:8px;flex-wrap:wrap;">
        <input name="nama" placeholder="Nama siswa" style="padding:8px;border-radius:6px;border:1px solid #ddd;flex:1;min-width:160px;">
        <input name="bulan" placeholder="Bulan" style="padding:8px;border-radius:6px;border:1px solid #ddd;width:140px;">
        <select name="status" style="padding:8px;border-radius:6px;border:1px solid #ddd;width:140px;">
          <option value="Lunas">Lunas</option>
          <option value="Belum Lunas">Belum Lunas</option>
        </select>
        <button class="primary-btn" type="submit">Tambah</button>
      </form>

      <table id="sppTable">
        <thead>
          <tr><th>Nama</th><th>Bulan</th><th>Status</th></tr>
        </thead>
        <tbody>
          <tr><td>Budi</td><td>September</td><td>Lunas</td></tr>
          <tr><td>Siti</td><td>September</td><td>Belum Lunas</td></tr>
          <tr><td>Agus</td><td>September</td><td>Lunas</td></tr>
        </tbody>
      </table>
  <a href="menu.php" class="back-link">&larr; Kembali</a>

    <?php elseif ($page === 'kehadiran'): ?>
      <h2 class="title">Kehadiran</h2>
      <p class="desc">Cek dan rekap absensi harian siswa.</p>
      <form class="absensi-form" id="absensiForm">
        <select name="tanggal" required>
          <option value="">Pilih Tanggal</option>
          <option value="2025-09-09">2025-09-09</option>
          <option value="2025-09-08">2025-09-08</option>
          <option value="2025-09-07">2025-09-07</option>
        </select>
       
        <button type="submit" class="primary-btn">Simpan</button>
      </form>

      <table>
        <thead>
          <tr><th>Nama</th><th>Tanggal</th><th>Status</th></tr>
        </thead>
        <tbody>
          <tr>
            <td>Tanjiro</td>
            <td>2025-09-09</td>
            <td>
              <form class="inline-form">
                <select>
                  <option>Izin</option><option>Sakit</option><option>Alpha</option><option>Hadir</option>
                </select>
                <button type="submit" class="secondary-btn">Simpan</button>
              </form>
            </td>
          </tr>
          <tr>
            <td>Izumi</td>
            <td>2025-09-09</td>
            <td>
              <form class="inline-form">
                <select>
                  <option>Izin</option><option>Sakit</option><option>Alpha</option><option>Hadir</option>
                </select>
                <button type="submit" class="secondary-btn">Simpan</button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
      <a href="menu.php" class="back-link">&larr; Kembali</a>

    <?php elseif ($page === 'jurnal'): ?>
      <h2 class="title">Jurnal Kegiatan</h2>
      <p class="desc">Catatan kegiatan dan tugas harian siswa.</p>
      <!-- Form input jurnal (client-side demo) -->
      <form id="jurnalForm" style="margin-bottom:14px;display:flex;gap:10px;flex-wrap:wrap;">
        <input name="tanggal" type="date" style="padding:8px;border-radius:6px;border:1px solid #ddd;">
        <input name="kegiatan" placeholder="Deskripsi kegiatan" style="padding:8px;border-radius:6px;border:1px solid #ddd;flex:1;min-width:180px;">
        <button class="primary-btn" type="submit">Tambah</button>
      </form>

      <ul id="jurnalList" class="jurnal-list">
        <li><strong>2025-09-09:</strong> Membuat laporan praktikum seni rupa</li>
        <li><strong>2025-09-08:</strong> Diskusi kelompok tentang teknologi</li>
        <li><strong>2025-09-07:</strong> Presentasi hasil karya seni</li>
      </ul>
      <a href="menu.php" class="back-link">&larr; Kembali</a>
    <?php endif; ?>
  </div>

  <!-- Script JS -->
  <script>
    const logoutBtn = document.getElementById("logoutBtn");
    if (logoutBtn) {
      logoutBtn.addEventListener("click", function(e) {
        if (!confirm("Yakin ingin logout?")) e.preventDefault();
      });
    }
    const absensiForm = document.getElementById("absensiForm");
    if (absensiForm) {
      absensiForm.addEventListener("submit", function(e) {
        e.preventDefault();
        alert("Data absensi berhasil disimpan!");
      });
    }

    // Client-side handling: Tambah Jurnal
    const jurnalForm = document.getElementById('jurnalForm');
    if (jurnalForm) {
      jurnalForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const t = jurnalForm.tanggal.value || new Date().toISOString().slice(0,10);
        const k = jurnalForm.kegiatan.value.trim();
        if (!k) return alert('Isi deskripsi kegiatan');
        const li = document.createElement('li');
        li.innerHTML = `<strong>${t}:</strong> ${escapeHtml(k)}`;
        document.getElementById('jurnalList').prepend(li);
        jurnalForm.kegiatan.value = '';
      });
    }

    // Client-side handling: Tambah SPP
    const sppForm = document.getElementById('sppForm');
    if (sppForm) {
      sppForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const nama = sppForm.nama.value.trim();
        const bulan = sppForm.bulan.value.trim();
        const status = sppForm.status.value;
        if (!nama || !bulan) return alert('Isi nama dan bulan');
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${escapeHtml(nama)}</td><td>${escapeHtml(bulan)}</td><td>${escapeHtml(status)}</td>`;
        document.getElementById('sppTable').querySelector('tbody').appendChild(tr);
        sppForm.nama.value=''; sppForm.bulan.value='';
      });
    }

    // helper escape
    function escapeHtml(str){
      return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
  </script>
</body>
</html>
