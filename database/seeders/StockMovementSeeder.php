<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockMovement;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\User;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $product = Product::first();
        $warehouse = Warehouse::first();

        if (!$user || !$product || !$warehouse) {
            $this->command->warn('Seeder Inventory dilewati: data master belum lengkap.');
            return;
        }

        // ======================
        // STOCK IN
        // ======================
        StockMovement::create([
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'type' => 'IN',
            'quantity' => 100,
            'reference' => 'INIT-STOCK',
            'note' => 'Initial stock setup',
            'created_by' => $user->id,
        ]);

        // ======================
        // STOCK OUT
        // ======================
        StockMovement::create([
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'type' => 'OUT',
            'quantity' => 30,
            'reference' => 'TEST-OUT',
            'note' => 'Test stock out',
            'created_by' => $user->id,
        ]);
    }
}
