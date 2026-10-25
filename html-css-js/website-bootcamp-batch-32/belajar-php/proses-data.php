<?php
// var_dump($_POST['nama']);
// var_dump($_POST['gaji']);
// var_dump($_POST['posisi']);
// die();

$nama = $_POST['nama'];
$gaji = $_POST['gaji'];
$posisi = $_POST['posisi'];

$query("INSERT INTO staff (nama, gaji, posisi) 
    VALUES ($nama, $gaji, $posisi)");

?>


<h1>Test</h1>