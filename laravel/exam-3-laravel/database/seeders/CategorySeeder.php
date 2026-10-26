<?php

namespace Database\Seeders;

use App\Models\categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories = [
            ['name' => 'Elektronik',   'description' => 'Perangkat elektronik dan gadget'],
            ['name' => 'Pakaian',      'description' => 'Pakaian pria dan wanita'],
            ['name' => 'Buku',         'description' => 'Buku fisik dan digital'],
            ['name' => 'Olahraga',     'description' => 'Peralatan dan perlengkapan olahraga'],
            ['name' => 'Rumah Tangga', 'description' => 'Peralatan dan dekorasi rumah'],
        ];

        foreach ($categories as $category) {
            categories::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
