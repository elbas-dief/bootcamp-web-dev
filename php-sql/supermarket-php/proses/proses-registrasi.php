<?php 

require __DIR__ . '/../config/koneksi.php';

session_start();

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];

$hash_password = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO users(username, password, nama_lengkap) VALUES(?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$username, $hash_password, $fullname]);

$_SESSION['registrasi-sukses'] = "Registrasi berhasil";

header('Location: /login.php');

?>