<?php
include 'koneksi/cf.php';
$dataPenjualan = mysqli_query($conn, "SELECT produk.id, produk.kategori_produk, produk.brand, produk.nm_produk, produk.ket_produk, produk.harga, produk.stok_produk, 
IFNULL(SUM(pesanan_produk.jumlah),0) AS jumlah_pesanan, 
IFNULL((produk.stok_produk - SUM(pesanan_produk.jumlah)),0) AS sisa_stok
FROM produk 
LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
GROUP BY produk.id 
HAVING sisa_stok > 0
ORDER BY jumlah_pesanan DESC"); // mengurutkan data berdasarkan jumlah pesanan dalam urutan menurun (descending)

while ($row = mysqli_fetch_array($dataPenjualan)) {
    // menampilkan data produk
    echo "ID: " . $row['id'] . "<br>";
    echo "Kategori Produk: " . $row['kategori_produk'] . "<br>";
    echo "Brand: " . $row['brand'] . "<br>";
    echo "Nama Produk: " . $row['nm_produk'] . "<br>";
    echo "Keterangan Produk: " . $row['ket_produk'] . "<br>";
    echo "Harga: " . $row['harga'] . "<br>";
    echo "Stok Produk: " . $row['stok_produk'] . "<br>";
    echo "Jumlah Pesanan: " . $row['jumlah_pesanan'] . "<br>";
    echo "Sisa Stok: " . $row['sisa_stok'] . "<br>";
    if ($row['jumlah_pesanan'] > 0) {
        echo "Best Seller"; // menampilkan label "Best Seller" jika produk terjual terbanyak
    }
    echo "<hr>"; // garis pembatas antar data produk
}
