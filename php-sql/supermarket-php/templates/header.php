<?php

function cekLogin()
{
  if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header('location: /login.php');
    return;
  }
}

$img_placeholder = "https://www.svgrepo.com/show/508699/landscape-placeholder.svg";
$list_kategori = ['Buah', 'Sayur', 'Minuman', 'Sembako', 'Sabun', 'Snack', 'Bumbu'];

session_start();
// echo $_SESSION['nama_lengkap'];

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $judul ?? "Toko Sederhana" ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/toko-sederhana/index.php">Toko Sederhana</a>
      
      <?php
      $logoutBar = <<<HTML
      <div>
        <a class="btn btn-sm btn-light" href="/index.php">Home</a>
        <a class="btn btn-sm btn-success" href="/login.php">Login</a>
      </div>
      HTML;

      $loginBar = <<<HTML
      <div>
        <a class="btn btn-sm btn-light" href="/index.php">Home</a>
        <a class="btn btn-sm btn-outline-light" href="/produk/index.php">Produk</a>
        <a class="btn btn-sm btn-danger" href="/proses/proses-logout.php">Logout</a>
      </div>
      HTML;

      if (isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in']) {
        echo $loginBar;
      } else {
        echo $logoutBar;
      }
      ?>

    </div>
  </nav>

  <div class="container py-4">