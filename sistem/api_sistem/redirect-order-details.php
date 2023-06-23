<?php
$user_id = $_POST['user_id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

header("Location: dashboard?page=orders-details&nama=$nama&email=$email&no_hp=$no_hp&user_id=$user_id");
