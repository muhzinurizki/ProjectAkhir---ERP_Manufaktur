<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WarehouseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $warehouses = [
            [
                'code' => 'WH-RM-01',
                'name' => 'Raw Material Warehouse (Bahan Baku)',
                'address' => 'Area Utara - Gedung A1 (Dekat Loading Dock)',
                'is_active' => true,
                'description' => 'Penyimpanan benang, zat warna, dan bahan kimia.',
            ],
            [
                'code' => 'WH-WIP-01',
                'name' => 'Work In Process Warehouse',
                'address' => 'Lantai 2 - Samping Area Weaving',
                'is_active' => true,
                'description' => 'Penyimpanan kain mentah (Grey fabric) hasil tenun.',
            ],
            [
                'code' => 'WH-FG-01',
                'name' => 'Finished Goods Warehouse',
                'address' => 'Gedung B - Area Distribusi Utama',
                'is_active' => true,
                'description' => 'Penyimpanan kain jadi yang sudah siap kirim.',
            ],
            [
                'code' => 'WH-TRN-01',
                'name' => 'Transit Warehouse',
                'address' => 'Gedung C - Area Bongkar Muat',
                'is_active' => true,
                'description' => 'Gudang sementara untuk inspeksi barang masuk.',
            ],
            [
                'code' => 'WH-REJ-01',
                'name' => 'Reject & Return Warehouse',
                'address' => 'Sudut Barat Pabrik',
                'is_active' => true,
                'description' => 'Penyimpanan barang cacat atau sisa produksi (BS).',
            ],
            [
                'code' => 'WH-SPP-01',
                'name' => 'Sparepart & Utility Warehouse',
                'address' => 'Workshop Maintenance',
                'is_active' => true,
                'description' => 'Penyimpanan suku cadang mesin produksi.',
            ],
        ];

        foreach ($warehouses as $wh) {
            // Menggunakan updateOrCreate agar tidak duplikat saat seeding ulang
            Warehouse::updateOrCreate(
                ['code' => $wh['code']],
                [
                    'name' => $wh['name'],
                    'address' => $wh['address'],
                    'is_active' => $wh['is_active'],
                    // Jika migrasi Anda punya kolom description, ini akan terisi
                    // Jika tidak, hapus baris di bawah ini
                    // 'description' => $wh['description'],
                ]
            );
        }

        // Opsional: Tambahkan beberapa gudang cabang kecil secara acak jika diperlukan
        for ($i = 1; $i <= 3; $i++) {
            Warehouse::create([
                'code' => 'WH-EXT-0' . $i,
                'name' => 'External Warehouse ' . $faker->city,
                'address' => $faker->address,
                'is_active' => $faker->boolean(80),
            ]);
        }
    }
}