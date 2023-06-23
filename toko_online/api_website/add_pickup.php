<?php
// Koneksi ke database
include '../koneksi/cf.php';

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$query = "SELECT produk.id, produk.nm_produk, produk.stok_produk, IFNULL(SUM(pesanan_produk.jumlah), 0) AS jumlah_pesanan
FROM produk 
LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
LEFT JOIN pesanan ON pesanan.id = pesanan_produk.pesanan_id
WHERE pesanan.status != 'Selesai'
GROUP BY produk.id";
$result = mysqli_query($conn, $query);

$stok_habis = false;
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['jumlah_pesanan'] >= $row['stok_produk']) {
        $stok_habis = true;
        break;
    }
}

if ($stok_habis) {
    // Jika stok habis, lakukan sesuatu, misalnya tampilkan pesan error
    // echo "Maaf, stok produk habis.";
    session_start();
    $_SESSION["danger"] = '<div class="alert alert-danger"  role="alert" >Maaf. Stok barang tersebut sudah habis..</div>';
    header("Location: keranjang-belanja");
} else {
    // Jika masih ada stok, lakukan insert ke tabel 'pesanan' dan 'pesanan_produk'
    // Mendapatkan data dari form
    $nm_pelangan = $_POST['nm_pelangan'];
    $email = $_POST['email'];
    $tipe_layanan = $_POST['tipe_layanan'];
    $bank = $_POST['bank'];
    $no_hp = $_POST['no_hp'];
    $total_pembayaran = $_POST['total_pembayaran'];
    $user_id = $_POST['user_id'];


    setlocale(LC_TIME, 'id_ID');
    $date_now = strftime("%d %B %Y");

    // Menambahkan data ke tabel 'pesanan'
    $query = "INSERT INTO pesanan (nm_pelangan, email, tipe_layanan, bank, no_hp, total_pembayaran, tanggal_pemesanan) VALUES ('$nm_pelangan', '$email', '$tipe_layanan', '$bank', '$no_hp',  '$total_pembayaran', '$date_now') ON DUPLICATE KEY UPDATE nm_pelangan=VALUES(nm_pelangan), email=VALUES(email), tipe_layanan=VALUES(tipe_layanan)";
    mysqli_query($conn, $query);

    // Mendapatkan id pesanan yang baru saja ditambahkan atau diupdate
    $pesanan_id = mysqli_insert_id($conn);

    // Mendapatkan data produk dari form
    $produk_id = $_POST['data']['produk_id'];
    $jumlah = $_POST['data']['jumlah'];
    $nm_produk = $_POST['data']['nm_produk'];
    $sub_total = $_POST['data']['sub_total'];

    // Menambahkan data produk ke tabel 'pesanan_produk' dengan menggunakan id pesanan yang baru saja ditambahkan
    for ($i = 0; $i < count($jumlah); $i++) {
        $query = "INSERT INTO pesanan_produk (pesanan_id, produk_id, nm_produk, jumlah, sub_total) VALUES ('$pesanan_id', '$produk_id[$i]', '$nm_produk[$i]', '$jumlah[$i]', '$sub_total[$i]')";
        mysqli_query($conn, $query);
    }

    //menghapus cart karena sudah ditambahkan pada
    $query = "DELETE FROM cart WHERE user_id = '$user_id'";
    mysqli_query($conn, $query);

    // Kembali ke halaman sebelumnya atau halaman sukses
    header("Location: keranjang-belanja");
    exit();
}
