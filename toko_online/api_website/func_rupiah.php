<?php
function format_rupiah($angka)
{
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}

// Contoh penggunaan
// $harga = 1234567;
// echo format_rupiah($harga); // Output: Rp 1.234.567
