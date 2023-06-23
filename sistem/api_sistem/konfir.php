<?php
// membuat koneksi ke database
include '../../../semarcctv/toko_online/koneksi/cf.php';

// ambil data dari form
$id = $_POST['id'];
$user_id = $_POST['user_id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

// buat perintah SQL untuk update data
$sql = "UPDATE pesanan SET konfirmasi='Sudah' WHERE id=$id";

// jalankan perintah SQL
if (mysqli_query($conn, $sql)) {
    // echo "Data berhasil diupdate";
    // echo "<script>window.close();</script>";
    header("Location: dashboard?page=orders-details&nama=$nama&email=$email&no_hp=$no_hp&user_id=$user_id");
    exit();
} else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
}

// tutup koneksi ke database
mysqli_close($conn);
