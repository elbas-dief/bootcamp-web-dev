<?php
require __DIR__ . '/../../config/koneksi.php';
session_start();

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stock = $_POST['stock'];
$kategori = $_POST['kategori'];
$file = $_FILES['image'];

//Output dari $_FILES['image];
// $_FILES['image'] = [
//    'name'     => 'laskar_pelangi.jpg', // Nama asli file di komputer user
//    'full_path'=> 'laskar_pelangi.jpg',
//    'type'     => 'image/jpeg',        // MIME type (dikirim browser)
//    'tmp_name' => '/tmp/phpYtR8wX',    // Lokasi & nama file sementara di server
//    'error'    => 0,
//    'size'     => 154200               // Ukuran dalam byte
// ];

// Validasi image terlebih dahulu!

// Cek apakah image ada atau tidak
if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
    // kembalikan user ke dalam halaman create
    $_SESSION['error'] = "File image tidak ada"; // Buat dulu session error untuk ditampilkan di depan
    header("Location: {$_SERVER['HTTP_REFERER']}"); // gunakan session untuk flash error
}

// Validasi apakah yang dikirim image atau bukan
$info = getimagesize($file['tmp_name']);
if ($info === false) {
    $_SESSION['error'] = "File bukan gambar";
    header("Location: {$_SERVER['HTTP_REFERER']}?message=not an image");
}

// Validasi apakah format yang dikirim sesuai (jpg, jpeg, webp, png)
$allowed_types = [
    IMAGETYPE_JPEG => 'jpeg',
    IMAGETYPE_WEBP => 'webp',
    IMAGETYPE_PNG => 'png',
];

// $info[2] menyimpan extension image dalam bentuk angka
if (!array_key_exists($info[2], $allowed_types)) {
    // Jika format yang diberikan, itu tidak ada di dalam $allowed_types, maka kembalikan
    header("Location: {$_SERVER['HTTP_REFERER']}?message=type_not_allowed");
}

// File Naming & Storing

$filename = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];

$tipe = pathinfo($filename, PATHINFO_EXTENSION);
$image_name = 'produk_' . time() . '.' . $tipe;
$target_dir = __DIR__ . '/../../assets/produk/' . $image_name;

move_uploaded_file($tmp_name, $target_dir);

$sql = "INSERT INTO products(nama, harga, stock, kategori, image) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$nama, $harga, $stock, $kategori, $image_name]);

$_SESSION['registrasi-sukses'] = "Produk berhasil ditambahkan";

// $conn->query($sql);

header("Location: /produk/index.php");
?>