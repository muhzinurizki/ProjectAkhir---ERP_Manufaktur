<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        $pr = PurchaseRequest::where('status', 'APPROVED')->with('items')->first();
        $supplier = Supplier::first();

        if (!$pr || !$supplier)
            return;

        $po = PurchaseOrder::create([
            'po_number' => 'PO-DEMO-001',
            'po_date' => now(),
            'purchase_request_id' => $pr->id,
            'supplier_id' => $supplier->id,
            'warehouse_id' => $pr->warehouse_id,
            'status' => 'DRAFT',
            'created_by' => 1,
        ]);

        foreach ($pr->items as $item) {
            PurchaseOrderItem::create([
                'purchase_order_id' => $po->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }
    }
}
