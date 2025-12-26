<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
  // Pastikan fillable sudah diatur
  protected $fillable = [
    'product_id',
    'warehouse_id',
    'quantity',
    'reference',
    'type',
    'created_by',
  ];

  /**
   * Relasi ke Product
   */
  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }

  /**
   * Relasi ke Warehouse (Tambahkan juga sekalian agar tidak error nanti)
   */
  public function warehouse(): BelongsTo
  {
    return $this->belongsTo(Warehouse::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  /**
   * Static method untuk mendapatkan stok saat ini
   */
  public static function getStock($productId, $warehouseId)
  {
    $in = self::where('product_id', $productId)
              ->where('warehouse_id', $warehouseId)
              ->where('type', 'IN')
              ->sum('quantity');

    $out = self::where('product_id', $productId)
              ->where('warehouse_id', $warehouseId)
              ->where('type', 'OUT')
              ->sum('quantity');

    return $in - $out;
  }

  /**
   * Static method untuk mendapatkan stok saat ini berdasarkan StockMutation
   */
  public static function getStockFromMutation($productId, $warehouseId)
  {
    $lastMutation = StockMutation::where('item_type', 'product')
                                 ->where('item_id', $productId)
                                 ->where('warehouse_id', $warehouseId)
                                 ->latest('created_at')
                                 ->first();

    return $lastMutation ? $lastMutation->balance_after : 0;
  }

  /**
   * Static method untuk mendapatkan stok saat ini dengan pendekatan konsisten
   */
  public static function getCurrentStock($productId, $warehouseId)
  {
    // Kita gunakan pendekatan berdasarkan StockMutation terakhir jika tersedia
    // karena itu mencerminkan balance_after yang akurat
    $lastMutation = StockMutation::where('item_type', 'product')
                                 ->where('item_id', $productId)
                                 ->where('warehouse_id', $warehouseId)
                                 ->latest('created_at')
                                 ->first();

    if ($lastMutation) {
        return $lastMutation->balance_after;
    }

    // Jika tidak ada mutasi, hitung dari StockMovement
    $in = self::where('product_id', $productId)
              ->where('warehouse_id', $warehouseId)
              ->where('type', 'IN')
              ->sum('quantity');

    $out = self::where('product_id', $productId)
              ->where('warehouse_id', $warehouseId)
              ->where('type', 'OUT')
              ->sum('quantity');

    return $in - $out;
  }

  /**
   * Static method untuk mendapatkan stok berdasarkan StockMovement saja (lama)
   */
  public static function getStockBasedOnMovement($productId, $warehouseId)
  {
    $in = self::where('product_id', $productId)
              ->where('warehouse_id', $warehouseId)
              ->where('type', 'IN')
              ->sum('quantity');

    $out = self::where('product_id', $productId)
              ->where('warehouse_id', $warehouseId)
              ->where('type', 'OUT')
              ->sum('quantity');

    return $in - $out;
  }
}