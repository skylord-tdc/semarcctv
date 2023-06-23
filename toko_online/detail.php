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
  <div class="page-holder bg-light">
    <!-- navbar-->
    <?php include 'source/navbar_belanja.php'; ?>


    <section class="py-5">
      <div class="container">
        <!-- notif add cart -->
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


        <div class="row mb-5">
          <!-- PRODUCT DETAILS-->
          <?php
          // include 'koneksi/cf.php'; 

          // untuk pengulangan penomeran
          $no = 1;
          $dataDetail = mysqli_query($conn, "SELECT * FROM `produk` WHERE slug = '$_GET[slug]' ; ");

          while ($dDetail = mysqli_fetch_array($dataDetail)) {
          ?>

            <div class="col-lg-6">
              <!-- PRODUCT SLIDER-->
              <div class="row m-sm-0">

                <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0 px-xl-2">
                  <div class="swiper product-slider-thumbs">
                    <?php
                    // include 'koneksi/cf.php';

                    // untuk pengulangan penomeran
                    $no = 1;
                    $dataimg = mysqli_query($conn, "SELECT * FROM gambar_produk WHERE produk_id = '$dDetail[id]' ");

                    while ($dimg = mysqli_fetch_array($dataimg)) {
                    ?>
                      <?php $idProductYangDibuka = $dDetail['id']; ?>
                      <div class="swiper-wrapper">
                        <div class="swiper-slide h-auto swiper-thumb-item mb-3"><img class="w-100" src="toko_online/uploads/gambar_produk/<?php echo $dimg['nama_gambar']; ?>" alt="..." style="width: 90px ; height: 90px ; object-fit: cover;"></div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-sm-10 order-1 order-sm-2">
                  <div class="swiper product-slider">
                    <div class="swiper-wrapper">
                      <?php
                      // include 'koneksi/cf.php';

                      // untuk pengulangan penomeran
                      $no = 1;
                      $dataSlider = mysqli_query($conn, "SELECT * FROM gambar_produk WHERE produk_id = '$dDetail[id]' ");

                      while ($dSlider = mysqli_fetch_array($dataSlider)) {
                      ?>
                        <div class="swiper-slide h-auto"><a class="glightbox product-view" href="toko_online/uploads/gambar_produk/<?php echo $dSlider['nama_gambar']; ?>" data-gallery="gallery2" data-glightbox="Product item 1"><img class="img-fluid" src="toko_online/uploads/gambar_produk/<?php echo $dSlider['nama_gambar']; ?>" alt="..." style="width: 427px ; height: 407px; object-fit:cover;"></a></div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <?php
              // Query untuk mengambil data stok produk dan jumlah pesanan
              $query = "SELECT produk.stok_produk, COALESCE(SUM(pesanan_produk.jumlah), 0) AS jumlah_pesanan
              FROM produk 
              LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
              WHERE produk.id = " . $dDetail['id'];

              $result = mysqli_query($conn, $query);

              $row = mysqli_fetch_assoc($result);

              // Cek ketersediaan stok
              if ($row['stok_produk'] > $row['jumlah_pesanan']) {
                // Jika stok masih tersedia
                // echo '<div class="alert alert-success text-center" role="alert">
                //           Stok tersedia
                //       </div>';

                // echo '<div class="text-center">Jumlah stok yang tersisa: ' . ($row['stok_produk'] - $row['jumlah_pesanan']) . '</div>';
                $jumlah_stok_saat_ini = ($row['stok_produk'] - $row['jumlah_pesanan']);
              } else {
                // Jika stok habis
                $jumlah_stok_saat_ini = 0;
                echo '<div class="alert alert-danger text-center" role="alert">
                          Stok habis!
                      </div>';
              }
              ?>


              <h1><?php echo $dDetail['nm_produk']; ?></h1>

              <p class="text-muted lead"><?php echo format_rupiah($dDetail['harga']); ?></p>

              <form action="add-cart-detail" method="post">
                <div class="row align-items-stretch mb-4">
                  <div class="col-sm-6 pr-sm-0">
                    <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Jumlah</span>
                      <div class="quantity">
                        <!-- <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button> -->
                        <a type="button" class="dec-btn p-0"><i class="fas fa-caret-left"></i></a>
                        <input class="form-control border-0 shadow-0 p-0" type="text" value="1" name="jumlah_2">
                        <!-- <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button> -->
                        <a type="button" class="inc-btn p-0"><i class="fas fa-caret-right"></i></a>

                        <input type="hidden" name="user_id_2" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="produk_id_2" value="<?php echo $dDetail['id']; ?>">
                        <input type="hidden" name="stok_produk" value="<?php echo $jumlah_stok_saat_ini; ?>">

                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 pl-sm-0">
                    <!-- <a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="cart.html">Add to cart</a> -->
                    <?php if ($row['stok_produk'] > $row['jumlah_pesanan']) { ?>
                      <button type="submit" class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0">&nbsp Add to cart &nbsp</button>
                    <?php } else { ?>
                      <button type="submit" disabled class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0">&nbsp Add to cart &nbsp</button>
                    <?php } ?>
                  </div>
                </div>
              </form>

              <ul class="list-unstyled small d-inline-block">
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Category:</strong><a class="text-uppercase reset-anchor ms-2" href="#!"><?php echo $dDetail['kategori_produk']; ?></a></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Brand :</strong><a class="text-uppercase reset-anchor ms-2" href="#!"><?php echo $dDetail['brand']; ?></a></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Stok :</strong><a class="reset-anchor ms-2" href="#!"><?php echo $jumlah_stok_saat_ini; ?></a></li>
              </ul>
            </div>

            <div class="col-lg-12 mt-5">
              <!-- DETAILS TABS-->
              <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link text-uppercase active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Deskripsi</a></li>

              </ul>
              <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                  <div class="p-4 p-lg-5 bg-white">
                    <h6 class="text-uppercase">Deskripsi barang </h6>
                    <p class="text-muted text-sm mb-0"><?php echo $dDetail['ket_produk']; ?></p>
                    <?php $kategori_produk_ini = $dDetail['kategori_produk']; ?>
                  </div>
                </div>

              </div>
            </div>
          <?php } ?>
        </div>

        <!-- RELATED PRODUCTS-->
        <h2 class="h5 text-uppercase mb-4">PRODUK TERKAIT</h2>
        <div class="row">

          <?php
          // include 'koneksi/cf.php';
          // untuk pengulangan penomeran
          $no = 1;
          $dataProduct = mysqli_query($conn, "SELECT * FROM `produk` WHERE kategori_produk='$kategori_produk_ini' AND slug != '$_GET[slug]' ");
          while ($dProduct = mysqli_fetch_array($dataProduct)) {
          ?>

            <!-- PRODUCT-->

            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative">
                  <?php
                  // Query untuk mengambil data stok produk dan jumlah pesanan
                  $query = "SELECT produk.stok_produk, COALESCE(SUM(pesanan_produk.jumlah), 0) AS jumlah_pesanan
                            FROM produk 
                            LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
                            WHERE produk.id = " . $dProduct['id'];

                  $result = mysqli_query($conn, $query);

                  $row = mysqli_fetch_assoc($result);

                  // Cek ketersediaan stok
                  if ($row['stok_produk'] > $row['jumlah_pesanan']) {
                    // Jika stok masih tersedia
                    echo '<div class="badge text-white bg-success">Tersedia</div>';
                  } else {
                    // Jika stok habis
                    echo '<div class="badge text-white bg-danger">Habis</div>';
                  }
                  ?>
                  <a class="d-block" href="<?php echo $dProduct['slug']; ?>">
                    <?php
                    // include 'koneksi/cf.php';
                    // untuk pengulangan penomeran
                    $no = 1;
                    $dataImgProduct = mysqli_query($conn, "SELECT * FROM `gambar_produk`  WHERE produk_id = $dProduct[id] LIMIT 1 OFFSET 0;");
                    while ($dImgProduct = mysqli_fetch_array($dataImgProduct)) {
                    ?>
                      <img class="img-fluid w-100" src="toko_online/uploads/gambar_produk/<?php echo $dImgProduct['nama_gambar']; ?>" alt="..." style="width: 259px ; height: 285px ; object-fit:cover;">
                    <?php } ?>
                  </a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <form action="add-cart-terkait" method="post">
                        <input type="hidden" name="user_id_1" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="produk_id_1" value="<?php echo $dProduct['id']; ?>">

                        <?php if ($row['stok_produk'] > $row['jumlah_pesanan']) { ?>
                          <button class="btn btn-sm btn-dark" type="submit">Add to cart</button>
                        <?php } else { ?>
                          <button class="btn btn-sm btn-dark" type="submit" disabled>Add to cart</button>
                        <?php } ?>
                      </form>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="<?php echo $dProduct['slug']; ?>"><?php echo $dProduct['nm_produk']; ?></a></h6>
                <p class="small text-muted"><?php echo format_rupiah($dProduct['harga']); ?></p>
              </div>
            </div>

          <?php } ?>

        </div>
      </div>
    </section>
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