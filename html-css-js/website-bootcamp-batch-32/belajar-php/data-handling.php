<?php
echo $_GET['filter_kota'];
echo $_GET['contoh'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Data Handling</title>
</head>

<body>
    <form action="#">
        <input type="text" name="filter_kota">
        <button type="submit">Filter!</button>
    </form>

    <form action="./proses-data.php" method="post">
        <div>
            <label>Nama Pegawai</label>
            <input type="text" name="nama">
        </div>

        <div>
            <label>Gaji Pegawai</label>
            <input type="number" name="gaji">
        </div>

        <div>
            <label>Posisi Pegawai</label>
            <input type="text" name="posisi">
        </div>

        <button type="submit">Simpan</button>
    </form>
</body>

</html>