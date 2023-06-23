<?php

include '../koneksi/cf.php';

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Memeriksa apakah form telah disubmit
if (isset($_GET["user_id"]) && isset($_GET["produk_id"])) {

    // Mengambil nilai dari form
    $user_id = $_GET["user_id"];
    $produk_id = $_GET["produk_id"];

    // Membuat perintah SQL untuk menghapus data
    $sql = "DELETE FROM cart WHERE user_id = $user_id AND produk_id = $produk_id";

    // Mengeksekusi perintah SQL dan memeriksa keberhasilan
    if (mysqli_query($conn, $sql)) {
        // echo "Data berhasil dihapus.";
        echo
        "<script type='text/javascript'>
             window.history.back()
        </script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
}

// Menutup koneksi ke database
mysqli_close($conn);
