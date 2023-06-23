<?php
session_start();

// Cek apakah pengguna sudah login dan jenis_akun nya bernilai
if (isset($_SESSION["user_id"]) && isset($_SESSION["jenis_akun"]) && $_SESSION["jenis_akun"] == 0) {
    // Jika iya, lanjutkan ke halaman yang diinginkan atau stay
} else {
    header("location: login"); // Jika tidak, arahkan pengguna ke halaman login
    exit;
}
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style>
    .invoice-title h2,
    .invoice-title h3 {
        display: inline-block;
    }

    .table>tbody>tr>.no-line {
        border-top: none;
    }

    .table>thead>tr>.no-line {
        border-bottom: none;
    }

    .table>tbody>tr>.thick-line {
        border-top: 2px solid;
    }
</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <!-- <h2>Invoice</h2> -->
                <img src="../../sistem/assets/logo_nota.png" alt="Logo Nota" srcset="" style="width: auto; height: 60px; margin: 6px;">
                <h3 class="pull-right">Invoice</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        <?php echo $_POST['nama_pelanggan']; ?>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Service:</strong><br>
                        <?php echo $_POST['layanan']; ?><br>
                        <?php echo $_POST['alamat_tujuan']; ?>
                    </address>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 text-left">
                    <address>
                        <strong>Payment Method:</strong><br>
                        <?php echo $_POST['pay_method']; ?><br>
                        <?php echo $_POST['user_email']; ?><br>
                        <?php echo $_POST['nohp']; ?>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Date:</strong><br>
                        <?php echo $_POST['tanggal']; ?><br><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed" style="width : 100%;">
                            <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Subtotal</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php
                                include '../../../semarcctv/toko_online/koneksi/cf.php';

                                include 'func_rupiah.php';

                                // untuk pengulangan penomeran
                                $no = 1;
                                $data2 = mysqli_query($conn, "SELECT * FROM pesanan_produk WHERE pesanan_id = '$_POST[id]' ORDER BY `id` DESC ");

                                while ($d2 = mysqli_fetch_array($data2)) {
                                ?>
                                    <tr>
                                        <td><?php echo $d2['nm_produk']; ?></td>
                                        <td class="text-center"><?php echo $d2['jumlah']; ?></td>
                                        <td class="text-right"><?php echo format_rupiah($d2['sub_total']); ?></td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                    <td class="thick-line text-right"><?php echo format_rupiah($_POST['total_bayar']); ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.print({
        orientation: 'landscape'
    });
    window.onafterprint = back;

    function back() {
        window.close();
    }
</script>