<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menggunakan lokal Indonesia

        // Data spesifik industri tekstil sebagai basis
        $industries = [
            'Textile', 'Garment', 'Benang', 'Pewarna', 'Kain', 'Aksesoris', 'Logistik'
        ];

        $suffixes = [
            'Jaya', 'Makmur', 'Sejahtera', 'Indah', 'Pratama', 'Sentosa', 'Mandiri'
        ];

        // 1. Tambahkan 2-3 Data Tetap (Data Utama untuk Testing)
        $fixedSuppliers = [
            [
                'code' => 'SUP-TX-001',
                'name' => 'PT Indotex Utama Jaya',
                'contact_person' => 'Budi Santoso',
                'phone' => '0215551234',
                'email' => 'sales@indotex.co.id',
                'address' => 'Kawasan Industri Jababeka, Cikarang',
                'is_active' => true,
            ],
            [
                'code' => 'SUP-CH-002',
                'name' => 'CV Warna Kimia Mandiri',
                'contact_person' => 'Sari Wijaya',
                'phone' => '0224445678',
                'email' => 'info@warnakimia.com',
                'address' => 'Jl. Moch. Toha No. 45, Bandung',
                'is_active' => true,
            ],
        ];

        foreach ($fixedSuppliers as $fixed) {
            Supplier::updateOrCreate(['code' => $fixed['code']], $fixed);
        }

        // 2. Generate 15 Data Acak Tambahan
        for ($i = 1; $i <= 15; $i++) {
            $industry = $faker->randomElement($industries);
            $suffix = $faker->randomElement($suffixes);
            $type = $faker->randomElement(['PT', 'CV', 'UD']);
            $companyName = "$type $industry $suffix";

            Supplier::create([
                'code' => 'SUP-' . strtoupper($faker->bothify('??-###')),
                'name' => $companyName,
                'contact_person' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => strtolower(str_replace(' ', '', $companyName)) . '@' . $faker->safeEmailDomain,
                'address' => $faker->address,
                'is_active' => $faker->boolean(90), // 90% chance to be active
            ]);
        }
    }
}