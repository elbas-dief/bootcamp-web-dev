<?php

namespace Database\Seeders;

use App\Models\categories;
use App\Models\products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsByCategory = [
            'Elektronik' => [
                ['Smartphone Android 5G', 'Smartphone layar AMOLED 6.7 inci dengan kamera 108MP', 4500000],
                ['Laptop Core i5', 'Laptop tipis 14 inci RAM 16GB SSD 512GB', 8900000],
                ['TWS Earbuds',           'Earbuds nirkabel dengan noise cancellation',             450000],
                ['Smartwatch',            'Jam tangan pintar monitor kesehatan GPS',                950000],
                ['Power Bank 20000mAh',  'Power bank fast charge kapasitas besar',                 350000],
            ],
            'Pakaian' => [
                ['Kaos Polos Cotton',    'Kaos unisex bahan cotton combed 30s',    85000],
                ['Kemeja Flannel',       'Kemeja flannel motif kotak-kotak',       175000],
                ['Celana Jeans Slim',    'Celana jeans slim fit pria',             250000],
                ['Jaket Hoodie',         'Hoodie fleece tebal unisex',             220000],
                ['Dress Casual Wanita',  'Dress casual bahan rayon motif bunga',   195000],
            ],
            'Buku' => [
                ['Clean Code',               'Panduan menulis kode bersih oleh Robert C. Martin', 150000],
                ['The Pragmatic Programmer', 'Buku wajib untuk programmer profesional',           165000],
                ['Atomic Habits',            'Cara membangun kebiasaan baik dan menghilangkan kebiasaan buruk', 120000],
                ['Deep Work',               'Strategi kerja fokus di era penuh distraksi',         115000],
                ['Sapiens',                 'Sejarah singkat umat manusia oleh Yuval Noah Harari', 130000],
            ],
            'Olahraga' => [
                ['Sepatu Lari',         'Sepatu lari ringan dengan sol EVA',             450000],
                ['Dumbbell Set 10kg',   'Set dumbbell besi dengan rubber coating',        320000],
                ['Yoga Mat',            'Matras yoga anti-slip tebal 6mm',                135000],
                ['Raket Badminton',     'Raket badminton carbon fiber lightweight',        280000],
                ['Tas Gym',             'Tas olahraga besar dengan kompartemen sepatu',   175000],
            ],
            'Rumah Tangga' => [
                ['Rice Cooker Digital', 'Rice cooker kapasitas 1.8L dengan timer',    350000],
                ['Blender Portable',   'Blender portable USB rechargeable',            180000],
                ['Lampu LED Smart',    'Lampu LED 12W dengan kontrol via smartphone',   125000],
                ['Rak Buku Minimalis', 'Rak buku 5 susun kayu jati minimalis',          420000],
                ['Bantal Memory Foam', 'Bantal ergonomis memory foam anti-nyeri leher', 210000],
            ],
        ];

        foreach ($productsByCategory as $categoryName => $products) {
            $category = categories::where('name', $categoryName)->firstOrFail();

            foreach ($products as [$name, $description, $price]) {
                products::firstOrCreate(
                    ['name' => $name],
                    [
                        'category_id'   => $category->id,
                        'description'   => $description,
                        'price'         => $price,
                        'stock'         => 20,
                    ]
                );
            }
        }
    }
}
