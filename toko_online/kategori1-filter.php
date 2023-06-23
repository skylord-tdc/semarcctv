<?php
// Untuk menonaktifkan laporan error jenis E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
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
    <?php include 'source/navbar_kategori1.php'; ?>

    <div class="container">
      <!-- HERO SECTION-->
      <section class="py-5 bg-light">
        <div class="container">
          <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
              <h1 class="h2 text-uppercase mb-0"><?php echo $_GET['brand']; ?></h1>
            </div>
            <div class="col-lg-6 text-lg-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                  <li class="breadcrumb-item"><a class="text-dark" href="beranda">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section class="py-5">
        <div class="container p-0">
          <div class="row">
            <!-- SHOP SIDEBAR-->
            <div class="col-lg-3 order-2 order-lg-1">
              <h5 class="text-uppercase mb-4">Kategori</h5>
              <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase fw-bold">cctv indoor</strong></div>
              <ul class="list-unstyled small text-muted ps-lg-4 font-weight-normal">
                <?php
                // include 'koneksi/cf.php';

                // untuk pengulangan penomeran
                $no = 1;
                $dataKategori = mysqli_query($conn, "SELECT DISTINCT brand FROM produk WHERE kategori_produk = 'cctv indoor' ");

                while ($dKategori = mysqli_fetch_array($dataKategori)) {
                ?>
                  <li class="mb-2"><a class="text-uppercase reset-anchor" href="kategori-cctv-indoor-filter?brand=<?php echo $dKategori['brand']; ?>"><?php echo $dKategori['brand']; ?></a></li>

                <?php } ?>
              </ul>


            </div>
            <!-- SHOP LISTING-->
            <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">

              <div class="row">
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

                <!-- PRODUCT-->

                <?php
                // include 'koneksi/cf.php';

                // untuk pengulangan penomeran
                $no = 1;
                $dataShop = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_produk = 'cctv indoor' AND brand = '$_GET[brand]' ");

                while ($dShop = mysqli_fetch_array($dataShop)) {
                ?>
                  <div class="col-lg-4 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <?php
                        // Query untuk mengambil data stok produk dan jumlah pesanan
                        $query = "SELECT produk.stok_produk, COALESCE(SUM(pesanan_produk.jumlah), 0) AS jumlah_pesanan
                          FROM produk 
                          LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
                          WHERE produk.id = " . $dShop['id'];

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


                        <a class="d-block" href="<?php echo $dShop['slug']; ?>">
                          <?php
                          // include 'koneksi/cf.php';

                          // untuk pengulangan penomeran
                          $no = 1;
                          $dataImg = mysqli_query($conn, "SELECT * FROM `gambar_produk` WHERE produk_id = $dShop[id] LIMIT 1 OFFSET 0; ");

                          while ($dImg = mysqli_fetch_array($dataImg)) {
                          ?>
                            <img class="img-fluid w-100" src="toko_online/uploads/gambar_produk/<?php echo $dImg['nama_gambar']; ?>" alt="..." style="width: 256px ; height: 281px; object-fit:cover;">
                          <?php } ?>
                        </a>


                        <div class="product-overlay">
                          <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0">
                              <form action="<?php echo $dShop['slug']; ?>" method="get">
                                <?php if ($row['stok_produk'] > $row['jumlah_pesanan']) { ?>
                                  <button class="btn btn-sm btn-dark" type="submit">Add to cart</button>
                                <?php } else { ?>
                                  <button class="btn btn-sm btn-dark" type="submit" disabled>Add to cart</button>
                                <?php } ?>
                              </form>

                            </li>
                          </ul>
                        </div>
                      </div>
                      <h6> <a class="reset-anchor" href="<?php echo $dShop['slug']; ?>"><?php echo $dShop['nm_produk']; ?></a></h6>
                      <p class="small text-muted"><?php echo format_rupiah($dShop['harga']); ?></p>
                    </div>
                  </div>
                <?php } ?>


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
      injectSvgSprite('http://localhost/semarcctv/toko_online/icons/orion-svg-sprite.svg');
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </div>
</body>

</html>