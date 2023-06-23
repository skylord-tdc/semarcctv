<?php include 'koneksi/cf.php';
include 'api_website/func_rupiah.php'; ?>
<!-- navbar-->
<header class="header bg-white">
    <div class="container px-lg-3">
        <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="beranda"><span class="fw-bold text-uppercase text-dark">SEMAR CCTV</span></a>
            <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <!-- Link--><a class="nav-link" href="beranda">Home</a>
                    </li>
                    <li class="nav-item">
                        <!-- Link--><a class="nav-link active" href="kategori-cctv-indoor">Kategori</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="login"> <i class="fas fa-user me-1 text-gray fw-normal"></i>Login</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>