<?php

require __DIR__ . '/../config/koneksi.php';
require __DIR__ . '/../templates/header.php';

cekLogin();

$sql = "SELECT * FROM products";
$result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

if (isset($_SESSION['registrasi-sukses'])) { ?>
    <div class="alert alert-success">
        <?= $_SESSION['registrasi-sukses']; ?>
    </div>
<?php
    unset($_SESSION['registrasi-sukses']);
};

if (isset($_SESSION['edit-sukses'])) { ?>
    <div class="alert alert-success">
        <?= $_SESSION['edit-sukses']; ?>
    </div>
<?php
    unset($_SESSION['edit-sukses']);
};

if (isset($_SESSION['login-sukses'])) { ?>
    <div class="alert alert-success">
        <?= $_SESSION['login-sukses']; ?>
    </div>
<?php
    unset($_SESSION['login-sukses']);
};

if (isset($_SESSION['delete-sukses'])) { ?>
    <div class="alert alert-danger">
        <?= $_SESSION['delete-sukses']; ?>
    </div>
<?php
    unset($_SESSION['delete-sukses']);
};

?>

<!-- CSS -->
<link rel="stylesheet" href="/../style.css">

<!-- Konten -->
<main class="container">
    <h1 style="text-align: center;">Daftar Produk</h1>

    <div class="button-tambah-produk">
        <a href="/produk/create.php" class="btn btn-primary tambah-produk">+ Tambah Produk</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td style="text-align: left;"><?= $p['nama']; ?></td>
                    <td>
                        <div style="display: flex; flex-direction:row; justify-content:space-between;">
                            <span>Rp </span>
                            <span><?= number_format($p['harga'], 0, ',', '.'); ?></span>
                        </div>
                    </td>
                    <td><?= $p['stock']; ?></td>
                    <td class="d-flex col p-2 gap-2" style="justify-content: center;">

                        <!-- Tombol Edit     -->
                        <a href="/produk/edit.php?id=<?= $p['id']; ?>" class="card-item btn btn-warning" style="width: 100%;">
                            <i class="bi bi-pencil-square" style="color: #fff4d3;"></i>
                        </a>

                        <!-- Tombol Delete -->
                        <form action="/produk/proses/delete.php" method="POST" style="width: 100%;">
                            <input type="hidden" name="id" value="<?= $p['id']; ?>">
                            <button class="card-item btn btn-danger" style="width: 100%;" onclick="return confirm('Yakin ingin hapus produk ini?')" title="Peringatan: Tindakan ini tidak dapat dibatalkan!">
                                <i class="bi bi-trash-fill" style="color: #ff808d;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php

require __DIR__ . '/../templates/footer.php'

?>