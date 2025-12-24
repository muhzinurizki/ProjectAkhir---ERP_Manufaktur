<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use App\Models\StockMovement;
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
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity' => 'required|numeric|min:0.0001',
            'reference' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        StockMovement::create([
            ...$data,
            'type' => 'IN',
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Stock IN berhasil dicatat');
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

        $currentStock = StockMovement::getStock(
            $data['product_id'],
            $data['warehouse_id']
        );

        if ($currentStock < $data['quantity']) {
            return back()
                ->withErrors(['quantity' => 'Stok tidak mencukupi'])
                ->withInput();
        }

        StockMovement::create([
            ...$data,
            'type' => 'OUT',
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Stock OUT berhasil dicatat');
    }
}
