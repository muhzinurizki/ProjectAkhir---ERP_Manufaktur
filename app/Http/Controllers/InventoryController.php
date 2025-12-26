<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use App\Models\StockMovement;
use App\Models\StockMutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
  /* =======================
   |  LIST MOVEMENTS
   ======================= */
  public function index()
  {
    $movements = StockMovement::with(['product', 'warehouse', 'user'])
      ->latest()
      ->paginate(15);

    return view('inventory.index', compact('movements'));
  }

  /* =======================
   |  STOCK IN
   ======================= */
  public function createIn()
  {
    return view('inventory.stock-in', [
      'products' => Product::where('is_active', true)->get(),
      'warehouses' => Warehouse::where('is_active', true)->get(),
    ]);
  }

  public function storeIn(Request $request)
  {
    $request->validate([
      'product_id' => 'required|exists:products,id',
      'warehouse_id' => 'required|exists:warehouses,id',
      'quantity' => 'required|numeric|min:1',
      'reference' => 'required|string|max:100',
    ]);

    $stockMovement = StockMovement::create([
      'product_id' => $request->product_id,
      'warehouse_id' => $request->warehouse_id,
      'quantity' => $request->quantity,
      'reference' => $request->reference,
      'type' => 'IN',
      'created_by' => auth()->id(), // 🔥 INI KUNCINYA
    ]);

    // Hitung stok sebelum transaksi berdasarkan mutasi sebelumnya
    $previousMutation = StockMutation::where('item_type', 'product')
      ->where('item_id', $request->product_id)
      ->where('warehouse_id', $request->warehouse_id)
      ->latest('created_at')
      ->first();

    $balanceBeforeValue = $previousMutation ? $previousMutation->balance_after : 0;
    $balanceAfterValue = $balanceBeforeValue + $request->quantity;

    // Buat StockMutation
    StockMutation::create([
      'item_type' => 'product',
      'item_id' => $request->product_id,
      'warehouse_id' => $request->warehouse_id,
      'mutation_type' => 'IN',
      'qty' => $request->quantity,
      'balance_before' => $balanceBeforeValue,
      'balance_after' => $balanceAfterValue,
      'reference_type' => \App\Models\StockMovement::class,
      'reference_id' => $stockMovement->id,
      'created_by' => auth()->id(),
      'note' => $request->reference,
    ]);

    return redirect()
      ->route('inventory.index')
      ->with('success', 'Stock berhasil ditambahkan.');
  }

  /* =======================
   |  STOCK OUT
   ======================= */
  public function createOut()
  {
    return view('inventory.stock-out', [
      'products' => Product::where('is_active', true)->get(),
      'warehouses' => Warehouse::where('is_active', true)->get(),
    ]);
  }

  public function storeOut(Request $request)
  {
    $data = $request->validate([
      'product_id' => 'required|exists:products,id',
      'warehouse_id' => 'required|exists:warehouses,id',
      'quantity' => 'required|numeric|min:0.0001',
      'reference' => 'nullable|string|max:255',
      'note' => 'nullable|string',
    ]);

    $currentStock = StockMovement::getCurrentStock(
      $data['product_id'],
      $data['warehouse_id']
    );

    if ($currentStock < $data['quantity']) {
      return back()
        ->withErrors(['quantity' => 'Stok tidak mencukupi'])
        ->withInput();
    }

    DB::transaction(function () use ($data) {
      $stockMovement = StockMovement::create([
        ...$data,
        'type' => 'OUT',
        'created_by' => Auth::id(),
      ]);

      // Hitung stok sebelum transaksi berdasarkan mutasi sebelumnya
      $previousMutation = StockMutation::where('item_type', 'product')
        ->where('item_id', $data['product_id'])
        ->where('warehouse_id', $data['warehouse_id'])
        ->latest('created_at')
        ->first();

      $balanceBeforeValue = $previousMutation ? $previousMutation->balance_after : 0;
      $balanceAfterValue = $balanceBeforeValue - $data['quantity'];

      // Buat StockMutation
      StockMutation::create([
        'item_type' => 'product',
        'item_id' => $data['product_id'],
        'warehouse_id' => $data['warehouse_id'],
        'mutation_type' => 'OUT',
        'qty' => $data['quantity'],
        'balance_before' => $balanceBeforeValue,
        'balance_after' => $balanceAfterValue,
        'reference_type' => \App\Models\StockMovement::class,
        'reference_id' => $stockMovement->id,
        'created_by' => Auth::id(),
        'note' => $data['note'] ?? null,
      ]);
    });

    return redirect()
      ->route('inventory.index')
      ->with('success', 'Stock OUT berhasil dicatat');
  }
}
