<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Latihan P8</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <style>
        .katalog {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 2em;
        }
    </style>
</head>

<body>
    <?php
    require "templates/header.php"
    ?>

    <h1 style="margin-top:20px; text-align:center; font-weight:bold">Katalog Produk</h1>

    <?php
    function price($nominal)
    {
        return "Rp. " . number_format($nominal, 0, ',', '.');
    }

    $daftarProduk = [
        ["nama" => "Laptop", "harga" => 9000000, "stok" => 3],
        ["nama" => "Mouse", "harga" => 250000, "stok" => 5],
        ["nama" => "Keyboard", "harga" => 500000, "stok" => 0],
        ["nama" => "Monitor", "harga" => 2000000, "stok" => 2],
        ["nama" => "Printer", "harga" => 500000, "stok" => 0],
        ["nama" => "Headset", "harga" => 100000, "stok" => 7],
    ];

    function barang(int $stokBarang)
    {
        if ($stokBarang > 0) { ?>
            <div class="btn btn-primary w-100">Buy</div>
        <?php
        } else { ?>
            <div class="btn btn-secondary w-100 disabled">Habis</div>
    <?php
        }
    }

    echo $_GET["kategori"];
    ?>

    <!-- <button class="btn btn-primary" name="aksesoris">Filter</button> -->

    <form action="#">
        <input type="text" name="kategori">
        <button type="submit">Filter!</button>
    </form>

    <div class="katalog container">

        <?php
        foreach ($daftarProduk as $p) { ?>

            <div class="card p-4 w-100" style="margin: 10px 30px 20px 30px; text-align:center">
                <h3><?= $p["nama"]; ?></h3>
                <p><?= price($p["harga"]); ?></p>
                <div> <?= barang($p["stok"]); ?></div>
            </div>
        <?php
        }

        ?>
    </div>

    <?php
    require "templates/footer.php"
    ?>

</body>

</html>