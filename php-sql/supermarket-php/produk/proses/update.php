<?php 
require __DIR__ . '/../../config/koneksi.php';
session_start();

$id = $_POST['id'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stock = $_POST['stock'];
$kategori = $_POST['kategori'];

// $filename = $_FILES['image']['name'];
// $tmp_name = $_FILES['image']['tmp_name'];

// $image_name = time() . '_' . $filename;
// $target_dir = __DIR__ . '/../assets' . $image_name;

// move_uploaded_file($tmp_name, $target_dir);

$sql = "UPDATE products SET nama=?, harga=?, stock=?, kategori=? WHERE id=?" ;
$stmt = $conn->prepare($sql);
$stmt->execute([$nama, $harga, $stock, $kategori, $id]);

// $sql = "UPDATE products SET nama='$nama', harga=$harga, stock=$stock, kategori='$kategori' WHERE id=$id" ;
// $conn->query($sql);

$_SESSION['edit-sukses'] = "Produk berhasil diperbaharui";

header("Location: /produk/index.php")

?>