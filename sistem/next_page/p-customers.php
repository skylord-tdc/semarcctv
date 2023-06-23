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
        <h1 class="h2">Customers</h1>
    </div>

    <div>
        <?php
        if (!empty($_SESSION["success"])) {
            echo $_SESSION["success"];
            unset($_SESSION["success"]);
        }
        ?>
        <?php
        if (!empty($_SESSION["warning"])) {
            echo $_SESSION["warning"];
            unset($_SESSION["warning"]);
        }
        ?>
        <?php

        if (!empty($_SESSION["danger"])) {
            echo $_SESSION["danger"];
            unset($_SESSION["danger"]);
        } ?>
    </div>

    <!-- konten -->
    <div class="table-responsive">
        <table id="data-tabel" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // include '../toko_online/koneksi/cf.php';

                // untuk pengulangan penomeran
                $no = 1;
                $dataPenjualan = mysqli_query($conn, "SELECT user_id, nama, email, no_hp FROM akun_users WHERE jenis_akun = '1' ");

                while ($dPenjualan = mysqli_fetch_array($dataPenjualan)) {
                ?>
                    <tr>
                        <td><?php echo $dPenjualan['nama']; ?></td>
                        <td><?php echo $dPenjualan['email']; ?></td>
                        <td><?php echo $dPenjualan['no_hp']; ?></td>
                        <td>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#pop-up-<?php echo $dPenjualan['user_id']; ?>">
                                    Delete
                                </button>
                            </div>

                            <!-- The Modal pop-up -->
                            <div class="modal" id="pop-up-<?php echo $dPenjualan['user_id']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Warning</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            the account will be deleted if you agree ?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <form action="delete-account" method="get">
                                                <input type="hidden" name="idAccount" value="<?php echo $dPenjualan['user_id']; ?>">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-dark" type="submit">Yes</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>
</div>