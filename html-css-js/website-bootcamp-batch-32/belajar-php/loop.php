<?php 
    $buah = ["Apel", "Jeruk", "Anggur", "Melon"];

    foreach($buah as $b) {
        echo "<p>Buah: $b</p>";
    }

    for ($i=0; $i < count($buah); $i++) { 
        echo "<p>Buah ke-$i: $buah[$i]</p>";
    }

    $count = 0;
    while($count <= 10) {
        echo "<p>$count</p>";
        $count += 2;
    }
?>

