<?php
include '../koneksi/cf.php';

$user_id = $_POST['user_id_2'];
$produk_id = $_POST['produk_id_2'];
$jumlah = $_POST['jumlah_2'];
$sisa_stok_produk = $_POST['stok_produk'];

// Check if the product already exists in the cart table
$query_check = "SELECT * FROM cart WHERE produk_id = '$produk_id' AND user_id = '$user_id'";
$result_check = mysqli_query($conn, $query_check);

if (mysqli_num_rows($result_check) > 0) {
    // If the product already exists in the cart table, send an error message and redirect back to the previous page
    session_start();
    $_SESSION["warning"] = '<div class="alert alert-warning"  role="alert" >Produk sudah ada di dalam keranjang.</div>';
    echo "<script type='text/javascript'>
                window.history.back()
          </script>";
    exit;
}

if ($jumlah > $sisa_stok_produk) {
    // If the amount exceeds the remaining stock, send an error message and redirect back to the previous page
    session_start();
    $_SESSION["warning"] = '<div class="alert alert-warning"  role="alert" >Jumlah barang melebihi sisa stok.</div>';
    echo "<script type='text/javascript'>
                window.history.back()
          </script>";
    exit;
}

// Insert data into cart table if the amount is less than or equal to the stock and the product does not exist in the cart table
$query_insert = "INSERT INTO cart (user_id, produk_id, jumlah) VALUES ('$user_id', '$produk_id', '$jumlah')";
$result_insert = mysqli_query($conn, $query_insert);

// Send a success message and redirect back to the previous page
session_start();
$_SESSION["success"] = '<div class="alert alert-success"  role="alert" >Barang berhasil dimasukkan di keranjang.</div>';
echo "<script type='text/javascript'>
        window.history.back()
    </script>";

// Close database connection
mysqli_close($conn);
