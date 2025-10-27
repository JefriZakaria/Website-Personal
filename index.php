<?php
require 'db1.php'; // opsional, hanya jika nanti terhubung dengan DB

// === Data pribadi ===
$nama = 'Jefri Zakaria Putra';
$tahun_lahir = 2004;
$nim = '230534604460';
$foto_path = "uploads/{$nim}.jpg";
$kota_asal = 'Tulungagung';
$hobi = 'Berolahraga';
$Motto = 'No Risk No Ferrari';

// Hitung umur
$tahun_sekarang = (int)date('Y');
$umur = $tahun_sekarang - (int)$tahun_lahir;

// Fungsi sapa mahasiswa
function sapaMahasiswa($nama, $nim) {
    return "<strong>Halo, Selamat Datang di Profil Saya!</strong>";
}

// Kategori usia
if ($umur < 20) {
    $kategori = 'Remaja';
} elseif ($umur >= 20 && $umur <= 25) {
    $kategori = 'Dewasa Muda';
} else {
    $kategori = 'Dewasa';
}

// Mata kuliah favorit
$mataKuliah = [
    'Pemrograman Web',
    'Metodologi Penelitian',
    'Sistem Komputasi Cerdas',
    'Statistika',
    'Robotika Industri'
];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Profil Mahasiswa - <?= htmlspecialchars($nama) ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    /* === Tema Futuristik Hijau Neon === */
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      margin: 0;
      padding: 30px;
      display: flex;
      justify-content: center;
      background: radial-gradient(circle at top left, #00ff9d15, #001a0a 70%);
      color: #e0ffe8;
      min-height: 100vh;
      overflow-x: hidden;
    }

    .container {
      width: 100%;
      max-width: 950px;
      backdrop-filter: blur(15px);
      background: rgba(0, 40, 20, 0.65);
      border: 1px solid rgba(0, 255, 128, 0.3);
      border-radius: 16px;
      box-shadow: 0 0 25px rgba(0, 255, 128, 0.25);
      padding: 30px;
      animation: fadeIn 1s ease-out;
    }

    h1 {
      text-align: center;
      font-size: 2em;
      margin-bottom: 25px;
      color: #00ff99;
      text-shadow: 0 0 12px #00ff99;
      letter-spacing: 1px;
    }

    /* === Card === */
    .card {
      background: rgba(0, 20, 10, 0.6);
      border-radius: 12px;
      border: 1px solid rgba(0, 255, 128, 0.2);
      padding: 22px 26px;
      margin-bottom: 22px;
      box-shadow: 0 0 15px rgba(0, 255, 128, 0.05);
      transition: transform 0.3s ease, box-shadow 0.4s ease;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 0 25px rgba(0, 255, 128, 0.25);
    }

    /* === Grid Profil === */
    .grid {
      display: flex;
      flex-wrap: wrap;
      gap: 24px;
      align-items: flex-start;
    }

    img.profile {
      width: 180px;
      height: 220px;
      object-fit: cover;
      border-radius: 10px;
      border: 2px solid #00ff99;
      box-shadow: 0 0 15px rgba(0, 255, 128, 0.3);
    }

    .nofoto {
      width: 180px;
      height: 220px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.05);
      color: #ccc;
      border: 1px dashed #00ff99;
      text-align: center;
    }

    /* === Teks === */
    p { margin: 6px 0; font-size: 15px; }
    strong { color: #00ffb3; }

    /* === List === */
    ol li {
      margin: 6px 0;
      color: #e0ffe8;
    }

    /* === Tombol === */
    .buttons {
      margin-top: 18px;
    }

    a.btn {
      display: inline-block;
      padding: 10px 18px;
      border-radius: 8px;
      text-decoration: none;
      color: #001a0a;
      font-weight: 600;
      margin-right: 12px;
      background: #00ff99;
      box-shadow: 0 0 12px rgba(0, 255, 128, 0.5);
      transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    }

    a.btn:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px rgba(0, 255, 128, 0.9);
      background: #00ffaa;
    }

    /* === Responsif === */
    @media (max-width: 650px) {
      .grid { flex-direction: column; align-items: center; }
      .grid img, .grid .nofoto { width: 140px; height: 180px; }
      h1 { font-size: 1.6em; }
    }

    /* === Animasi === */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Profil Mahasiswa</h1>

    <div class="card grid">
      <div>
        <?php if (file_exists($foto_path)): ?>
          <img class="profile" src="<?= htmlspecialchars($foto_path) ?>" alt="Foto <?= htmlspecialchars($nama) ?>">
        <?php else: ?>
          <div class="nofoto">
            Foto (<?= htmlspecialchars($nim) ?>).jpg<br>tidak ditemukan
          </div>
        <?php endif; ?>
      </div>
      <div>
        <p><?= sapaMahasiswa($nama, $nim) ?></p>
        <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
        <p><strong>NIM:</strong> <?= htmlspecialchars($nim) ?></p>
        <p><strong>Tahun Lahir:</strong> <?= htmlspecialchars($tahun_lahir) ?></p>
        <p><strong>Umur:</strong> <?= $umur ?> tahun <em>(<?= $kategori ?>)</em></p>
        <p><strong>Kota Asal:</strong> <?= htmlspecialchars($kota_asal) ?></p>
        <p><strong>Hobi:</strong> <?= htmlspecialchars($hobi) ?></p>
        <p><strong>Motto:</strong> <em>"<?= htmlspecialchars($Motto) ?>"</em></p>
      </div>
    </div>

    <div class="card">
      <h3>📘 Mata Kuliah Favorit</h3>
      <ol>
        <?php foreach ($mataKuliah as $mk): ?>
          <li><?= htmlspecialchars($mk) ?></li>
        <?php endforeach; ?>
      </ol>
    </div>

    <div class="card">
      <h3>🔤 Perulangan Huruf A - J</h3>
      <p>
        <?php
          $huruf = 'A';
          $count = 0;
          while ($count < 10) {
              echo $huruf;
              if ($count < 9) echo ', ';
              $huruf++;
              $count++;
          }
        ?>
      </p>
    </div>

    <div class="card">
      <h3>🔢 Perulangan Angka 1 - 10</h3>
      <p>
        <?php
          for ($i = 1; $i <= 10; $i++) {
              echo $i;
              if ($i < 10) echo ', ';
          }
        ?>
      </p>
    </div>

    <div class="card">
      <h3>⚙️ Menu Aksi</h3>
      <div class="buttons">
        <a href="form.php" class="btn">📝 Isi Data Teman</a>
        <a href="read.php" class="btn">📋 Lihat Semua Data Mahasiswa</a>
      </div>
    </div>
  </div>
</body>
</html>
