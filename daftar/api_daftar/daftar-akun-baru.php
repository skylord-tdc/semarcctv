<?php
//koneksi ke database
include '../../toko_online/koneksi/cf.php';

//proses insert data
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['n_phone']) && isset($_POST['pass'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if (strlen($name) > 50) { // batas karakter unik adalah 50
        // echo "Nama terlalu panjang";
        session_start();
        $_SESSION["warning"] = '<div class="alert alert-warning"  role="alert" >Maaf. Nama terlalu panjang.</div>';
        echo
        "<script type='text/javascript'>
            window.history.back()
        </script>";
        exit();
    }
    $name = mysqli_real_escape_string($conn, $name); // hindari serangan SQL Injection
    $name = preg_replace("/[^a-zA-Z0-9 ]+/", "", $name); // hapus karakter yang tidak wajar

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = mysqli_real_escape_string($conn, $email); // hindari serangan SQL Injection
    $email = preg_replace("/[^a-zA-Z0-9.@]+/", "", $email); // hapus karakter yang tidak wajar

    $n_phone = filter_input(INPUT_POST, 'n_phone', FILTER_SANITIZE_NUMBER_INT);
    $n_phone = mysqli_real_escape_string($conn, $n_phone); // hindari serangan SQL Injection
    $n_phone = preg_replace("/[^0-9]+/", "", $n_phone); // hapus karakter yang tidak wajar

    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING); //saring karakter yang tidak diinginkan
    $pass = mysqli_real_escape_string($conn, $pass); // hindari serangan SQL Injection
    $pass = preg_replace("/[^a-zA-Z0-9]+/", "", $pass); // hapus karakter yang tidak wajar
    $pass = password_hash($pass, PASSWORD_DEFAULT); //enkripsi password dengan hash

    //check if email already exists
    $check_email = "SELECT * FROM akun_users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($result) > 0) {
        // echo "Email sudah digunakan";
        session_start();
        $_SESSION["danger"] = '<div class="alert alert-danger"  role="alert" >Gagal. Email sudah digunakan.</div>';
        echo
        "<script type='text/javascript'>
            window.history.back()
        </script>";
    } else {
        $sql = "INSERT INTO akun_users (jenis_akun, nama, email, no_hp, pw) VALUES ('1', '$name', '$email', '$n_phone', '$pass')";
        if (mysqli_query($conn, $sql)) {
            // echo "Data berhasil disimpan";
            session_start();
            $_SESSION["success"] = '<div class="alert alert-success"  role="alert" >Berhasil. Anda sudah terdaftar silahkan login.</div>';
            header("Location: register");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}


//tutup koneksi
mysqli_close($conn);
