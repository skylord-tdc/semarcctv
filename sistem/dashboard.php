<?php
session_start();
include '../toko_online/koneksi/cf.php';
// Cek apakah pengguna sudah login dan jenis_akun nya bernilai
if (isset($_SESSION["user_id"]) && isset($_SESSION["jenis_akun"]) && $_SESSION["jenis_akun"] == 0) {
  // Jika iya, lanjutkan ke halaman yang diinginkan atau stay
} else {
  header("location: login"); // Jika tidak, arahkan pengguna ke halaman login
  exit;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>SEMAR CCTV</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



  <!-- Bootstrap core CSS -->
  <link href="sistem/assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="sistem/dashboard.css" rel="stylesheet">
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">SEMAR CCTV</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="log-out">Sign out</a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">

          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link <?php if (!isset($_GET['page']) || $_GET['page'] == 'dashboard') {
                                    echo 'active';
                                  } ?>" aria-current="page" href="?page=dashboard">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'orders') {
                                    echo 'active';
                                  } ?>" href="?page=orders">
                <span data-feather="file"></span>
                Products
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'products') {
                                    echo 'active';
                                  } ?>" href="?page=products">
                <span data-feather="shopping-cart"></span>
                Products
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'customers') {
                                    echo 'active';
                                  } ?>" href="?page=customers">
                <span data-feather="users"></span>
                Customers
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <!-- <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a> -->
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="unduh-bulan-ini" target="_blank">
                <span data-feather="file-text"></span>
                Current month
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="unduh-tahun-ini" target="_blank">
                <span data-feather="file-text"></span>
                Year-end sale
              </a>
            </li>
          </ul>

        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php
        @$page = $_GET['page'];

        if (!empty($page)) {
          switch ($page) {

            case 'dashboard':
              include "next_page/p-dashboard.php";
              break;

            case 'orders':
              include "next_page/p-orders.php";
              break;

            case 'orders-details':
              include "next_page/p-orders-details.php";
              break;

            case 'products':
              include "next_page/p-products.php";
              break;

            case 'customers':
              include "next_page/p-customers.php";
              break;

            default:
              include "next_page/p-dashboard.php";
              break;
          }
        } else {

          include "next_page/p-dashboard.php";
        }
        ?>
      </main>

    </div>
  </div>

  <script src="sistem/assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="sistem/dashboard.js"></script>

  <!-- text edit -->

  <!-- end text edit -->

</body>

</html>