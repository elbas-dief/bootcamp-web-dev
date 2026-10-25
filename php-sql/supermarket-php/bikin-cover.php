<?php
// 1. Ukuran Gambar Cover (Lebar x Tinggi dalam piksel)
$width = 400;
$height = 600;

// 2. Buat Canvas Gambar
$image = imagecreatetruecolor($width, $height);

// 3. Tentukan Warna (RGB)
$bgColor    = imagecolorallocate($image, 41, 128, 185); // Biru Pelangi/Langit
$white      = imagecolorallocate($image, 255, 255, 255);
$yellow     = imagecolorallocate($image, 241, 196, 15);
$accentBg   = imagecolorallocate($image, 52, 73, 94);

// 4. Isi Warna Background
imagefill($image, 0, 0, $bgColor);

// 5. Tambahkan Elemen Dekorasi (Kotak Tengah)
imagefilledrectangle($image, 30, 30, $width - 30, $height - 30, $accentBg);

// 6. Tulis Teks (Judul, Penulis, Kategori)
// Catatan: Menggunakan font bawaan GD (skala 1-5)
$judul    = "LASKAR PELANGI";
$penulis  = "Karya: Andrea Hirata";
$kategori = "[ Novel - 2005 ]";

// Hitung posisi tengah sederhana
$fontJudul = 5;
$xJudul = ($width - (imagefontwidth($fontJudul) * strlen($judul))) / 2;
imagestring($image, $fontJudul, $xJudul, 200, $judul, $yellow);

$fontPenulis = 4;
$xPenulis = ($width - (imagefontwidth($fontPenulis) * strlen($penulis))) / 2;
imagestring($image, $fontPenulis, $xPenulis, 260, $penulis, $white);

$fontKat = 3;
$xKat = ($width - (imagefontwidth($fontKat) * strlen($kategori))) / 2;
imagestring($image, $fontKat, $xKat, 320, $kategori, $white);

// 7. Simpan Gambar ke File 'laskar_pelangi.jpg'
$outputPath = __DIR__ . '/assets/produk/laskar_pelangi.jpg'; // sesuaikan folder assets kamu

// Buat folder jika belum ada
if (!is_dir(__DIR__ . '/assets/produk')) {
    mkdir(__DIR__ . '/assets/produk', 0777, true);
}

imagejpeg($image, $outputPath, 90);

// 8. Hapus Memory Gambar
imagedestroy($image);

echo "Cover dummy berhasil dibuat di: " . $outputPath;
?>