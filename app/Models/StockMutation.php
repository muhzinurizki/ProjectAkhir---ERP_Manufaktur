<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StockMutation extends Model
{
  protected $fillable = [
    'item_type',      // Contoh: 'App\Models\Product'
    'item_id',
    'warehouse_id',
    'mutation_type',  // IN (Masuk) atau OUT (Keluar)
    'reference_type', // Contoh: 'App\Models\GoodsReceipt' atau 'App\Models\StockOpname'
    'reference_id',
    'qty',
    'balance_before', // Stok sebelum transaksi
    'balance_after',  // Stok sesudah transaksi
    'created_by',
    'note'
  ];

  protected $casts = [
    'qty' => 'decimal:3',
    'balance_before' => 'decimal:3',
    'balance_after' => 'decimal:3',
  ];

  /**
   * Relasi Polymorphic ke Item (Bisa Product, Yarn, Fabric, dll)
   * Image of a polymorphic relationship diagram in Laravel showing one model linking to multiple other models
   */

  public function item(): MorphTo
  {
    return $this->morphTo('item', 'item_type', 'item_id');
  }

  /**
   * Relasi Polymorphic ke Dokumen Sumber (PO, GR, Sales, Opname)
   */
  public function reference(): MorphTo
  {
    return $this->morphTo('reference', 'reference_type', 'reference_id');
  }

  public function warehouse(): BelongsTo
  {
    return $this->belongsTo(Warehouse::class);
  }

  public function creator(): BelongsTo
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  /**
   * Helper: Mengecek apakah mutasi ini menambah stok
   */
  public function isAddition(): bool
  {
    return $this->mutation_type === 'IN';
  }
}