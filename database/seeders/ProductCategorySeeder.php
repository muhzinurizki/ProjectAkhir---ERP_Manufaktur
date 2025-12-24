<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// TAMBAHKAN baris di bawah ini:
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        // Gunakan create() atau tambahkan timestamp jika tetap ingin memakai insert()
        // Disarankan menggunakan koleksi data agar lebih bersih
        $categories = [
            [
                'code' => 'RAW',
                'name' => 'Raw Material',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'SEMI',
                'name' => 'Semi Finished',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'FIN',
                'name' => 'Finished Goods',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        ProductCategory::insert($categories);
    }
}