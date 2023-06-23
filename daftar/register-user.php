<?php
session_start();

// Cek apakah pengguna sudah login dan jenis_akun nya bernilai
if (isset($_SESSION["user_id"]) && isset($_SESSION["jenis_akun"]) && $_SESSION["jenis_akun"] == 1) {
    header("location: belanja"); // Jika iya, lanjutkan ke halaman yang diinginkan atau stay
} else {
    echo '
    <!DOCTYPE html>
<html lang="en">

<head>
    <title>Register > Toko | Semar CCTV Semarang</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="daftar/images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="daftar/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="daftar/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="daftar/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="daftar/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="daftar/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="daftar/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="daftar/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="daftar/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="daftar/css/util.css">
    <link rel="stylesheet" type="text/css" href="daftar/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url(\'daftar/images/bg-register.jpg\');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Account Register
                </span>
                <div class="mb-3 text-dark text-center"><a href="login" class="login100-form-btn">Back to Login</a></div>

                <form class="login100-form validate-form p-b-33 p-t-5" action="new-account" method="post">

                    <div class="p-2 mb-0">';

    if (!empty($_SESSION["success"])) {
        echo $_SESSION["success"];
        unset($_SESSION["success"]);
    }

    if (!empty($_SESSION["warning"])) {
        echo $_SESSION["warning"];
        unset($_SESSION["warning"]);
    }

    if (!empty($_SESSION["danger"])) {
        echo $_SESSION["danger"];
        unset($_SESSION["danger"]);
    }

    echo '
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Enter name">
                        <input class="input100" type="text" name="name" placeholder="Name">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter email">
                        <input class="input100" type="email" name="email" placeholder="Email">
                        <span class="focus-input100" data-placeholder="&#xe818;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter WhatsApp">
                        <input class="input100" type="number" name="n_phone" placeholder="WhatsApp">
                        <span class="focus-input100" data-placeholder="&#xe830;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="pass" placeholder="New Password">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn">
                            Create
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="daftar/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="daftar/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="daftar/vendor/bootstrap/js/popper.js"></script>
    <script src="daftar/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="daftar/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="daftar/vendor/daterangepicker/moment.min.js"></script>
    <script src="daftar/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="daftar/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="daftar/js/main.js"></script>

</body>

</html>
    ';
    exit;
}
