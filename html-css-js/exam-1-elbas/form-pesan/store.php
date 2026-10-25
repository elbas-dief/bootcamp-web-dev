<?php 

require __DIR__ . '/config/connector.php';

$nama = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

if (isset($_POST['layanan']) && is_array($_POST['layanan'])) {
    $layanan = implode(',', $_POST['layanan']);
} elseif (isset($_POST['layanan'])) {
    $layanan = $_POST['layanan'];
} else {
    $layanan = '-';
}

$sql = "INSERT INTO pesan(nama, no_telp, email, layanan, pesan) VALUES('$nama', $phone, '$email', '$layanan', '$pesan')";
$conn->query($sql);

header('Location: /index.html');

?>