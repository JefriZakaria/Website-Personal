<?php
require 'db1.php'; // pastikan koneksi PDO benar

$message = '';
$upload_dir = 'uploads/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $kota_asal = trim($_POST['kota_asal']);
    $motto = trim($_POST['Motto']);

    if ($nama === '' || $nim === '' || $kota_asal === '' || $motto === '') {
        $message = "❌ Semua field wajib diisi!";
    } elseif (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        $message = "❌ Harap pilih foto teman (jpg/png).";
    } else {
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $foto_nama = $nim . '.' . $ext;
        $foto_path = $upload_dir . $foto_nama;

        $allowed = ['jpg', 'jpeg', 'png'];
        if (!in_array($ext, $allowed)) {
            $message = "❌ Format file harus JPG atau PNG!";
        } else {
            if (move_uploaded_file($foto_tmp, $foto_path)) {
                $stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM mahasiswa WHERE nim = ?");
                $stmt->execute([$nim]);
                $row = $stmt->fetch();

                if ($row && $row['cnt'] > 0) {
                    $message = "⚠️ Data dengan NIM $nim sudah ada di database.";
                } else {
                    $ins = $pdo->prepare("INSERT INTO mahasiswa (nama, nim, kota_asal, foto, motto) VALUES (?, ?, ?, ?, ?)");
                    try {
                        $ins->execute([$nama, $nim, $kota_asal, $foto_nama, $motto]);
                        $message = "✅ Data teman berhasil disimpan: $nama ($nim)";
                    } catch (PDOException $e) {
                        $message = "❌ Gagal menyimpan ke database: " . $e->getMessage();
                    }
                }
            } else {
                $message = "❌ Gagal mengunggah foto.";
            }
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Form Input Teman</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

    body {
      font-family: 'Orbitron', sans-serif;
      background: radial-gradient(circle at top, #00ff88, #001f0a 70%);
      color: #eaffea;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      min-height: 100vh;
      margin: 0;
      padding: 30px;
      text-shadow: 0 0 8px #00ff88;
    }

    h1 {
      color: #00ff88;
      text-align: center;
      font-size: 2em;
      text-shadow: 0 0 15px #00ff88;
      margin-bottom: 20px;
    }

    form {
      background: rgba(0, 50, 20, 0.9);
      border: 2px solid #00ff88;
      border-radius: 15px;
      padding: 25px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 0 30px #00ff88;
      backdrop-filter: blur(5px);
    }

    label {
      display: block;
      margin-top: 15px;
      color: #c8ffc8;
      font-size: 0.95em;
    }

    input[type="text"],
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      border: none;
      border-radius: 8px;
      background: #002d15;
      color: #00ff88;
      font-size: 1em;
      box-shadow: 0 0 8px #00ff88 inset;
      outline: none;
    }

    input:focus {
      box-shadow: 0 0 12px #00ffaa inset;
    }

    button {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: #00ff88;
      color: #001a09;
      font-weight: bold;
      font-size: 1em;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-transform: uppercase;
      transition: all 0.3s ease;
      box-shadow: 0 0 15px #00ff88;
    }

    button:hover {
      background: #00ffaa;
      box-shadow: 0 0 25px #00ffaa;
    }

    .msg {
      margin-top: 20px;
      padding: 12px;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
      max-width: 500px;
    }

    .success {
      background: rgba(0, 255, 136, 0.15);
      border: 1px solid #00ff88;
      box-shadow: 0 0 12px #00ff88;
    }

    .error {
      background: rgba(255, 0, 80, 0.15);
      border: 1px solid #ff0040;
      box-shadow: 0 0 12px #ff0040;
    }

    a {
      color: #00ff88;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }

    a:hover {
      color: #00ffaa;
      text-shadow: 0 0 10px #00ffaa;
    }

    .links {
      margin-top: 25px;
      text-align: center;
    }
  </style>
</head>
<body>
  <h1>✨ Form Tambah Data Teman ✨</h1>

  <?php if($message): ?>
    <div class="msg <?= str_starts_with($message,'✅') || str_starts_with($message,'⚠️') ? 'success' : 'error' ?>">
      <?= htmlspecialchars($message) ?>
    </div>
  <?php endif; ?>

  <form action="" method="post" enctype="multipart/form-data">
    <label>Nama Teman:
      <input type="text" name="nama" required>
    </label>

    <label>NIM:
      <input type="text" name="nim" required>
    </label>

    <label>Kota Asal:
      <input type="text" name="kota_asal" required>
    </label>

    <label>Motto:
      <input type="text" name="Motto" required>
    </label>

    <label>Foto Teman (JPG/PNG):
      <input type="file" name="foto" accept=".jpg,.jpeg,.png" required>
    </label>

    <button type="submit">💾 Simpan Data</button>
  </form>

  <div class="links">
    <p><a href="read.php">📋 Lihat Semua Mahasiswa</a> | <a href="index.php">🏠 Kembali ke Profil</a></p>
  </div>
</body>
</html>
