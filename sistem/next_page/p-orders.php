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

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#data-tabel').DataTable();
    });
</script>
<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Orders</h1>
    </div>

    <table id="data-tabel" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Incoming Orders</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // include '../toko_online/koneksi/cf.php';
            // untuk pengulangan penomeran
            $no = 1;
            $data = mysqli_query($conn, "SELECT DISTINCT user_id, nama, email, no_hp FROM akun_users WHERE jenis_akun = '1' ");

            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?php echo $d['nama']; ?></td>
                    <td><?php echo $d['email']; ?></td>
                    <td>
                        <?php
                        // include '../toko_online/koneksi/cf.php';

                        // untuk pengulangan penomeran
                        $no = 1;

                        // mengeksekusi perintah SQL
                        $dataPesanan = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_data FROM pesanan WHERE konfirmasi = 'belom' AND email = '$d[email]' ");
                        $dPesanan = mysqli_fetch_assoc($dataPesanan);

                        // menampilkan hasil pada tag div
                        if ($dPesanan['jumlah_data'] > 0) {
                            echo "<p class='text-danger fw-bold'>$dPesanan[jumlah_data] Pending</p>";
                        } else {
                            echo "<p>No order</p>";
                        }
                        ?>

                    </td>
                    <td>
                        <form action="redirect-orders-details" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $d['user_id']; ?>">
                            <input type="hidden" name="nama" value="<?php echo $d['nama']; ?>">
                            <input type="hidden" name="email" value="<?php echo $d['email']; ?>">
                            <input type="hidden" name="no_hp" value="<?php echo $d['no_hp']; ?>">

                            <div class="d-grid gap-2">

                                <button class="btn btn-sm btn-dark" type="submit">Detail</button>
                            </div>

                        </form>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>