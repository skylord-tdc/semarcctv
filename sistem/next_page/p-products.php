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
        <h1 class="h2">Products</h1>
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

    <div class="mb-3"><button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#addproduct">Add Product</button></div>
    <!-- The Modal Add Product -->
    <div class="modal" id="addproduct">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="add-product" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <select name="kategori_produk" class="form-control" required>
                                    <option selected disabled value>Category Product</option>
                                    <option value="cctv outdoor">CCTV Outdoor</option>
                                    <option value="cctv indoor">CCTV Indoor</option>
                                    <option value="accessories">Accessories</option>
                                </select>
                            </div>
                            <div class="col-6 mb-2">
                                <input type="text" class="form-control" placeholder="Enter brand" name="brand" required>
                            </div>

                            <div class="col-12 mb-2">
                                <input type="text" class="form-control" placeholder="Enter name product" name="nm_produk" required>
                            </div>

                            <div class="input-group col-12 mb-2">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="number" class="form-control" placeholder="Enter price product" name="harga" value="10000" required>
                            </div>

                            <div class="col-6 mb-2">
                                <input type="number" class="form-control" placeholder="Enter stock product" name="stok" required>
                            </div>
                            <div class="col-6 mb-2">
                                <input type="file" class="form-control" name="gambar_produk[]" multiple required>
                            </div>

                            <!-- <div class="col-12 mb-2">
                                <input type="text" class="form-control" placeholder="Enter information product" name="ket_produk" required>
                            </div> -->

                            <div class="col-12 mb-2">
                                <textarea name="ket_produk" id="editor" cols="30" rows="10" placeholder="Enter information product"></textarea>
                            </div>
                            <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#editor'), {
                                        toolbar: {
                                            items: [
                                                'heading',
                                                '|',
                                                'bold',
                                                'italic',
                                                'underline',
                                                '|',
                                                'alignment',
                                                'bulletedList',
                                                'numberedList',
                                                '|',
                                                'imageInsert',
                                                'mediaEmbed',
                                                '|',
                                                'undo',
                                                'redo'
                                            ]
                                        },
                                        language: 'en',
                                    })
                                    .then(editor => {
                                        console.log(editor);
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            </script>

                            <div class="col-12 d-grid gap-2">
                                <button type="submit" class="btn btn-dark">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- konten -->
    <div class="table-responsive mb-3">
        <table id="data-tabel" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Name Product</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Stock Product</th>
                    <th>Order Quantity</th>
                    <th>Remaining Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // memberikan nilai default 0 pada $dPenjualan['jumlah_pesanan']
                include './api_sistem/func_rupiah.php';
                // include '../toko_online/koneksi/cf.php';

                // untuk pengulangan penomeran
                $no = 1;
                $dataPenjualan = mysqli_query($conn, "SELECT 
                produk.id, 
                produk.kategori_produk, 
                produk.brand, 
                produk.nm_produk, 
                produk.ket_produk, 
                produk.harga, 
                produk.stok_produk, 
                IFNULL(SUM(pesanan_produk.jumlah), 0) AS jumlah_pesanan, 
                    CASE 
                        WHEN (produk.stok_produk - IFNULL(SUM(pesanan_produk.jumlah), 0)) = 0 THEN 'Empty' 
                        ELSE (produk.stok_produk - IFNULL(SUM(pesanan_produk.jumlah), 0)) 
                    END AS sisa_stok
                FROM produk 
                LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
                GROUP BY produk.id;
                ");

                while ($dPenjualan = mysqli_fetch_array($dataPenjualan)) {
                ?>
                    <tr>
                        <td><?php echo $dPenjualan['brand']; ?></td>
                        <td><?php echo $dPenjualan['nm_produk']; ?></td>
                        <td><?php echo format_rupiah($dPenjualan['harga']); ?></td>
                        <td><?php echo $dPenjualan['kategori_produk']; ?></td>
                        <td><?php echo $dPenjualan['stok_produk']; ?></td>
                        <td><?php echo $dPenjualan['jumlah_pesanan']; ?></td>
                        <td>
                            <?php
                            if (isset($dPenjualan['sisa_stok']) && $dPenjualan['sisa_stok'] != '') {
                                if ($dPenjualan['sisa_stok'] == 'Empty') {
                                    echo "<span style='color:red;'>" . $dPenjualan['sisa_stok'] . "</span>";
                                } else {
                                    echo $dPenjualan['sisa_stok'];
                                }
                            } else {
                                echo "<span style='color:red;'>Empty</span>";
                            }
                            ?>
                        </td>
                        <td>
                            <div class="d-grid gap-2">
                                <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#Details-<?php echo $dPenjualan['id']; ?>">Details</button>
                            </div>

                            <!-- The Modal Details -->
                            <div class="modal" id="Details-<?php echo $dPenjualan['id']; ?>">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Product Description</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <?php echo $dPenjualan['ket_produk']; ?>
                                        </div>

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Product Image</h4>
                                        </div>



                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <?php
                                                    $no = 1;
                                                    $dataImgProduct = mysqli_query($conn, "SELECT * FROM gambar_produk WHERE produk_id = '$dPenjualan[id]' ");
                                                    while ($dImgProduct = mysqli_fetch_array($dataImgProduct)) {
                                                    ?>
                                                        <div class="col-3 d-flex justify-content-center">
                                                            <a href="../../toko_online/uploads/gambar_produk/<?php echo $dImgProduct['nama_gambar']; ?>" target="_blank">
                                                                <div class="skeleton-box" style="height: 70px; width: 70px; background-color: #E0E0E0; border-radius: 4px; animation: skeleton-pulse 1.5s ease-in-out infinite; background-size: cover; background-repeat: no-repeat; background-position: center; background-image: url('../../toko_online/uploads/gambar_produk/<?php echo $dImgProduct['nama_gambar']; ?>')"></div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <form action="delete-product" method="get">
                                                <input type="hidden" name="idProduct" value="<?php echo $dPenjualan['id']; ?>">

                                                <button type="submit" class="btn btn-danger">Delete</button>
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