<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Unit;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Pastikan Master Data (Category & Unit) sudah ada sebelum running ini
        // Kita ambil ID secara dinamis agar lebih aman
        $rawMaterial = ProductCategory::where('code', 'RAW')->first();
        $semiFinished = ProductCategory::where('code', 'SEMI')->first();
        $finished = ProductCategory::where('code', 'FIN')->first();

        $meters = Unit::where('code', 'MTR')->first();
        $kg = Unit::where('code', 'KG')->first();
        $pcs = Unit::where('code', 'PCS')->first();

        $products = [
            // RAW MATERIALS (Bahan Baku)
            [
                'sku' => 'YRN-C30S-WHT',
                'name' => 'Yarn Cotton Combed 30s White',
                'product_category_id' => $rawMaterial?->id ?? 1,
                'unit_id' => $kg?->id ?? 1,
                'type' => 'raw_material',
                'specification' => '100% Cotton, Grade A, High Quality',
                'selling_price' => 0, // Bahan baku biasanya tidak dijual langsung
                'is_active' => true,
            ],
            [
                'sku' => 'DYE-REAC-BLU',
                'name' => 'Reactive Dye Blue Ocean',
                'product_category_id' => $rawMaterial?->id ?? 1,
                'unit_id' => $kg?->id ?? 1,
                'type' => 'raw_material',
                'specification' => 'Chemical Dye for Cotton',
                'selling_price' => 0,
                'is_active' => true,
            ],

            // SEMI FINISHED (Kain Mentah/Grey)
            [
                'sku' => 'FAB-GRY-C30S',
                'name' => 'Grey Fabric Cotton 30s',
                'product_category_id' => $semiFinished?->id ?? 2,
                'unit_id' => $meters?->id ?? 2,
                'type' => 'semi_finished',
                'specification' => 'Width 72 inch, GSM 140-150',
                'selling_price' => 45000,
                'is_active' => true,
            ],

            // FINISHED GOODS (Kain Jadi / Pakaian)
            [
                'sku' => 'FAB-FIN-C30S-NVY',
                'name' => 'Finished Fabric Cotton 30s Navy Blue',
                'product_category_id' => $finished?->id ?? 3,
                'unit_id' => $meters?->id ?? 2,
                'type' => 'finished_goods',
                'specification' => 'Reactive Dyed, Soft Finish, Width 72 inch',
                'selling_price' => 95000,
                'is_active' => true,
            ],
            [
                'sku' => 'TSH-PLN-BLK-L',
                'name' => 'Plain T-Shirt Black Size L',
                'product_category_id' => $finished?->id ?? 3,
                'unit_id' => $pcs?->id ?? 3,
                'type' => 'finished_goods',
                'specification' => 'Cotton Combed 30s, Standard Fit',
                'selling_price' => 125000,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['sku' => $product['sku']], // Cek berdasarkan SKU agar tidak duplikat
                $product
            );
        }
    }
}