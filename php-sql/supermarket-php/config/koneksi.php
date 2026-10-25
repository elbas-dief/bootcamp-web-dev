<?php 
// Digunakan untuk konfigurasi database yang digunakan oleh aplikasi
$hostname = 'localhost';
$username ='root';
$password = '';
$database = 'belajar_sql';
$port = 3306;

$conn = new mysqli($hostname, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("connection to database failed:" . $conn->connect_error);
}

// $sql = "SELECT * FROM products";
// $result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

// var_dump($result[0]['nama'])

?>