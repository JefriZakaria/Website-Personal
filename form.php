<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Form Input Teman - Neon Tech</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    /* === RESET & GLOBAL === */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }

    body {
      background: radial-gradient(circle at top left, #00ff9d33, #001f0f 80%), 
                  linear-gradient(135deg, #002a1a, #001109);
      color: #e0ffe8;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 15px;
      background-attachment: fixed;
      overflow-x: hidden;
    }

    /* === NEON EFFECT CONTAINER === */
    .container {
      background: rgba(0, 30, 15, 0.85);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      border: 1px solid rgba(0, 255, 150, 0.4);
      box-shadow: 0 0 20px #00ffb340, 0 0 40px #00ffb320 inset;
      width: 100%;
      max-width: 480px;
      padding: 30px 34px;
      transition: all 0.3s ease;
      animation: fadeIn 1s ease forwards;
    }

    .container:hover {
      box-shadow: 0 0 25px #00ffb360, 0 0 50px #00ffb330 inset;
      transform: scale(1.01);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* === JUDUL === */
    h1 {
      text-align: center;
      color: #00ffae;
      font-size: 1.8em;
      letter-spacing: 1px;
      margin-bottom: 25px;
      text-shadow: 0 0 10px #00ff9d, 0 0 20px #00ffb3;
    }

    /* === LABEL & INPUT === */
    label {
      display: block;
      font-weight: 600;
      color: #d2ffe3;
      margin-top: 14px;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="file"] {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid rgba(0, 255, 160, 0.4);
      background: rgba(0, 40, 25, 0.6);
      color: #aaffcc;
      font-size: 15px;
      outline: none;
      transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="file"]:focus {
      border-color: #00ffae;
      box-shadow: 0 0 8px #00ffae;
      background: rgba(0, 60, 40, 0.8);
      color: #e9fff2;
    }

    /* === TOMBOL === */
    button {
      width: 100%;
      background: linear-gradient(90deg, #00ffae, #00cc66);
      color: #001f0f;
      border: none;
      padding: 12px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 20px;
      transition: all 0.3s ease;
      text-shadow: 0 0 5px #fff;
    }

    button:hover {
      background: linear-gradient(90deg, #00ffa0, #00ff55);
      transform: scale(1.05);
      box-shadow: 0 0 20px #00ff88, 0 0 40px #00ffbb;
    }

    /* === LINK KE DATA === */
    p {
      text-align: center;
      margin-top: 20px;
      font-size: 15px;
    }

    a {
      color: #00ffae;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease, text-shadow 0.3s ease;
    }

    a:hover {
      color: #aaffcc;
      text-shadow: 0 0 10px #00ffae;
    }

    /* === RESPONSIF === */
    @media (max-width: 480px) {
      .container {
        padding: 25px 22px;
      }
      h1 {
        font-size: 1.5em;
      }
    }

  </style>
</head>
<body>
  <div class="container">
    <h1>Form Input Teman</h1>

    <form action="proses.php" method="post" enctype="multipart/form-data">
      <label>Nama Teman:</label>
      <input type="text" name="nama_teman" placeholder="Masukkan nama teman..." required>

      <label>Hobi:</label>
      <input type="text" name="hobi" placeholder="Contoh: Bermain bola, Membaca" required>

      <label>Kota Asal:</label>
      <input type="text" name="kota_asal" placeholder="Masukkan kota asal..." required>

      <label>Motto:</label>
      <input type="text" name="Motto" placeholder="Tulis motto hidup..." required>

      <label>Foto:</label>
      <input type="file" name="foto" accept="image/*" required>

      <button type="submit">Kirim Data</button>
    </form>

    <p>📋 <a href="read.php">Lihat Data Teman</a></p>
  </div>
</body>
</html>
