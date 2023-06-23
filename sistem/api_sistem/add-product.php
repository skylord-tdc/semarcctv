<?php
include '../../../semarcctv/toko_online/koneksi/cf.php';

// Menyiapkan variabel untuk menyimpan nilai yang diterima dari form
$kategori_produk = $_POST['kategori_produk'];
$brand = $_POST['brand'];
$nm_produk = $_POST['nm_produk'];
$ket_produk = $_POST['ket_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// uuid
include 'func_uuid.php';
$randomUUID = generate_uuid();

// slug
//kita buat post slug dan mengganti spasi dengan tanda hubung(-)
$slug2 = preg_replace("/\s/", "-", $nm_produk);

// mengubah huruf besar ke kecil
$slug1 = strtolower($slug2);

// menghapus semua karakter unik dijudul
$slug = preg_replace("/[^a-zA-Z0-9 -]/", "", $slug1); // data siap post ke database
// end slug

// Menyiapkan pernyataan SQL untuk melakukan insert data ke dalam tabel
$sql = "INSERT INTO produk (uuid, slug, kategori_produk, brand, nm_produk, ket_produk, harga, stok_produk)
VALUES ('$randomUUID', '$slug', '$kategori_produk', '$brand', '$nm_produk', '$ket_produk', '$harga', '$stok')";

// Menjalankan pernyataan SQL
if (mysqli_query($conn, $sql)) {
    $produk_id = mysqli_insert_id($conn); // mendapatkan id produk yang baru ditambahkan
    $upload_directory = "../../toko_online/uploads/gambar_produk/"; // direktori penyimpanan gambar

    if (isset($_FILES['gambar_produk']) && is_array($_FILES['gambar_produk']['name'])) {
        $countfiles = count($_FILES['gambar_produk']['name']); // mendapatkan jumlah file yang diupload

        // Batasi jumlah file menjadi 4
        $max_files = 4;
        if ($countfiles > $max_files) {
            // echo "Jumlah file yang diupload tidak boleh lebih dari 4";
            session_start();
            $_SESSION["warning"] = '<div class="alert alert-warning"  role="alert" >File yang diupload tidak boleh lebih dari 4.</div>';
            echo "<script type='text/javascript'>
                            window.history.back()
                      </script>";
            exit;
        }

        // Looping untuk mengupload file dan menyimpan informasi gambar ke tabel gambar_produk
        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['gambar_produk']['name'][$i];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $newfilename = $produk_id . "_" . ($i + 1) . "." . $ext;
            $target_file = $upload_directory . $newfilename;

            // Validasi tipe file
            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
            if (!in_array($ext, $allowed_types)) {
                // echo "File yang diupload harus bertipe jpg, jpeg, png, atau gif";
                session_start();
                $_SESSION["warning"] = '<div class="alert alert-warning"  role="alert" >File yang diupload harus bertipe jpg, jpeg, png, atau gif.</div>';
                echo "<script type='text/javascript'>
                            window.history.back()
                      </script>";
                exit;
            }

            // Validasi ukuran file
            $max_size = 20 * 1024 * 1024; // 20 MB
            if ($_FILES['gambar_produk']['size'][$i] > $max_size) {
                // echo "Ukuran file tidak boleh lebih dari 20MB";
                session_start();
                $_SESSION["warning"] = '<div class="alert alert-warning"  role="alert" >Total file tidak boleh lebih dari 20 Mb.</div>';
                echo "<script type='text/javascript'>
                            window.history.back()
                      </script>";
                exit;
            }

            // Validasi apakah file gambar atau bukan
            $img_info = getimagesize($_FILES['gambar_produk']['tmp_name'][$i]);
            if (!$img_info) {
                // echo "File yang diupload bukan gambar";
                session_start();
                $_SESSION["danger"] = '<div class="alert alert-danger"  role="alert" >File dicekal, bukan gambar.</div>';
                echo "<script type='text/javascript'>
                            window.history.back()
                      </script>";
                exit;
            }

            // Menyimpan informasi gambar ke tabel gambar_produk
            $sql_gambar = "INSERT INTO gambar_produk (produk_id, nama_gambar) VALUES ('$produk_id', '$newfilename')";
            mysqli_query($conn, $sql_gambar);

            move_uploaded_file($_FILES['gambar_produk']['tmp_name'][$i], $target_file);

            // Ubah $produk_id agar sesuai dengan id produk yang baru saja diinsert
            $produk_id_baru = mysqli_insert_id($conn);
        }
    }


    // echo "Data berhasil ditambahkan ke dalam tabel";
    session_start();
    $_SESSION["success"] = '<div class="alert alert-success"  role="alert" >Produk berhasil di tambahkan.</div>';
    // echo "<script type='text/javascript'>
    //             window.history.back()
    //       </script>";
    header("Location: dashboard?page=products");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
