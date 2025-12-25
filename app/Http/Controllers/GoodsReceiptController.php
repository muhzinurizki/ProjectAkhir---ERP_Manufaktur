<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceipt;
use App\Models\GoodsReceiptItem;
use App\Models\PurchaseOrder;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GoodsReceiptController extends Controller
{
    /* =======================
     |  LIST GOODS RECEIPT
     ======================= */
    public function index()
    {
        $receipts = GoodsReceipt::with(['purchaseOrder', 'warehouse'])
            ->latest()
            ->paginate(15);

        return view('goods-receipts.index', compact('receipts'));
    }

    /* =======================
     |  CREATE FORM
     ======================= */
    public function create()
    {
        $purchaseOrders = PurchaseOrder::with(['items.product', 'warehouse'])
            ->where('status', 'APPROVED')
            ->whereHas('items', function ($q) {
                $q->whereColumn('received_quantity', '<', 'quantity');
            })
            ->get();

        return view('goods-receipts.create', compact('purchaseOrders'));
    }

    /* =======================
     |  STORE (RECEIVING + STOCK IN)
     ======================= */
    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'gr_date' => 'required|date',
            'note' => 'nullable|string',

            'items' => 'required|array|min:1',
            'items.*.purchase_order_item_id' => 'required|exists:purchase_order_items,id',
            'items.*.quantity' => 'required|numeric|min:0.0001',
        ]);

        DB::transaction(function () use ($data) {

            $po = PurchaseOrder::with('items')->lockForUpdate()->findOrFail($data['purchase_order_id']);

            // Guard: PO harus APPROVED
            if ($po->status !== 'APPROVED') {
                throw new \Exception('PO tidak valid untuk Goods Receipt');
            }

            $gr = GoodsReceipt::create([
                'gr_number' => $this->generateGrNumber(),
                'gr_date' => $data['gr_date'],
                'purchase_order_id' => $po->id,
                'warehouse_id' => $po->warehouse_id,
                'received_by' => Auth::id(),
                'note' => $data['note'] ?? null,
            ]);

            foreach ($data['items'] as $row) {

                $poItem = $po->items->firstWhere('id', $row['purchase_order_item_id']);
                if (!$poItem) {
                    throw new \Exception('Item PO tidak ditemukan');
                }

                $remaining = $poItem->quantity - $poItem->received_quantity;

                if ($row['quantity'] > $remaining) {
                    throw new \Exception('Qty diterima melebihi sisa PO');
                }

                // Simpan GR Item
                GoodsReceiptItem::create([
                    'goods_receipt_id' => $gr->id,
                    'purchase_order_item_id' => $poItem->id,
                    'product_id' => $poItem->product_id,
                    'quantity' => $row['quantity'],
                ]);

                // Update received qty di PO
                $poItem->increment('received_quantity', $row['quantity']);

                // STOCK IN
                InventoryMovement::create([
                    'product_id' => $poItem->product_id,
                    'warehouse_id' => $po->warehouse_id,
                    'type' => 'IN',
                    'quantity' => $row['quantity'],
                    'reference_type' => 'GOODS_RECEIPT',
                    'reference_id' => $gr->id,
                ]);
            }

            // Auto close PO jika semua item sudah diterima
            $allReceived = $po->items()->whereColumn('received_quantity', '<', 'quantity')->doesntExist();
            if ($allReceived) {
                $po->update(['status' => 'CLOSED']);
            }
        });

        return redirect()
            ->route('goods-receipts.index')
            ->with('success', 'Goods Receipt berhasil disimpan dan stok bertambah');
    }

    /* =======================
     |  SHOW DETAIL
     ======================= */
    public function show(GoodsReceipt $goodsReceipt)
    {
        $goodsReceipt->load(['items.product', 'purchaseOrder', 'warehouse', 'receiver']);
        return view('goods-receipts.show', compact('goodsReceipt'));
    }

    /* =======================
     |  HELPER: GR NUMBER
     ======================= */
    private function generateGrNumber(): string
    {
        $date = now()->format('Ymd');
        $count = GoodsReceipt::whereDate('created_at', today())->count() + 1;

        return 'GR-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
