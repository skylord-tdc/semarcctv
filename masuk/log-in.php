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
		<title>Login > Toko | Semar CCTV Semarang</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->
		<link rel="icon" type="image/png" href="masuk/images/icons/favicon.png" />
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="masuk/vendor/bootstrap/css/bootstrap.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="masuk/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="masuk/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="masuk/vendor/animate/animate.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="masuk/vendor/css-hamburgers/hamburgers.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="masuk/vendor/animsition/css/animsition.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="masuk/vendor/select2/select2.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="masuk/vendor/daterangepicker/daterangepicker.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="masuk/css/util.css">
		<link rel="stylesheet" type="text/css" href="masuk/css/main.css">
		<!--===============================================================================================-->
	</head>

	<body>
	';

	include 'auth/pengecekan.php';
	echo '
	<div class="limiter">
		<div class="container-login100" style="background-image: url(\'masuk/images/bg-cctv.jpg\');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Login
				</span>
				<div class="mb-3 text-dark text-center"><a href="beranda" class="login100-form-btn">Back to Home</a></div>

				<form action="" method="post" class="login100-form validate-form p-b-33 p-t-5">
	';

	if (isset($_SESSION['pesan'])) {
		echo '<p class="mt-4 text-dark text-center">' . $_SESSION['pesan'] . '</p>';
		unset($_SESSION['pesan']);
	}

	echo '
					<div class="wrap-input100 validate-input" data-validate="Enter email">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xe818;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						
						<button class="login100-form-btn" name="submit">
                            Login
                        </button>
						
						<a href="register" class="login100-form-btn ml-2">Register</a>
					</div>
				</form>

			</div>
		</div>
	</div>
	';

	echo '
		<div id="dropDownSelect1"></div>

		<!--===============================================================================================-->
		<script src="masuk/vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script src="masuk/vendor/animsition/js/animsition.min.js"></script>
		<!--===============================================================================================-->
		<script src="masuk/vendor/bootstrap/js/popper.js"></script>
		<script src="masuk/vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script src="masuk/vendor/select2/select2.min.js"></script>
		<!--===============================================================================================-->
		<script src="masuk/vendor/daterangepicker/moment.min.js"></script>
		<script src="masuk/vendor/daterangepicker/daterangepicker.js"></script>
		<!--===============================================================================================-->
		<script src="masuk/vendor/countdowntime/countdowntime.js"></script>
		<!--===============================================================================================-->
		<script src="masuk/js/main.js"></script>

		<script>
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}
		</script>

	</body>

	</html>
	';
	exit;
}
