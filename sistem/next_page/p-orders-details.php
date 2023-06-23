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
        <h1 class="h2">Orders Details</h1>
    </div>

    <div class="mt-2 mb-2 container shadow-lg p-3 mb-5 bg-light rounded">

        <div class="row p-2">
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 bd-highlight" style="width: 9% ;">Nama</div>
                <div class="p-2 bd-highlight">:</div>
                <div class="p-2 bd-highlight"><?php echo $_GET['nama']; ?></div>
            </div>

            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 bd-highlight" style="width: 9% ;">Email</div>
                <div class="p-2 bd-highlight">:</div>
                <div class="p-2 bd-highlight"><?php echo $_GET['email']; ?></div>
            </div>

            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 bd-highlight" style="width: 9% ;">No HP</div>
                <div class="p-2 bd-highlight">:</div>
                <div class="p-2 bd-highlight"><?php echo $_GET['no_hp']; ?></div>
            </div>
        </div>
        <table id="data-tabel" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Service</th>
                    <th>Bank</th>
                    <th>Address</th>
                    <th>Total Payment</th>
                    <th>Proof of Payment</th>
                    <th>Item</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // include '../toko_online/koneksi/cf.php';
                include 'api_sistem/func_rupiah.php';

                // untuk pengulangan penomeran
                $no = 1;
                $data1 = mysqli_query($conn, "SELECT * FROM pesanan WHERE email = '$_GET[email]' ORDER BY `id` DESC ");

                while ($d1 = mysqli_fetch_array($data1)) {
                ?>
                    <tr>
                        <td><?php echo $d1['tanggal_pemesanan']; ?></td>
                        <td><?php echo $d1['tipe_layanan']; ?></td>
                        <td><?php echo $d1['bank']; ?></td>
                        <td>
                            <?php
                            if ($d1['tipe_layanan'] == "Ambil di Toko") {
                                echo "Pelanggan Tidak Menggunakan Pengiriman";
                            } elseif ($d1['tipe_layanan'] == "Di Antar") {
                                echo $d1['alamat_tujuan'];
                            }
                            ?>
                        </td>
                        <td><?php echo format_rupiah($d1['total_pembayaran']); ?></td>
                        <td>
                            <?php
                            if (is_null($d1['bukti_pembayaran'])) {
                                echo "Belum Memberi Tanda Bukti";
                            } else {
                                // Menampilkan gambar dengan tag HTML img
                                echo "<a href='../toko_online/uploads/bukti_pembayaran/" . $d1['bukti_pembayaran'] . "' target='_blank'><img src='../toko_online/uploads/bukti_pembayaran/" . $d1['bukti_pembayaran'] . "' style='height: 100px ; width: 100px ;'></a>";
                            }
                            ?>
                        </td>
                        <td>
                            <div class="d-grid gap-2">
                                <form action="invoice" target="_blank" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $d1['id']; ?>">
                                    <input type="hidden" name="pay_method" value="<?php echo $d1['bank']; ?>">
                                    <input type="hidden" name="user_email" value="<?php echo $d1['email']; ?>">
                                    <input type="hidden" name="layanan" value="<?php echo $d1['tipe_layanan']; ?>">

                                    <input type="hidden" name="nama_pelanggan" value="<?php echo $_GET['nama']; ?>">
                                    <input type="hidden" name="tanggal" value="<?php echo $d1['tanggal_pemesanan']; ?>">
                                    <input type="hidden" name="total_bayar" value="<?php echo $d1['total_pembayaran']; ?>">

                                    <input type="hidden" name="alamat_tujuan" value="<?php
                                                                                        if ($d1['tipe_layanan'] == "Ambil di Toko") {
                                                                                            echo "";
                                                                                        } elseif ($d1['tipe_layanan'] == "Di Antar") {
                                                                                            echo $d1['alamat_tujuan'];
                                                                                        }
                                                                                        ?>">

                                    <input type="hidden" name="nohp" value="<?php echo $_GET['no_hp']; ?>">

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-sm btn-dark">
                                            Invoice
                                        </button>
                                    </div>
                                </form>



                                <?php
                                if ($d1['konfirmasi'] != "Sudah") {
                                    // hanya menampilkan tombol ACC jika belum dikonfirmasi
                                    // echo '<a class="btn btn-sm btn-secondary" href="confir?id=' . $d1['id'] . '" tarPOST="_blank">Konfirmasi</a>';
                                    echo '
                                    <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#Konfirmasi-pesanan-' . $d1['id'] . '">
                                        Konfirmasi
                                    </button>
                                    </div>
                                    <!-- The Modal Konfirmasi -->
                                    <div class="modal" id="Konfirmasi-pesanan-' . $d1['id'] . '">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirm</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    would you like to confirm the order ?
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <form action="confir" method="post">
                                                        <input type="hidden" name="id" value="' . $d1['id'] . '">
                                                        <input type="hidden" name="nama" value="' . $_GET['nama'] . '">
                                                        <input type="hidden" name="email" value="' . $_GET['email'] . '">
                                                        <input type="hidden" name="no_hp" value="' . $_GET['no_hp'] . '">

                                                        <div class="d-grid gap-2">
                                                            <button type="submit" class="btn btn-dark">Yes</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    ';
                                } else {
                                    // tombol dinonaktifkan jika sudah dikonfirmasi
                                    echo '<button class="btn btn-sm btn-warning" data-bs-toggle="modal" disabled">Dikonfirmasi</button>';
                                }
                                ?>
                            </div>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>