<?php 

$hostname = 'aws-0-ap-southeast-1.pooler.supabase.com';
$username = 'postgres.fjuriujuzkmumcbeairl';
$password = "grahabakti2026";
$database = "postgres";
$port = 6543;

try {
    $dsn = "pgsql:host=$hostname;port=$port;dbname=$database;";
    $conn = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("koneksi gagal: " . $e->getMessage());
}

$sql = "SELECT * FROM pesan";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll();

// var_dump($result[0]);

?>