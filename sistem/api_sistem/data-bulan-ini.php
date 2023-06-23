<?php
session_start();

// Cek apakah pengguna sudah login dan jenis_akun nya bernilai
if (isset($_SESSION["user_id"]) && isset($_SESSION["jenis_akun"]) && $_SESSION["jenis_akun"] == 0) {
    // Jika iya, lanjutkan ke halaman yang diinginkan atau stay
} else {
    header("location: login"); // Jika tidak, arahkan pengguna ke halaman login
    exit;
}

require('../FPDF/fpdf.php');

// koneksi ke database
include '../../../semarcctv/toko_online/koneksi/cf.php';

//TANGGAL SEKARANG
setlocale(LC_TIME, 'id_ID');
$date_now = strftime("%B %Y");

// membuat objek fpdf
$pdf = new FPDF();

// SetAutoPageBreak() untuk mengatur margin dan membuat halaman baru
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage('L');

// menambahkan judul halaman
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Data Pesanan Bulan Ini', 0, 1, 'C');

// membuat tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(145, 10, 'Nama Pelanggan', 1, 0, 'C');
$pdf->Cell(70, 10, 'Tanggal Pesanan', 1, 0, 'C');
$pdf->Cell(60, 10, 'Pesanan Yang Dibuat', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$query = mysqli_query($conn, "SELECT DISTINCT nm_pelangan, tanggal_pemesanan, COUNT(*) AS pesanan_yang_dibuat_bulan_ini
FROM pesanan
WHERE tanggal_pemesanan LIKE '%$date_now%'
GROUP BY nm_pelangan, tanggal_pemesanan;");
while ($data = mysqli_fetch_array($query)) {
    $pdf->Cell(145, 10, $data['nm_pelangan'], 1, 0, 'C');
    $pdf->Cell(70, 10, $data['tanggal_pemesanan'], 1, 0, 'C');
    $pdf->Cell(60, 10, $data['pesanan_yang_dibuat_bulan_ini'], 1, 1, 'C');

    $total_pesanan += $data['pesanan_yang_dibuat_bulan_ini'];
}

// menambahkan total keseluruhan pesanan bulan ini
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(215, 10, 'Total Keseluruhan Pesanan Bulan Ini', 1, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 10, $total_pesanan, 1, 1, 'C');

// menampilkan output
$output = $pdf->Output('S', 'data-bulan-ini');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Data_bulan_ini.pdf"');
echo $output;
exit;
