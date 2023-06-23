<?php
// Koneksi ke database
include '../koneksi/cf.php';

// Mendapatkan data dari form
$pesanan_id = $_POST['pesanan_id'];

// Menambahkan data bukti pembayaran ke tabel 'pesanan'
if ($_FILES['bukti_pembayaran']['error'] == UPLOAD_ERR_OK) {
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    $file_type = $_FILES['bukti_pembayaran']['type'];
    $max_size = 5 * 1024 * 1024; // maksimum ukuran file dalam byte

    // Menambahkan kondisi untuk memeriksa ukuran file
    if (in_array($file_type, $allowed_types) && $_FILES['bukti_pembayaran']['size'] < $max_size) {
        $bukti_pembayaran = uniqid() . '_' . $_FILES['bukti_pembayaran']['name'];
        $tmp_bukti_pembayaran = $_FILES['bukti_pembayaran']['tmp_name'];
        $folder_bukti_pembayaran = "../uploads/bukti_pembayaran/"; // folder tempat menyimpan file bukti pembayaran

        // Memindahkan file bukti pembayaran dari folder sementara ke folder upload
        if (move_uploaded_file($tmp_bukti_pembayaran, $folder_bukti_pembayaran . $bukti_pembayaran)) {
            $query = "UPDATE pesanan SET bukti_pembayaran='$bukti_pembayaran' WHERE id='$pesanan_id'";
            mysqli_query($conn, $query);
        } else {
            // Terjadi kesalahan saat memindahkan file bukti pembayaran
            header("Location: keranjang-belanja?error=upload_gagal");
            exit();
        }
    } else {
        // File bukti pembayaran tidak didukung atau ukuran file melebihi batas
        session_start();
        $_SESSION["warning"] = '<div class="alert alert-warning"  role="alert" >Terjadi kesalahan. File bukan bertipe gambar atau melebihi ukuran dari 4mb.</div>';
        echo
        "<script type='text/javascript'>
             window.history.back()
        </script>";
        exit();
    }
} else {
    // Terjadi kesalahan saat mengupload file bukti pembayaran
    header("Location: keranjang-belanja?error=upload_gagal");
    exit();
}
// Kembali ke halaman sebelumnya atau halaman sukses
session_start();
$_SESSION["success"] = '<div class="alert alert-success"  role="alert" >Berhasil. Tanda bukti pembayaran sudah terkirim, terimakasih.</div>';
echo
"<script type='text/javascript'>
    window.history.back()
</script>";
exit();
