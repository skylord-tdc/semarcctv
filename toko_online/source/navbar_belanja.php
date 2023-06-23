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
                        <!-- Link--><a class="nav-link active" href="belanja">Shop</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php
                    // session_start();
                    $_SESSION['user_id'];

                    $user_id = $_SESSION['user_id'];

                    include 'koneksi/cf.php';
                    //query SQL untuk mengambil data dari tabel users
                    $sql = "SELECT * FROM cart WHERE user_id='$user_id' ";
                    $result = mysqli_query($conn, $sql);

                    //menghitung jumlah data pada tabel users
                    $count = mysqli_num_rows($result);

                    ?>
                    <li class="nav-item"><a class="nav-link" href="keranjang-belanja"> <i class="fas fa-dolly-flatbed me-1 text-gray"></i>Keranjang<small class="text-gray fw-normal">(<?php echo $count; ?>)</small></a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1 text-gray fw-normal"></i><?php echo $_SESSION['nama']; ?>
                        </a>
                        <ul class="dropdown-menu" style="width: 10%;">
                            <li><a class="dropdown-item" href="logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>