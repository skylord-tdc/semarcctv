<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'semarcctv';
$conn = mysqli_connect($host, $user, $pass, $db);

// Query untuk mengambil data produk beserta jumlah pesanan
$query = "SELECT produk.id, produk.nm_produk, produk.stok_produk, SUM(pesanan_produk.jumlah) AS jumlah_pesanan
          FROM produk 
          LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
          GROUP BY produk.id";

$result = mysqli_query($conn, $query);

// Looping untuk menampilkan data produk dan cek ketersediaan stok
while ($row = mysqli_fetch_assoc($result)) {
    // Cek ketersediaan stok
    if ($row['stok_produk'] > $row['jumlah_pesanan']) {
        // Jika stok masih tersedia
        echo "Produk " . $row['nm_produk'] . " tersedia dengan stok " . $row['stok_produk'] . "<br>";
    } else {
        // Jika stok habis
        echo "Produk " . $row['nm_produk'] . " habis<br>";
    }
}
