<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsReceipt extends Model
{
    protected $fillable = [
        'gr_number',
        'gr_date',
        'purchase_order_id',
        'warehouse_id',
        'received_by',
        'note',
    ];

    protected $casts = [
        'gr_date' => 'date',
    ];

    /* =======================
     |  RELATIONS
     ======================= */

    public function items()
    {
        return $this->hasMany(GoodsReceiptItem::class);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    /* =======================
     |  DOMAIN LOGIC
     ======================= */

    /**
     * Cek apakah GR boleh dibuat dari PO ini
     */
    public static function canReceive(PurchaseOrder $po): bool
    {
        return $po->status === 'APPROVED'
            && $po->items()->whereColumn('received_quantity', '<', 'quantity')->exists();
    }
}
