<?php
require __DIR__ . '/config/koneksi.php';
require __DIR__ . '/templates/header.php';

// Search

$search = trim($_GET['search'] ?? '');
$where = '';

$param = '';

if ($search !== '') {
    $where = "WHERE nama LIKE ?";
    $param = "%$search%";
}

// if ($search !== '') {
//     $searchEscaped = $conn->real_escape_string($search);
//     $where = "WHERE nama LIKE '%" . $searchEscaped . "%'";
// }

// Ambil Data Produk Keseluruhan
$sql = "SELECT * FROM products $where";
$stmt = $conn->prepare($sql);

if ($param) {
    $stmt->bind_param('s', $param);
    }

$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// $sqlSearch = "SELECT COUNT(*) as Total FROM products $where";
$sqlSearch = "SELECT COUNT(*) as Total FROM products";
$resultSearch = $conn->query($sqlSearch)->fetch_assoc()['Total'];

// Paginasi

$perHalaman = 10;
$halaman = (int) ($_GET['halaman'] ?? '');
if ($halaman < 1) {
    $halaman = '';
}

$sqlTotal = "SELECT COUNT(*) as Total FROM products";
$totalData = (int) $conn->query($sqlTotal)->fetch_assoc()['Total'];

// $totalHalaman = ceil($totalData / $perHalaman);
$totalHalaman = ($search = $search) ? ceil((int) $resultSearch / $perHalaman) : ceil($totalData / $perHalaman);
$offset = '';
if ($halaman >= 1) {
    $offset = ($halaman - 1) * $perHalaman;
} else {
    $offset = 0;
}

// Ambil Data Produk yang sudah di LIMIT/OFFSET

$sqlOffset = "SELECT * FROM products $where
            LIMIT $perHalaman OFFSET $offset";
$pageList = $conn->query($sqlOffset)->fetch_all(MYSQLI_ASSOC);

$produkList = '';

// if ($halaman >= 1) {
//     $produkList = $pageList;
// } else {
//     $produkList = $result;
// }

($halaman >= 1) ? $produkList = $pageList : $produkList = $result;

// echo (int) $resultSearch;

// SESSION

// var_dump($_SESSION);

?>
<main>
    <h1 style="text-align: center; margin-bottom:30px; font-weight:bold;">Mau Beli Apa Hari Ini?</h1>
    <section>
        <div class="top-bar container">
            <!-- Page -->
            <div class="page pagination">
                <?php for ($i = 1; $i <= $totalHalaman; $i++): ?>
                    <a href="?halaman=<?= $i; ?>&search=<?= urlencode($search) ?>" name="halaman" class="page-link page-item <?= ($i === $halaman) ? 'active' : '' ?>"><?= $i; ?></a>
                <?php endfor; ?>
            </div>

            <!-- Search -->
            <form action="" class="d-flex gap-3 search">
                <!-- <input type="text" name="search" class="form-control" placeholder="Cari produk..."> -->
                <!-- <a href="?halaman=1&search=" type="submit" class="btn btn-primary" name="search">Search</a> -->
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= $search; ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div style="padding:0px 14px; align-items:end;">
            <div style="background-color: #e3e3e3; height:2px; border-radius:5px; width:auto"></div>
        </div>

        <!-- Produk Card -->

        <ul class="product-list container">
            <?php foreach ($produkList as $produk): ?>
                <!-- Build Image Path -->
                <?php
                $image_path = $produk['image'] != NULL ? "./assets/produk/{$produk['image']}" : $img_placeholder;
                ?>

                <li class="card p-2 gap-1">
                    <img src="<?= $image_path; ?>" alt="<?= $produk['image']; ?>" class="image-product"><br>
                    <div class="nama-harga">
                        <!-- Attack Defender -->
                        <div class="nama" style="font-weight: bold; text-align:start"> <?= htmlspecialchars($produk['nama']); ?> </div>
                        <div class="harga" style="font-weight:bold; color:green; margin-bottom:8px; text-align:end; min-width:max-content; margin-left:4px"> Rp <?= number_format($produk['harga'], 0, ",", "."); ?> </div>
                    </div>
                    <?php

                    // Perbedaan Page Login dan Logout
                    
                    $produkLogin = <<<HTML
                    <div class="card-action">
                        <button class="btn btn-primary" style="width: 100%">Buy</button>
                        <a href="/produk/edit.php?id={$produk['id']}" class="card-item btn btn-warning" style="width: 100%">Edit</a>
                        <a href="/produk/proses/delete.php?id={$produk['id']}" class="card-item btn btn-danger" style="width: 100%">Delete</a>
                    </div>
                    HTML;

                    $produkLogout = <<<HTML
                    <div class="card-action">
                        <button class="btn btn-primary" style="width: 100%">Buy</button>
                    </div>
                    HTML;
                    
                    if (isset($_SESSION['is_logged_in']) && $_SESSION ['is_logged_in']) {
                        echo $produkLogin;
                    } else {
                        echo $produkLogout;
                    };

                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<!-- Next Tugas bikin card produk -->

<?php
require __DIR__ . '/templates/footer.php';
?>