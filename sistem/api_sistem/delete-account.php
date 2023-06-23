<?php
// mengambil koneksi database
include '../../../semarcctv/toko_online/koneksi/cf.php';

// memeriksa apakah form telah dikirimkan
if (isset($_GET['idAccount'])) {
    // mengambil ID akun dari form
    $idAccount = $_GET['idAccount'];

    // menyiapkan query untuk menghapus akun dari database
    $query = "DELETE FROM akun_users WHERE user_id = $idAccount AND jenis_akun = '1' ";

    // mengeksekusi query untuk menghapus akun
    if (mysqli_query($conn, $query)) {
        // mengalihkan pengguna ke halaman sukses setelah menghapus akun
        header("Location: dashboard?page=customers");
        exit();
    } else {
        // menampilkan pesan kesalahan jika query gagal dieksekusi
        echo "Error: " . mysqli_error($conn);
    }
}

// menutup koneksi database
mysqli_close($conn);
