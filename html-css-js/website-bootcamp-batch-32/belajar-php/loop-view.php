<?php 
    $buah = ["Apel", "Jeruk", "Anggur", "Melon"];

    function rupiah($nominal) {
        return "Rp. " . number_format($nominal, 0, ",", ".");
    }
?>

<ul>
    <?php foreach($buah as $b): ?>
        <li class=""><?= $b; ?></li>
    <?php endforeach; ?>
    
    <?= rupiah(100000); ?>
    <?= rupiah(20000000000); ?>
    <?= rupiah(3931031310); ?>
    <?= rupiah(4848492.9000); ?>
    <?= rupiah(3217813813.33312); ?>
</ul>