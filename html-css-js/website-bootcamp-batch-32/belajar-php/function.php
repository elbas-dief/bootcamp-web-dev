<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .card {
            padding: 2em;
            border: gray solid 1px;
            margin: 0.5em;
        }
    </style>
</head>
<body>
    

<?php 
$pajak = 0.11;

function hitungPajak(int $harga, float $pajak){
    // global $pajak;
    return ($harga * $pajak) + $harga; 
}

function textComponent(string $text) {
    return "
        <div class='card'>$text</div>
    ";
}


?>
<h1>Total Pajak:  <?= hitungPajak(100000, 0.11); ?></h1>
<h1>Total Pajak:  <?= hitungPajak(200000, 0.12); ?></h1>


<?= textComponent('Beli sekarang!'); ?>
<?= textComponent('Beli nanti'); ?>
<?= textComponent('Beli besok'); ?>
<?= textComponent('Beli bulan ini'); ?>
<?= textComponent('Beli sekarang!'); ?>
<?= textComponent('Beli sekarang!'); ?>
</body>
</html>