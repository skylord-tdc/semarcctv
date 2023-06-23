<?php
// session_start();

// Cek apakah pengguna sudah login dan jenis_akun nya bernilai
if (isset($_SESSION["user_id"]) && isset($_SESSION["jenis_akun"]) && $_SESSION["jenis_akun"] == 0) {
    // Jika iya, lanjutkan ke halaman yang diinginkan atau stay
} else {
    header("location: login"); // Jika tidak, arahkan pengguna ke halaman login
    exit;
}
?>

<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card text-light bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header text-center"><span data-feather="shopping-cart"></span> Order Not Yet Confirmed</div>
                <div class="card-body">
                    <?php
                    // include '../toko_online/koneksi/cf.php';

                    // mengeksekusi perintah SQL
                    $sql = "SELECT COUNT(*) AS jumlah_data FROM pesanan WHERE konfirmasi = 'belom'";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_assoc($result);
                    $jumlah_data = $data['jumlah_data'];

                    // menampilkan hasil pada tag div
                    echo "<div class='h1 text-center'>$jumlah_data</div>";
                    ?>
                    <!-- <h6 class="card-title">Warning card title</h6> -->
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-light bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header text-center"><span data-feather="users"></span> Total Users</div>
                <div class="card-body">
                    <?php
                    // include '../toko_online/koneksi/cf.php';

                    // mengeksekusi perintah SQL
                    $sql = "SELECT COUNT(*) AS jumlah_data FROM akun_users WHERE jenis_akun = '1'";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_assoc($result);
                    $jumlah_data = $data['jumlah_data'];

                    // menampilkan hasil pada tag div
                    echo "<div class='h1 text-center'>$jumlah_data</div>";
                    ?>
                    <!-- <h6 class="card-title">Warning card title</h6> -->
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-light bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header text-center"><span data-feather="archive"></span> Total Products</div>
                <div class="card-body">
                    <?php
                    // include '../toko_online/koneksi/cf.php';

                    // mengeksekusi perintah SQL
                    $sql = "SELECT COUNT(*) AS jumlah_data FROM produk ";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_assoc($result);
                    $jumlah_data = $data['jumlah_data'];

                    // menampilkan hasil pada tag div
                    echo "<div class='h1 text-center'>$jumlah_data</div>";
                    ?>
                    <!-- <h6 class="card-title">Warning card title</h6> -->
                </div>
            </div>
        </div>
    </div>
</div>