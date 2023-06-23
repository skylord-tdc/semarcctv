<?php 
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'semarcctv';
$conn = mysqli_connect($host, $user, $pass, $db);

// Query untuk mengambil data produk dan pesanan
$query = "SELECT produk.id, produk.nm_produk, produk.stok_produk, SUM(pesanan_produk.jumlah) AS jumlah_pesanan,
          (produk.stok_produk - SUM(pesanan_produk.jumlah)) AS sisa_stok
          FROM produk 
          LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
          GROUP BY produk.id";
$result = mysqli_query($conn, $query);

// Tampilkan data dalam tabel
echo '<table border="1">';
echo '<tr><th>ID Produk</th><th>Nama Produk</th><th>Stok Produk</th><th>Jumlah Pesanan</th><th>Sisa Stok</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {

    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['nm_produk'] . '</td>';
    echo '<td>' . $row['stok_produk'] . '</td>';
    echo '<td>' . $row['jumlah_pesanan'] . '</td>';
    echo '<td>' . $row['sisa_stok'] . '</td>';
    echo '</tr>';
}
echo '</table>';

// Tutup koneksi
mysqli_close($conn);
