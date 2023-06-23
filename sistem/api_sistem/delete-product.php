<?php
//koneksi ke database
include '../../../semarcctv/toko_online/koneksi/cf.php';

if (isset($_GET['idProduct'])) {
    $idProduct = $_GET['idProduct'];

    // ambil data gambar_produk berdasarkan id produk
    $sqlGambar = "SELECT * FROM gambar_produk WHERE produk_id = $idProduct";
    $resultGambar = mysqli_query($conn, $sqlGambar);

    while ($row = mysqli_fetch_assoc($resultGambar)) {
        $pathFile = "../../toko_online/uploads/gambar_produk/" . $row['nama_gambar']; // path gambar
        if (file_exists($pathFile)) {
            unlink($pathFile); // hapus file gambar dari lokal drive
        }
    }

    // hapus data produk dari tabel produk
    $sqlProduk = "DELETE FROM produk WHERE id = $idProduct";
    if (mysqli_query($conn, $sqlProduk)) {
        // hapus data gambar_produk dari tabel gambar_produk
        $sqlGambar = "DELETE FROM gambar_produk WHERE produk_id = $idProduct";
        if (mysqli_query($conn, $sqlGambar)) {
            // echo "Data berhasil dihapus";
            header("Location: dashboard?page=products");
        } else {
            echo "Error deleting gambar_produk: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting produk: " . mysqli_error($conn);
    }
}

//menutup koneksi
mysqli_close($conn);
