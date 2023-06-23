<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["data"])) {

    include '../koneksi/pdo.php';

    // Mengambil data dari formulir
    $user_id = $_GET["data"]["user_id"][0];
    $produk_id = $_GET["data"]["produk_id"][0];
    $jumlah = $_GET["data"]["jumlah"][0];
    $nm_produk = $_GET["data"]["nm_produk"][0];

    // Mengambil data stok produk
    $sql_produk = "SELECT stok_produk FROM produk WHERE id=:produk_id";
    $stmt_produk = $pdo->prepare($sql_produk);
    $stmt_produk->bindParam(':produk_id', $produk_id, PDO::PARAM_INT);
    $stmt_produk->execute();
    $stok_produk = $stmt_produk->fetchColumn();

    if ($jumlah != 0 && $jumlah <= $stok_produk) {
        // Membuat pernyataan SQL untuk mengupdate data
        $sql = "UPDATE cart SET jumlah=:jumlah WHERE user_id=:user_id AND produk_id=:produk_id";

        // Memperbarui data ke database
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':jumlah', $jumlah, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':produk_id', $produk_id, PDO::PARAM_INT);
        $stmt->execute();

        // Menampilkan pesan berhasil atau gagal
        if ($stmt->rowCount() > 0) {
            // echo "Data berhasil diperbarui.";
            // header("Location: keranjang-belanja#$nm_produk");
            echo "<script type='text/javascript'>
                        window.history.back()
                  </script>";
        } else {
            echo "Data gagal diperbarui.";
        }
    } else {
        // echo "Jumlah tidak boleh 0 atau melebihi stok produk.";
        header("Location: keranjang-belanja?gagal=jumlah_barang_tidak_boleh_0_dan_melebihi_stok");
    }
}
