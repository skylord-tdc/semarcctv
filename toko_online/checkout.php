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


  <!-- file css -->
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

    <!--  Modal -->
    <div class="modal fade" id="productView" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content overflow-hidden border-0">
          <button class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-body p-0">
            <div class="row align-items-stretch">
              <div class="col-lg-6 p-lg-0"><a class="glightbox product-view d-block h-100 bg-cover bg-center" style="background: url(img/product-5.jpg)" href="img/product-5.jpg" data-gallery="gallery1" data-glightbox="Red digital smartwatch"></a><a class="glightbox d-none" href="img/product-5-alt-1.jpg" data-gallery="gallery1" data-glightbox="Red digital smartwatch"></a><a class="glightbox d-none" href="img/product-5-alt-2.jpg" data-gallery="gallery1" data-glightbox="Red digital smartwatch"></a></div>
              <div class="col-lg-6">
                <div class="p-4 my-md-4">
                  <ul class="list-inline mb-2">
                    <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i></li>
                  </ul>
                  <h2 class="h4">Red digital smartwatch</h2>
                  <p class="text-muted">$250</p>
                  <p class="text-sm mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut ullamcorper leo, eget euismod orci. Cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus. Vestibulum ultricies aliquam convallis.</p>
                  <div class="row align-items-stretch mb-4 gx-0">
                    <div class="col-sm-7">
                      <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                        <div class="quantity">
                          <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                          <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                          <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-5"><a class="btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0" href="cart.html">Add to cart</a></div>
                  </div><a class="btn btn-link text-dark text-decoration-none p-0" href="#!"><i class="far fa-heart me-2"></i>Add to wish list</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <!-- HERO SECTION-->
      <section class="py-5 bg-light">
        <div class="container">
          <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
              <h1 class="h2 text-uppercase mb-0">Checkout</h1>
            </div>
            <div class="col-lg-6 text-lg-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                  <li class="breadcrumb-item"><a class="text-dark" href="beranda">Home</a></li>
                  <li class="breadcrumb-item"><a class="text-dark" href="keranjang-belanja">Keranjang</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section class="py-5">
        <!-- BILLING ADDRESS-->
        <h2 class="h5 text-uppercase mb-4">Detail Pembayaran</h2>
        <div class="row">
          <div class="col-lg-8">

            <div class="row gy-3">

              <div class="col-lg-12 borderTabContentDiv">

                <nav class="">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-ambil" type="button" role="tab" aria-controls="nav-ambil" aria-selected="true">Pickup</button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-kirim" type="button" role="tab" aria-controls="nav-kirim" aria-selected="false">Shipping</button>
                  </div>
                </nav>
                <div class="tab-content borderTabContent" id="nav-tabContent">

                  <div class="tab-pane fade show active" id="nav-ambil" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <form action="pickup" method="post">
                      <div class="row gy-3">
                        <?php
                        // Koneksi ke database
                        // include 'koneksi/cf.php';
                        // include 'api_website/func_rupiah.php';

                        // Inisialisasi variabel total keseluruhan
                        $total_keseluruhan = 0;
                        $total_pembayaran = 0;

                        $data = mysqli_query($conn, "SELECT DISTINCT cart.id, cart.user_id, cart.produk_id, cart.jumlah, produk.slug, produk.id, produk.nm_produk, produk.harga
                        FROM cart
                        JOIN produk ON cart.produk_id = produk.id
                        WHERE cart.user_id = '$user_id';
                        ");

                        $disabled = '';
                        if (mysqli_num_rows($data) == 0) {
                          $disabled = 'disabled';
                        }

                        while ($d = mysqli_fetch_array($data)) {

                          $total_produk_ini = ($d['jumlah'] * $d['harga']);
                          $total_keseluruhan += $total_produk_ini;
                          $total_pembayaran = $total_keseluruhan;

                          echo "<input type='hidden' name='data[produk_id][]' value='$d[produk_id]'>";
                          echo "<input type='hidden' name='data[jumlah][]' value='$d[jumlah]'>";
                          echo "<input type='hidden' name='data[nm_produk][]' value='$d[nm_produk]'>";
                          echo "<input type='hidden' name='data[sub_total][]' value=' $total_produk_ini'>";
                        }

                        echo "<input type='hidden' name='total_pembayaran' value='$total_pembayaran'>";
                        echo "<input type='hidden' name='user_id' value='$user_id'>";

                        ?>

                        <div class="col-12 mt-4">
                          <h2 class="h4 text-uppercase mb-4">Barang Ambil di Toko</h2>
                        </div>
                        <div class="col-lg-12">
                          <label class="form-label text-sm text-uppercase">Nama </label>
                          <input class="form-control form-control-lg" type="text" value="<?php echo $_SESSION['nama']; ?>" readonly>
                          <input type="hidden" name="nm_pelangan" value="<?php echo $_SESSION['nama']; ?>">
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label text-sm text-uppercase">Email </label>
                          <input class="form-control form-control-lg" type="email" value="<?php echo $_SESSION['email']; ?>" readonly>
                          <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label text-sm text-uppercase">Layanan </label>
                          <input class="form-control form-control-lg" type="text" placeholder="Ambil Di Tempat" readonly>
                          <input type="hidden" name="tipe_layanan" value="Ambil di Toko">
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label text-sm text-uppercase">Bank Yang Anda Pakai </label>
                          <select name="bank" class="form-control form-control-lg" required>
                            <option selected disabled value>Silahkan memilih...</option>
                            <option value="BCA">BCA</option>
                            <option value="BRI">BRI</option>
                            <option value="Mandiri">Mandiri</option>
                          </select>
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label text-sm text-uppercase">No. Telp / WA </label>
                          <input class="form-control form-control-lg" type="number" value="<?php echo $_SESSION['no_hp']; ?>" readonly>
                          <input type="hidden" name="no_hp" value="<?php echo $_SESSION['no_hp']; ?>">
                        </div>
                        <div class="col-lg-12">
                          <!-- <button class="btn btn-dark" type="submit">Buat Pesanan</button> -->
                          <div class="col-lg-12">
                            <button class="btn btn-dark" type="submit" <?php echo $disabled; ?>>Buat Pesanan</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane fade" id="nav-kirim" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <form action="shipping" method="post">
                      <div class="row gy-3">
                        <?php
                        // Koneksi ke database
                        // include 'koneksi/cf.php';
                        // include 'api_website/func_rupiah.php';

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
                          $total_keseluruhan += $total_produk_ini;
                          $total_pembayaran = $total_keseluruhan;
                          // echo $d['nm_produk'] . format_rupiah($total_produk_ini);
                          // $sub_total = format_rupiah($total_produk_ini);
                          echo "<input type='hidden' name='data[produk_id][]' value='$d[produk_id]'>";
                          echo "<input type='hidden' name='data[jumlah][]' value='$d[jumlah]'>";
                          echo "<input type='hidden' name='data[nm_produk][]' value='$d[nm_produk]'>";
                          echo "<input type='hidden' name='data[sub_total][]' value=' $total_produk_ini'>";
                        }
                        // echo "<input type='hidden' name='user_id' value=' $user_id'>";
                        echo "<input type='hidden' name='total_pembayaran' value='$total_pembayaran'>";
                        echo "<input type='hidden' name='user_id' value='$user_id'>";

                        ?>

                        <div class="col-12 mt-4">
                          <h2 class="h4 text-uppercase mb-4">Barang di Antar</h2>
                        </div>
                        <div class="col-lg-12">
                          <label class="form-label text-sm text-uppercase">Nama </label>
                          <input class="form-control form-control-lg" type="text" value="<?php echo $_SESSION['nama']; ?>" readonly>
                          <input type="hidden" name="nm_pelangan" value="<?php echo $_SESSION['nama']; ?>">
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label text-sm text-uppercase">Email </label>
                          <input class="form-control form-control-lg" type="email" value="<?php echo $_SESSION['email']; ?>" readonly>
                          <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label text-sm text-uppercase">Layanan </label>
                          <input class="form-control form-control-lg" type="text" placeholder="Di Antar" readonly>
                          <input type="hidden" name="tipe_layanan" value="Di Antar">
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label text-sm text-uppercase">Bank </label>
                          <select name="bank" class="form-control form-control-lg" required>
                            <option selected disabled value>Silahkan memilih...</option>
                            <option value="BCA">BCA</option>
                            <option value="BRI">BRI</option>
                            <option value="Mandiri">Mandiri</option>
                          </select>
                        </div>
                        <div class="col-lg-6">
                          <label class="form-label text-sm text-uppercase">No. Telp / WA </label>
                          <input class="form-control form-control-lg" type="number" value="<?php echo $_SESSION['no_hp']; ?>" readonly>
                          <input type="hidden" name="no_hp" value="<?php echo $_SESSION['no_hp']; ?>">
                        </div>
                        <div class="col-lg-12">
                          <label class="form-label text-sm text-uppercase">Alamat </label>
                          <input class="form-control form-control-lg" type="text" name="alamat" placeholder="Area Semarang Saja" required>
                        </div>
                        <div class="col-lg-12">
                          <button class="btn btn-dark" type="submit" <?php echo $disabled; ?>>Buat Pesanan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

              </div>



            </div>

          </div>
          <!-- ORDER SUMMARY-->
          <div class="col-lg-4">
            <div class="card border-0 rounded-0 p-lg-4 bg-light">
              <div class="card-body">

                <h5 class="text-uppercase mb-4">PESANAN ANDA</h5>

                <ul class="list-unstyled mb-0">
                  <?php
                  $jumlah = 0;
                  $nm_produk = 0;
                  $sub_total = 0;
                  $total = 0;

                  // periksa apakah variabel POST tersedia dan tidak kosong
                  if (isset($_POST['data']['jumlah']) && isset($_POST['data']['nm_produk']) && isset($_POST['data']['sub_total']) && isset($_POST['data']['total'])) {
                    // tangkap data dari form
                    $jumlah = $_POST['data']['jumlah'];
                    $nm_produk = $_POST['data']['nm_produk'];
                    $sub_total = $_POST['data']['sub_total'];
                    $total = $_POST['data']['total'];

                    // loop untuk menampilkan produk dan sub total
                    for ($i = 0; $i < count($nm_produk); $i++) {
                      echo '<li class="d-flex align-items-center justify-content-between"><strong class="small fw-bold">' . $nm_produk[$i] . ' &nbsp(' . $jumlah[$i] . 'pcs)</strong><span class="text-muted small">' . $sub_total[$i] . '</span></li>';
                      echo '<li class="border-bottom my-2"></li>';
                    }

                    // tampilkan total keseluruhan
                    echo '<li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small fw-bold">Total</strong><span>' . $total[0] . '</span></li>';
                  } else {
                    // jika data kosong, tampilkan pesan
                    echo 'Anda belum membuat pesanan.';
                  }
                  ?>

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
    <script src="toko_online/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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