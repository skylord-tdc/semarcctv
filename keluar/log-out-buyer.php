<?php
session_start();

if (isset($_SESSION['jenis_akun']) && $_SESSION['jenis_akun'] == 1 && isset($_SESSION['user_id'])) {
    // Jika session jenis_akun bernilai 1 dan user_id telah di-set, maka hapus kedua session tersebut
    unset($_SESSION['jenis_akun']);
    unset($_SESSION['user_id']);
}

// Redirect ke halaman login setelah logout
header("location: login");
exit;
