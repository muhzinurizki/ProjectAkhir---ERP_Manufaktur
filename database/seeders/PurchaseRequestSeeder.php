<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PurchaseRequestSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $warehouse = Warehouse::first();
        $products = Product::take(2)->get();

        if (!$user || !$warehouse || $products->count() < 1) {
            $this->command->warn('PurchaseRequestSeeder dilewati: master data belum lengkap.');
            return;
        }

        DB::transaction(function () use ($user, $warehouse, $products) {

            $pr = PurchaseRequest::create([
                'pr_number' => $this->generatePrNumber(),
                'request_date' => now()->toDateString(),
                'warehouse_id' => $warehouse->id,
                'status' => 'DRAFT',
                'requested_by' => $user->id,
                'note' => 'Seeder PR - kebutuhan awal',
            ]);

            foreach ($products as $product) {
                PurchaseRequestItem::create([
                    'purchase_request_id' => $pr->id,
                    'product_id' => $product->id,
                    'quantity' => rand(10, 50),
                    'note' => 'Seeder item',
                ]);
            }
        });
    }

    private function generatePrNumber(): string
    {
        $date = now()->format('Ymd');
        $count = PurchaseRequest::whereDate('created_at', today())->count() + 1;

        return 'PR-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
