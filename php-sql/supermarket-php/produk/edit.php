<?php
require __DIR__ . '/../config/koneksi.php';
require __DIR__ . '/../templates/header.php';

cekLogin();

// Ambil data dari $_GET
$id = $_GET['id'];


// Ambil produk
$sql = "SELECT * FROM products WHERE id=$id";
$produk = $conn->query($sql)->fetch_assoc();

?>

<!-- CSS -->
<link rel="stylesheet" href="/style.css">

<form action="/produk/proses/update.php" method="post" enctype="multipart/form-data" class="form-edit container">
    <input type="hidden" name="id" value="<?= $produk['id']; ?>">
    <div class="d-flex col gap-3 my-2">
        <label for="name" class="col-form-label col-3">Nama</label>
        <input type="text" name="nama" id="nama" value="<?= $produk['nama']; ?>" class="form-control">
    </div>
    <div class="d-flex col gap-3 my-2">
        <label for="harga" class="col-form-label col-3">Harga</label>
        <input type="number" name="harga" id="harga" value="<?= $produk['harga']; ?>" class="form-control">
    </div>
    <div class="d-flex col gap-3 my-2">
        <label for="stock" class="col-form-label col-3">Stock</label>
        <input type="number" name="stock" id="stock" value="<?= $produk['stock']; ?>" class="form-control">
    </div>
    <!-- <div>
        <label for="kategori">Kategori</label>
        <input type="number" name="kategori" id="kategori" value="" class="form-control">
    </div> -->
    <div class="d-flex col gap-3 my-2">
        <label for="kategori" class="col-form-label col-3">Kategori</label>
        <select name="kategori" id="kategori" value="" class="form-control">
            <!-- <option value="">-- Pilih Kategori --</option> -->
            <?php foreach ($list_kategori as $k): ?>
                <option value="<?= $k; ?>" <?= $produk['kategori'] == $k ? 'selected' : '' ;?>>
                    <?= $k; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <!-- <div>
        <label for="image">Upload Image</label>
        <input type="file" name="image" id="image">
    </div> -->
    <div style="display: flex; flex-direction:row; justify-content:end;">
        <button type="submit" class="my-2 btn btn-primary" style="width: 14%;">Update</button>
    </div>
</form>

<?php
// var_dump($produk);
require __DIR__ . '/../templates/footer.php';
?>