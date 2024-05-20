<?php
session_start();

// Cek apakah pengguna sudah login dan jenis_akun nya bernilai
if (isset($_SESSION["user_id"]) && isset($_SESSION["jenis_akun"]) && $_SESSION["jenis_akun"] == 1) {
  // Jika iya, lanjutkan ke halaman yang diinginkan atau stay
} else {
  header("location: login"); // Jika tidak, arahkan pengguna ke halaman login
  exit;
}

$user_id = $_SESSION['user_id'];

// error_reporting(error_reporting() & ~E_NOTICE);

include 'api_website/func_rupiah.php';


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Toko | Semar CCTV Semarang</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <meta http-equiv="refresh" content="140">

  <!-- file css -->
  <!-- boostrap 4 -->
  <link rel="stylesheet" href="toko_online/vendor/boostrap/css/bootstrap.min.css">

  <!-- gLightbox gallery-->
  <link rel="stylesheet" href="toko_online/vendor/glightbox/css/glightbox.min.css">
  <!-- Range slider-->
  <link rel="stylesheet" href="toko_online/vendor/nouislider/nouislider.min.css">
  <!-- Choices CSS-->
  <link rel="stylesheet" href="toko_online/vendor/choices.js/public/assets/styles/choices.min.css">
  <!-- Swiper slider-->
  <link rel="stylesheet" href="toko_online/vendor/swiper/swiper-bundle.min.css">
  <!-- Google fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="toko_online/css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="toko_online/css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="toko_online/img/favicon.png">

</head>

<body>
  <div class="page-holder">
    <!-- navbar-->
    <?php include 'source/navbar_belanja.php'; ?>


    <div class="container">
      <!-- HERO SECTION-->
      <section class="py-5 bg-light">
        <div class="container">
          <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
              <h1 class="h2 text-uppercase mb-0">Keranjang</h1>
            </div>
            <div class="col-lg-6 text-lg-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                  <li class="breadcrumb-item"><a class="text-dark" href="beranda">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section id="quantity" class="py-5">
        <h2 class="h5 text-uppercase mb-4">keranjang belanja</h2>
        <div class="row">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <!-- CART TABLE-->
            <div class="table-responsive mb-4">
              <table class="table text-nowrap">
                <thead class="bg-light">
                  <tr>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Product</strong></th>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Price</strong></th>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Quantity</strong></th>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Total</strong></th>
                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong></th>
                  </tr>
                </thead>
                <tbody class="border-0">

                  <?php
                  $data = mysqli_query($conn, "SELECT DISTINCT cart.id, cart.user_id, cart.produk_id, cart.jumlah, produk.slug, produk.id, produk.nm_produk, produk.harga
                  FROM cart
                  JOIN produk ON cart.produk_id = produk.id
                  WHERE cart.user_id = '$user_id'
                  ORDER BY cart.id DESC;");

                  if (mysqli_num_rows($data) > 0) {
                    while ($d = mysqli_fetch_array($data)) {
                  ?>

                      <tr>
                        <th class="ps-0 py-3 border-light" scope="row">
                          <div class="d-flex align-items-center">
                            <a class="reset-anchor d-block animsition-link" href="<?php echo $d['slug']; ?>">
                              <?php
                              // include 'koneksi/cf.php';

                              // untuk pengulangan penomeran
                              $no = 1;
                              $dataImgDetail = mysqli_query($conn, "SELECT * FROM `gambar_produk` WHERE produk_id = $d[id] LIMIT 1 OFFSET 0; ");

                              while ($dImgDetail = mysqli_fetch_array($dataImgDetail)) {
                              ?>
                                <img src="toko_online/uploads/gambar_produk/<?php echo $dImgDetail['nama_gambar']; ?>" alt="<?php echo $dImgDetail['nama_gambar']; ?>" width="70" />
                              <?php } ?>
                            </a>
                            <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link" href="<?php echo $d['slug']; ?>"><?php echo $d['nm_produk']; ?></a></strong></div>
                          </div>
                        </th>
                        <td class="p-3 align-middle border-light">
                          <p class="mb-0 small"><?php echo format_rupiah($d['harga']); ?></p>
                        </td>
                        <td class="p-3 align-middle border-light">
                          <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Jumlah</span>

                            <form action="update-cart" method="get">
                              <input type="hidden" name="data[user_id][]" value="<?php echo $d["user_id"]; ?>">
                              <input type="hidden" name="data[produk_id][]" value="<?php echo $d["produk_id"]; ?>">
                              <input type="hidden" name="data[nm_produk][]" value="<?php echo $d["nm_produk"]; ?>">

                              <div class="quantity" id="<?php echo $d["nm_produk"]; ?>">
                                <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                <input class="form-control form-control-sm border-0 shadow-0 p-0" type="text" name="data[jumlah][]" value="<?php echo $d["jumlah"]; ?>" />
                                <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                              </div>
                            </form>

                          </div>
                        </td>
                        <td class="p-3 align-middle border-light">
                          <p class="mb-0 small"><?php echo format_rupiah($total_produk_ini = ($d['jumlah'] * $d['harga'])); ?></p>
                        </td>
                        <td class="p-3 align-middle border-light">


                          <a class="reset-anchor" href="hapus-cart/<?php echo $d["user_id"]; ?>/<?php echo $d["produk_id"]; ?>"><i class="fas fa-trash-alt small text-muted"></i></a>

                        </td>
                      </tr>

                  <?php
                    }
                  } else {
                    // echo "Tidak ada data yang tersedia.";
                  }
                  ?>


                </tbody>

              </table>
            </div>
            <!-- CART NAV-->
            <div class="bg-light px-4 py-3">
              <div class="row align-items-center text-center">
                <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm" href="belanja"><i class="fas fa-long-arrow-alt-left me-2"> </i>Lanjutkan belanja</a></div>
                <div class="col-md-6 text-md-end">
                  <form action="konfirmasi-pesanan" method="post" autocomplete="off">
                    <?php
                    // Koneksi ke database
                    // include 'koneksi/cf.php';
                    // include 'api_website/func_rupiah.php';

                    // Inisialisasi variabel total keseluruhan
                    $total_semua = 0;
                    $total_keseluruhan = 0;

                    $data = mysqli_query($conn, "SELECT DISTINCT cart.user_id, cart.produk_id, cart.jumlah, produk.slug, produk.id, produk.nm_produk, produk.harga
                    FROM cart
                    JOIN produk ON cart.produk_id = produk.id
                    WHERE cart.user_id = '$user_id';
                    ");

                    while ($d = mysqli_fetch_array($data)) {
                      $total_produk_ini = ($d['jumlah'] * $d['harga']);
                      // echo $d['nm_produk'] . format_rupiah($total_produk_ini);
                      $sub_total = format_rupiah($total_produk_ini);
                      echo "<input type='hidden' name='data[jumlah][]' value='$d[jumlah]'>";
                      echo "<input type='hidden' name='data[nm_produk][]' value='$d[nm_produk]'>";
                      echo "<input type='hidden' name='data[sub_total][]' value='$sub_total'>";


                      // Tambahkan nilai $total_produk_ini ke $total_keseluruhan
                      $total_keseluruhan += $total_produk_ini;
                      $total_semua = format_rupiah($total_keseluruhan);
                    }

                    // Tampilkan nilai total keseluruhan
                    // echo 'Total Keseluruhan: ' . format_rupiah($total_keseluruhan);
                    echo "<input type='hidden' name='data[total][]' value='$total_semua'>";

                    ?>

                    <button class="btn btn-outline-dark btn-sm">Lanjutkan ke pemesanan<i class="fas fa-long-arrow-alt-right ms-2"></i></button>
                  </form>
                  <!-- <a class="btn btn-outline-dark btn-sm" href="konfirmasi-pembayaran">Lanjutkan ke pembayaran<i class="fas fa-long-arrow-alt-right ms-2"></i></a> -->
                </div>
              </div>
            </div>
          </div>
          <!-- ORDER TOTAL-->
          <div class="col-lg-4">
            <div class="card border-0 rounded-0 p-lg-4 bg-light">
              <div class="card-body">
                <h5 class="text-uppercase mb-4">Total Belanja</h5>
                <ul class="list-unstyled mb-0">

                  <?php

                  // Inisialisasi variabel total keseluruhan
                  $total_keseluruhan = 0;
                  $total_pembayaran = 0;

                  $data = mysqli_query($conn, "SELECT DISTINCT cart.user_id, cart.produk_id, cart.jumlah, produk.slug, produk.id, produk.nm_produk, produk.harga
                  FROM cart
                  JOIN produk ON cart.produk_id = produk.id
                  WHERE cart.user_id = '$user_id';
                   ");

                  while ($d = mysqli_fetch_array($data)) {
                    $total_produk_ini = ($d['jumlah'] * $d['harga']);
                    // echo format_rupiah($total_produk_ini);
                    // echo '<br>';

                    // Tambahkan nilai $total_produk_ini ke $total_keseluruhan
                    $total_keseluruhan += $total_produk_ini;
                    $total_pembayaran = format_rupiah($total_keseluruhan);
                  }


                  echo " <li class='border-bottom my-2'></li>
                  <li class='d-flex align-items-center justify-content-between mb-4'><strong class='text-uppercase small font-weight-bold'>Total</strong><span>$total_pembayaran</span></li>"

                  ?>

                  <li class="border-bottom my-2 mb-4"></li>
                  <h5 class="text-uppercase mb-4">History Pemesanan</h5>

                  <!-- notifikasi upload -->
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

                  <?php
                  // Koneksi ke database
                  // include 'koneksi/cf.php';
                  $sql1 = mysqli_query($conn, "SELECT *FROM pesanan where email='$_SESSION[email]' ");
                  $cek1 = mysqli_num_rows($sql1);
                  if ($cek1 == 0) {
                    echo "
                      <div class='alert alert-warning'>
                          <strong>Belum ada proses transaksi apapun.</strong>
                      </div>
                                        ";
                  } else {
                    echo '  <button type="button" class="btn btn-dark" style="width: 100% ;" data-toggle="collapse" data-target="#history-belanja">Lihat</button>';
                  }
                  ?>

                  <!-- <button type="button" class="btn btn-dark" style="width: 100% ;" data-toggle="collapse" data-target="#history-belanja">Lihat</button> -->
                  <div id="history-belanja" class="collapse">

                    <div class="mt-3 alert alert-warning">
                      <strong>Peringatan!</strong> Pesanan yang sudah dibuat dan belum memberi tanda bukti pembayaran akan secara otomatis di hapus. Segera melakukan pembayaran sebelum 2 menit setelah melakukan pemesanan.
                    </div>

                    <?php
                    $total_keseluruhan = 0;
                    $prev_pesanan_id = null; // Inisialisasi variabel untuk menyimpan id pesanan sebelumnya
                    $data = mysqli_query($conn, "SELECT pesanan.id, pesanan.email, pesanan.tipe_layanan, pesanan.bank, pesanan.alamat_tujuan, pesanan.total_pembayaran, pesanan.bukti_pembayaran, pesanan.tanggal_pemesanan, pesanan.konfirmasi, pesanan_produk.nm_produk, pesanan_produk.jumlah, pesanan_produk.sub_total
                      FROM pesanan
                      JOIN pesanan_produk ON pesanan.id = pesanan_produk.pesanan_id
                      WHERE pesanan.email = '$_SESSION[email]'
                      ORDER BY pesanan.id DESC, pesanan_produk.pesanan_id DESC");


                    while ($d = mysqli_fetch_array($data)) {
                      $pesanan_id = $d['id'];
                      if ($pesanan_id != $prev_pesanan_id) {
                        // Tutup div sebelumnya (jika ada)
                        if ($prev_pesanan_id !== null) {
                          echo "</div>";
                        }
                        // Buat div baru
                        echo '<div class="card mt-2 mb-2 p-2 "> <div class="bg-light h6">' . format_rupiah($d['total_pembayaran']) . '&nbsp(' . $d['bank'] . ')</div>';
                        echo '<p class="mb-0">Tanggal &nbsp:&nbsp' . $d['tanggal_pemesanan'] . ' </p>';
                        echo '<p class="mb-0">Barang &nbsp&nbsp:&nbsp' . $d['tipe_layanan'] . ' </p>';
                        echo '<p class="mb-0">Alamat &nbsp&nbsp:&nbsp' . $d['alamat_tujuan'] . ' </p>';
                        if ($d['bank'] == 'BCA') {
                          echo '<p class="mb-0">No.Rek &nbsp&nbsp:&nbsp 8030864141 </p>';
                        } elseif ($d['bank'] == 'BRI') {
                          echo '<p class="mb-0">No.Rek &nbsp&nbsp:&nbsp 182601003250504 </p>';
                        } elseif ($d['bank'] == 'Mandiri') {
                          echo '<p class="mb-0">No.Rek &nbsp&nbsp:&nbsp 1080015314645 </p>';
                        }

                        $sql1 = mysqli_query($conn, "SELECT bukti_pembayaran FROM pesanan where id='$d[id]' ");
                        $row = mysqli_fetch_array($sql1);
                        if (is_null($row['bukti_pembayaran'])) {
                          echo '<p class="">Status &nbsp&nbsp&nbsp&nbsp:&nbsp<a href="#bukti-tf-' . $d['id'] . '" data-bs-toggle="modal">Klik Untuk Membayar</a></p>';
                          echo '
                          <div class="modal fade" id="bukti-tf-' . $d['id'] . '">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                              <div class="modal-content overflow-hidden border-0">
                              
                                <!-- Modal Header -->
                                <div class="modal-header bg-light">
                                  <h4 class="modal-title">Upload Bukti Pembayaran Anda Dari Sini</h4>
                                  <button class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0 " type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body ">
                                  <form action="proof-of-payment" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="pesanan_id" value="' . $d['id'] . '">
                                    <div class="row gy-3">
                                      <div class="col-lg-12">
                                        <label class="form-label text-sm text-uppercase">Bukti Pembayaran VIA ' . $d['bank'] . '</label>
                                        <input class="form-control form-control-lg" type="file" name="bukti_pembayaran">
                                      </div>

                                      <div class="col-lg-12">
                                        <button class="btn btn-dark" type="submit">Kirim</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              
                                
                              </div>
                            </div>
                          </div>
                          ';
                        } else if ($d['konfirmasi'] == 'Sudah') {
                          echo '<p class="">Status &nbsp&nbsp&nbsp&nbsp: <span class="badge bg-success">confirmed</span></p>';
                        } else if ($d['konfirmasi'] == 'Belom') {
                          echo '<p class="">Status &nbsp&nbsp&nbsp&nbsp: <span class="badge bg-warning">pending</span></p>';
                        }

                        echo '<li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold ">' . $d['nm_produk'] . ' (' . $d['jumlah'] . ' pcs)</strong></li>';
                        echo '<li class="d-flex align-items-center justify-content-between"><span>' . format_rupiah($d['sub_total']) . '</span></li><hr>';
                      } else {
                        // Tambahkan elemen li ke div yang ada

                        echo '<li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">' . $d['nm_produk'] . ' (' . $d['jumlah'] . ' pcs)</strong></li>';
                        echo '<li class="d-flex align-items-center justify-content-between"><span>' . format_rupiah($d['sub_total']) . '</span></li><hr>';
                      }


                      $prev_pesanan_id = $pesanan_id; // Perbarui variabel id pesanan sebelumnya
                    }
                    // Tambahkan div terakhir (jika ada)
                    if ($prev_pesanan_id !== null) {
                      echo "</div>";
                    }

                    ?>
                  </div>





                  <!-- <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>$250</span></li> -->

                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- footer -->
    <?php include 'source/footer.php'; ?>

    <!-- JavaScript files-->
    <script src="toko_online/js/jquery.slim.min.js"></script>
    <script src="toko_online/js/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->

    <script src="toko_online/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="toko_online/vendor/bootstrap/js/bootstrap.bundle.min1.js"></script>
    <script src="toko_online/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="toko_online/vendor/nouislider/nouislider.min.js"></script>
    <script src="toko_online/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="toko_online/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="toko_online/js/front.js"></script>
    <script>
      // ------------------------------------------------------- //
      //   Inject SVG Sprite - 
      //   see more here 
      //   https://css-tricks.com/ajaxing-svg-sprite/
      // ------------------------------------------------------ //
      function injectSvgSprite(path) {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", path, true);
        ajax.send();
        ajax.onload = function(e) {
          var div = document.createElement("div");
          div.className = 'd-none';
          div.innerHTML = ajax.responseText;
          document.body.insertBefore(div, document.body.childNodes[0]);
        }
      }
      // this is set to BootstrapTemple website as you cannot 
      // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
      // while using file:// protocol
      // pls don't forget to change to your domain :)
      injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
    </script>

    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  </div>
</body>

</html>