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
    <!-- navbar -->
    <?php include 'toko_online/source/navbar_home.php'; ?>

    <!-- HERO SECTION-->
    <div class="container mb-4">
      <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url(toko_online/img/cover.png)">
        <div class="container py-5">
          <div class="row px-4 px-lg-5">
            <div class="col-lg-6">
              <p class="text-muted small text-uppercase mb-2">Pusat Grosir</p>
              <h1 class="h2 text-uppercase mb-3">CCTV & AKSESORIS</h1><a class="btn btn-dark" href="belanja">Jelajahi Koleksi</a>
            </div>
          </div>
        </div>
      </section>
      <!-- CATEGORIES SECTION-->
      <section class="pt-5">
        <header class="text-center">
          <p class="small text-muted small text-uppercase mb-1">koleksi produk kami</p>
          <h2 class="h5 text-uppercase mb-4">berdasarkan kategori</h2>
        </header>
        <div class="row">
          <div class="col-md-4"><a class="category-item" href="kategori-cctv-indoor"><img class="img-fluid" src="toko_online/img/cctv-indoor.png" alt="" /><strong class="category-item-title">CCTV INDOOR</strong></a>
          </div>
          <div class="col-md-4"><a class="category-item" href="kategori-accessories"><img class="img-fluid" src="toko_online/img/aksesoris.png" alt="" /><strong class="category-item-title">accessories</strong></a>
          </div>
          <div class="col-md-4"><a class="category-item" href="kategori-cctv-outdoor"><img class="img-fluid" src="toko_online/img/cctv-outdoor.png" alt="" /><strong class="category-item-title">CCTV OUTDOOR</strong></a>
          </div>
        </div>
      </section>
      <!-- TRENDING PRODUCTS-->
      <section class="py-5">
        <header>
          <p class="small text-muted small text-uppercase mb-1">Berikut Rekomendasi</p>
          <h2 class="h5 text-uppercase mb-4">Best Seller Product Kami</h2>
        </header>
        <div class="row">

          <!-- PRODUCT-->
          <?php
          include 'toko_online/koneksi/cf.php';
          include 'toko_online/api_website/func_rupiah.php';

          // untuk pengulangan penomeran
          $no = 1;
          $dataBestSeller = mysqli_query($conn, "SELECT 
          produk.id, 
          produk.slug, 
          produk.kategori_produk, 
          produk.brand, 
          produk.nm_produk, 
          produk.ket_produk, 
          produk.harga, 
          produk.stok_produk, 
          IFNULL(SUM(pesanan_produk.jumlah),0) AS jumlah_pesanan, 
          IFNULL((produk.stok_produk - SUM(pesanan_produk.jumlah)),0) AS sisa_stok
          FROM 
            produk 
            LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
          GROUP BY 
            produk.id 
          HAVING 
            sisa_stok > 0 
            AND jumlah_pesanan >= 100 
          ORDER BY 
          jumlah_pesanan DESC");


          while ($dBestSeller = mysqli_fetch_array($dataBestSeller)) {
          ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="product text-center">
                <div class="position-relative mb-3">
                  <?php
                  // Query untuk mengambil data stok produk dan jumlah pesanan
                  $query = "SELECT produk.stok_produk, COALESCE(SUM(pesanan_produk.jumlah), 0) AS jumlah_pesanan
                          FROM produk 
                          LEFT JOIN pesanan_produk ON produk.id = pesanan_produk.produk_id 
                          WHERE produk.id = " . $dBestSeller['id'];

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
                  <a class="d-block" href="<?php echo $dBestSeller['slug']; ?>">
                    <?php
                    // include 'koneksi/cf.php';

                    // untuk pengulangan penomeran
                    $no = 1;
                    $dataImgBS = mysqli_query($conn, "SELECT * FROM `gambar_produk` WHERE produk_id = $dBestSeller[id] LIMIT 1 OFFSET 0; ");

                    while ($dImgBS = mysqli_fetch_array($dataImgBS)) {
                    ?>
                      <img class="img-fluid w-100" src="toko_online/uploads/gambar_produk/<?php echo $dImgBS['nama_gambar']; ?>" alt="<?php echo $dImg['nama_gambar']; ?>">
                    <?php } ?>
                  </a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0">
                        <form action="<?php echo $dBestSeller['slug']; ?>" method="get">
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
                <!-- <h6> <a class="reset-anchor" href="detail.html">Red digital smartwatch</a></h6> -->
                <h6> <a class="reset-anchor" href="<?php echo $dBestSeller['slug']; ?>"><?php echo $dBestSeller['nm_produk']; ?></a></h6>
                <p class="small text-muted"><?php echo format_rupiah($dBestSeller['harga']); ?></p>
              </div>
            </div>
          <?php } ?>

      </section>
      <!-- SERVICES-->
      <section class="py-5 bg-light">
        <div class="container">
          <div class="row text-center gy-3">
            <div class="col-lg-6">
              <div class="d-inline-block">
                <div class="d-flex align-items-end">
                  <svg class="svg-icon svg-icon-big svg-icon-light">
                    <use xlink:href="#delivery-time-1"> </use>
                  </svg>
                  <div class="text-start ms-3">
                    <h6 class="text-uppercase mb-1">Free ongkir</h6>
                    <p class="text-sm mb-0 text-muted">Semarang Area</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="d-inline-block">
                <div class="d-flex align-items-end">
                  <svg class="svg-icon svg-icon-big svg-icon-light" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                    <path d="M272,288H208a16,16,0,0,1-16-16V208a16,16,0,0,1,16-16h64a16,16,0,0,1,16,16v37.12C299.11,232.24,315,224,332.8,224H469.74l6.65-7.53A16.51,16.51,0,0,0,480,207a16.31,16.31,0,0,0-4.75-10.61L416,144V48a16,16,0,0,0-16-16H368a16,16,0,0,0-16,16V87.3L263.5,8.92C258,4,247.45,0,240.05,0s-17.93,4-23.47,8.92L4.78,196.42A16.15,16.15,0,0,0,0,207a16.4,16.4,0,0,0,3.55,9.39L22.34,237.7A16.22,16.22,0,0,0,33,242.48,16.51,16.51,0,0,0,42.34,239L64,219.88V384a32,32,0,0,0,32,32H272ZM629.33,448H592V288c0-17.67-12.89-32-28.8-32H332.8c-15.91,0-28.8,14.33-28.8,32V448H266.67A10.67,10.67,0,0,0,256,458.67v10.66A42.82,42.82,0,0,0,298.6,512H597.4A42.82,42.82,0,0,0,640,469.33V458.67A10.67,10.67,0,0,0,629.33,448ZM544,448H352V304H544Z" />
                  </svg>
                  <div class="text-start ms-3">
                    <h6 class="text-uppercase mb-1">Layanan</h6>
                    <p class="text-sm mb-0 text-muted">Tersedia Selama Jam Kerja</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

    </div>

    <!-- footer -->
    <?php include 'toko_online/source/footer.php'; ?>

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