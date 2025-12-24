<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run()
    {
        Unit::insert([
            ['code'=>'kg','name'=>'Kilogram'],
            ['code'=>'m','name'=>'Meter'],
            ['code'=>'pcs','name'=>'Pieces'],
            ['code'=>'roll','name'=>'Roll'],
        ]);
    }
}

