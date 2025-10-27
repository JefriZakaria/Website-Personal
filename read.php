<?php
require 'db1.php';

// Ambil semua data teman dari database
$stmt = $pdo->query("SELECT * FROM teman ORDER BY created_at DESC");
$rows = $stmt->fetchAll();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Daftar Teman</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

    /* === GLOBAL === */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Orbitron', sans-serif;
      background: linear-gradient(135deg, #002a14, #001a0a 70%);
      color: #d8ffd8;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
      min-height: 100vh;
    }

    h1 {
      background: #00cc66;
      color: #001f0d;
      font-weight: 900;
      text-align: center;
      font-size: 2.3em;
      padding: 12px 30px;
      border-radius: 10px;
      letter-spacing: 2px;
      box-shadow: 0 0 15px rgba(0, 255, 150, 0.3);
      margin-bottom: 35px;
    }

    /* === CONTAINER === */
    .container {
      width: 100%;
      max-width: 850px;
      background: rgba(0, 40, 20, 0.9);
      border: 2px solid #00cc66;
      border-radius: 15px;
      box-shadow: 0 0 25px rgba(0, 255, 140, 0.2);
      padding: 25px;
      backdrop-filter: blur(6px);
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* === ITEM === */
    .item {
      display: flex;
      gap: 18px;
      align-items: flex-start;
      background: rgba(0, 30, 10, 0.85);
      border: 1px solid rgba(0, 255, 120, 0.3);
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 16px;
      transition: all 0.3s ease;
    }

    .item:hover {
      background: rgba(0, 40, 15, 0.95);
      transform: translateY(-2px);
      box-shadow: 0 0 15px rgba(0, 255, 130, 0.25);
    }

    img {
      width: 100px;
      height: 120px;
      object-fit: cover;
      border-radius: 8px;
      border: 2px solid #00cc66;
    }

    .no-photo {
      width: 100px;
      height: 120px;
      border-radius: 8px;
      border: 2px solid #00cc66;
      background: rgba(0, 60, 25, 0.7);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #00ff88;
      font-size: 0.9em;
    }

    p {
      margin: 5px 0;
      font-size: 0.95em;
      line-height: 1.4;
    }

    strong {
      color: #00ff99;
    }

    small {
      color: #aaffcc;
      font-size: 0.8em;
    }

    /* === BUTTONS === */
    a.button {
      display: inline-block;
      padding: 10px 18px;
      background: #00cc66;
      color: #001a0a;
      text-decoration: none;
      font-weight: bold;
      border-radius: 8px;
      margin: 6px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    a.button:hover {
      background: #00e676;
      box-shadow: 0 0 15px rgba(0, 255, 120, 0.3);
      transform: scale(1.03);
    }

    .footer-buttons {
      text-align: center;
      margin-top: 25px;
    }

    hr {
      border: none;
      border-top: 1px solid rgba(0, 255, 130, 0.3);
      margin: 25px auto;
      width: 85%;
    }

    /* === RESPONSIVE === */
    @media (max-width: 600px) {
      .item {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      img, .no-photo {
        width: 80px;
        height: 100px;
      }
    }
  </style>
</head>
<body>
  <h1>DAFTAR TEMAN</h1>

  <div class="container">
    <?php if (empty($rows)): ?>
      <p style="text-align:center;">Belum ada data teman. Yuk tambahkan sekarang!</p>
      <div class="footer-buttons">
        <a href="form.php" class="button">➕ Tambah Data</a>
        <a href="index.php" class="button">🏠 Kembali ke Profil</a>
      </div>
    <?php else: ?>
      <?php foreach ($rows as $r): ?>
        <div class="item">
          <div>
            <?php
              $p = 'uploads/' . $r['foto'];
              if (!empty($r['foto']) && file_exists($p)) {
                  echo '<img src="'.htmlspecialchars($p).'" alt="Foto">';
              } else {
                  echo '<div class="no-photo">No Photo</div>';
              }
            ?>
          </div>
          <div>
            <p><strong>Nama:</strong> <?= htmlspecialchars($r['nama']) ?></p>
            <p><strong>Hobi:</strong> <?= htmlspecialchars($r['hobi']) ?></p>
            <p><strong>Kota Asal:</strong> <?= htmlspecialchars($r['kota_asal']) ?></p>
            <p><strong>Motto:</strong> <?= htmlspecialchars($r['motto']) ?></p>
            <p><small>🕓 Terdaftar: <?= htmlspecialchars($r['created_at']) ?></small></p>
          </div>
        </div>
      <?php endforeach; ?>

      <hr>
      <div class="footer-buttons">
        <a href="form.php" class="button">➕ Tambah Teman Lagi</a>
        <a href="index.php" class="button">🏠 Kembali ke Profil</a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
