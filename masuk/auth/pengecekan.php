<?php
include '../toko_online/koneksi/cf.php';

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pw = mysqli_real_escape_string($conn, $_POST['pass']);

    $q = mysqli_query($conn, "SELECT * FROM akun_users WHERE email = '$email'");
    if ($q->num_rows > 0) {
        $d = $q->fetch_assoc();
        if (password_verify($pw, $d['pw'])) {
            // Password cocok
            session_start();
            $_SESSION['jenis_akun'] = $d['jenis_akun'];
            $_SESSION['user_id'] = $d['user_id'];
            $_SESSION['nama'] = $d['nama'];
            $_SESSION['email'] = $d['email'];
            $_SESSION['no_hp'] = $d['no_hp'];
            if ($_SESSION['jenis_akun'] == 0) {
                header('Location: dashboard');
            } else if ($_SESSION['jenis_akun'] == 1) {
                header('Location: belanja');
            }
        } else {
            // Password salah
            // session_start();
            $_SESSION['pesan'] = "Password anda salah";
        }
    } else {
        // Pengguna tidak ditemukan
        // session_start();
        $_SESSION['pesan'] = "Pengguna tidak ditemukan";
    }
}
