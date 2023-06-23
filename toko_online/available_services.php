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
        <?php include 'source/navbar_blog.php'; ?>

        <!-- HERO SECTION-->
        <div class="container">


            <!-- TRENDING PRODUCTS-->
            <section class="py-5">
                <header>
                    <h2 class="h5 text-uppercase mb-4">Layanan Yang Tersedia</h2>
                </header>

                <div class="row">
                    <!-- PRODUCT-->
                    <div class="col-sm-12">
                        <div class="card text-dark bg-light mb-3" style="max-width: 100rem;">
                            <div class="card-header">Pengiriman</div>
                            <div class="card-body">
                                <h5 class="card-title">Free Ongkir</h5>
                                <p class="card-text">Untuk saat ini kami hanya menerima layanan antar untuk wilayah semarang.</p>
                            </div>
                        </div>

                    </div>


                </div>
            </section>

        </div>
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