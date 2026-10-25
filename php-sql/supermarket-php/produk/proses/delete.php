<?php

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header ("location: /produk/index.php");
};

require __DIR__ . '/../../config/koneksi.php';
session_start();

// $id = $_GET['id'];
$id = $_POST['id'];
$sql = "DELETE FROM products WHERE id=$id";
$conn->query($sql);

$_SESSION['delete-sukses'] = "Produk berhasil dihapus";

header ("location: /produk/index.php");

?>