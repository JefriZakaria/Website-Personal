<?php
require 'db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_teman']);
    $hobi = trim($_POST['hobi']);
    $kota = trim($_POST['kota_asal']);
    $Motto = trim($_POST['Motto']);
    $fotoName = null;

    // === Upload foto ===
    if (!empty($_FILES['foto']['name'])) {
        $targetDir = 'uploads/';
        $fileName = time() . '_' . basename($_FILES['foto']['name']);
        $targetFile = $targetDir . $fileName;

        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowed)) {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
                $fotoName = $fileName;
            }
        }
    }

    // === Simpan ke database ===
    $stmt = $pdo->prepare("INSERT INTO teman (nama, hobi, kota_asal, Motto, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $hobi, $kota, $Motto, $fotoName]);

    $message = "✅ Data teman berhasil disimpan!";
} else {
    $message = "⚠️ Akses tidak valid.";
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Hasil Input Teman</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    /* === GLOBAL STYLING === */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }

    body {
      background: linear-gradient(160deg, #003d24, #001b10 80%);
      color: #d8ffe3;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      background-attachment: fixed;
      overflow-x: hidden;
      animation: fadeIn 1s ease forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* === CARD WRAPPER === */
    .card {
      background: rgba(0, 40, 20, 0.85);
      border-radius: 14px;
      border: 1px solid rgba(0, 255, 150, 0.25);
      box-shadow: 0 0 15px rgba(0, 255, 120, 0.25);
      padding: 30px 40px;
      text-align: center;
      max-width: 520px;
      width: 100%;
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: scale(1.01);
      box-shadow: 0 0 20px rgba(0, 255, 150, 0.35);
    }

    /* === JUDUL === */
    h1 {
      color: #00ff80;
      font-weight: 700;
      margin-bottom: 20px;
      font-size: 1.9em;
      letter-spacing: 1px;
      text-shadow: 0 0 8px rgba(0, 255, 130, 0.4);
    }

    /* === PESAN === */
    .message {
      background: rgba(0, 255, 130, 0.08);
      border: 1px solid rgba(0, 255, 130, 0.25);
      border-radius: 8px;
      padding: 12px 15px;
      margin: 15px 0 25px;
      color: #aaffcc;
      font-weight: 500;
      box-shadow: 0 0 6px rgba(0, 255, 130, 0.15);
    }

    /* === TEKS & LINK === */
    p {
      font-size: 16px;
      color: #ccffe3;
      margin: 10px 0;
    }

    a {
      display: inline-block;
      text-decoration: none;
      color: #001b10;
      background: #00ff80;
      padding: 10px 16px;
      border-radius: 8px;
      margin: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 0 10px rgba(0, 255, 120, 0.25);
    }

    a:hover {
      background: #00e676;
      transform: scale(1.05);
      box-shadow: 0 0 16px rgba(0, 255, 130, 0.35);
    }

    /* === RESPONSIF === */
    @media (max-width: 480px) {
      .card {
        padding: 25px 20px;
      }
      h1 {
        font-size: 1.6em;
      }
      a {
        padding: 9px 14px;
      }
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>💾 Hasil Input</h1>
    <div class="message"><?= htmlspecialchars($message) ?></div>
    <p>
      <a href="form.php">📝 Isi Lagi</a>
      <a href="read.php">📋 Lihat Data Teman</a>
    </p>
  </div>
</body>
</html>
