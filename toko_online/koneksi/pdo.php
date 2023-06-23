<?php 
// Konfigurasi database
$host = 'localhost';
$dbname = 'semarcctv';
$user = 'root';
$pass = '';

// Membuat koneksi ke database menggunakan PDO
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Koneksi ke database gagal: " . $e->getMessage();
  exit();
}
