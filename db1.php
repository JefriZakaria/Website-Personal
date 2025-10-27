<?php
// db.php - sesuaikan dengan konfigurasi server kamu
define('DB_HOST', 'localhost');
define('DB_NAME', 'jepp_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // isi password jika ada

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        $options
    );
} catch (PDOException $e) {
    // Bila gagal konek, tampilkan pesan ringkas (jangan tampilkan password dsb)
    die("Koneksi database gagal: " . $e->getMessage());
}
