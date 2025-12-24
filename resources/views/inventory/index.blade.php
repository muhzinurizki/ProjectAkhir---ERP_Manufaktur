@extends('layouts.app')

@section('title', 'Log Pergerakan Stok')
@section('page-title', 'Inventory Tracking')

@section('content')
<div class="space-y-8">
  {{-- Header & Action Section --}}
  <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
    <div>
      <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">
        <i data-lucide="activity" class="w-3 h-3"></i>
        <span>Inventory</span>
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <span class="text-slate-900">Stock Movements</span>
      </nav>
      <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Pergerakan Stok</h2>
      <p class="text-sm text-slate-500 font-medium mt-1">Audit trail lengkap untuk setiap mutasi barang masuk dan
        keluar.</p>
    </div>

    <div class="flex items-center gap-3">
      <a href="{{ route('inventory.stock-in') }}"
        class="flex items-center gap-2 px-5 py-3 bg-emerald-600 text-white rounded-2xl text-sm font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
        <i data-lucide="list-plus" class="w-4.5 h-4.5"></i>
        Stock In
      </a>
      <a href="{{ route('inventory.stock-out') }}"
        class="flex items-center gap-2 px-5 py-3 bg-rose-600 text-white rounded-2xl text-sm font-bold hover:bg-rose-700 transition-all shadow-lg shadow-rose-100">
        <i data-lucide="list-minus" class="w-4.5 h-4.5"></i>
        Stock Out
      </a>
    </div>
  </div>

  {{-- Stats Bar --}}
  <div
    class="bg-white p-4 rounded-[2rem] border border-slate-100 shadow-sm flex flex-wrap gap-4 items-center justify-between px-8">
    <div class="flex items-center gap-6">
      <div class="flex flex-col">
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Total Mutasi</span>
        <span class="text-lg font-bold text-slate-900">{{ $movements->total() }} Transaksi</span>
      </div>
      <div class="h-8 w-px bg-slate-100 ml-2"></div>
      <div class="flex flex-col">
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Periode</span>
        <span class="text-sm font-bold text-slate-600">{{ now()->format('F Y') }}</span>
      </div>
    </div>
    <div class="flex gap-2">
      <button
        class="flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-50 transition-all">
        <i data-lucide="filter" class="w-3.5 h-3.5"></i> Filter Data
      </button>
    </div>
  </div>

  {{-- Table Card --}}
  <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left border-separate border-spacing-0">
        <thead class="bg-slate-50/50 text-slate-400 uppercase text-[10px] font-bold tracking-[0.15em]">
          <tr>
            <th class="px-8 py-5">Waktu & User</th>
            <th class="px-6 py-5">Produk</th>
            <th class="px-6 py-5 text-center">Tipe</th>
            <th class="px-6 py-5 text-center font-black">Jumlah</th>
            <th class="px-8 py-5">Lokasi Gudang</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
          @forelse($movements as $m)
          <tr class="hover:bg-slate-50/50 transition-all group">
            <td class="px-8 py-5">
              <div class="flex flex-col">
                <span class="font-bold text-slate-900 leading-tight">{{ $m->created_at?->format('d M Y') ?? '-'
                  }}</span>
                <span class="text-[11px] text-slate-400 font-medium mt-0.5 uppercase tracking-tighter">
                  {{ $m->created_at?->format('H:i') }} • Oleh:
                  <span class="text-indigo-600 font-bold">{{ $m->user?->name ?? 'System' }}</span>
                </span>
              </div>
            </td>
            <td class="px-6 py-5">
              <div class="flex items-center gap-3">
                <div
                  class="w-10 h-10 rounded-xl bg-white flex items-center justify-center border border-slate-100 shadow-sm group-hover:border-indigo-200 transition-colors">
                  <i data-lucide="package" class="w-5 h-5 text-slate-400 group-hover:text-indigo-500"></i>
                </div>
                <div class="flex flex-col">
                  <span class="font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">{{
                    $m->product?->name ?? 'Produk Tidak Ditemukan' }}</span>
                  <span class="text-[10px] font-medium text-slate-400">{{ $m->product?->sku ?? '-' }}</span>
                </div>
              </div>
            </td>
            <td class="px-6 py-5 text-center">
              @if($m->type === 'IN')
              <span
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-black border border-emerald-100">
                <i data-lucide="trending-up" class="w-3 h-3"></i> MASUK
              </span>
              @else
              <span
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-black border border-rose-100">
                <i data-lucide="trending-down" class="w-3 h-3"></i> KELUAR
              </span>
              @endif
            </td>
            <td
              class="px-6 py-5 text-center font-black {{ $m->type === 'IN' ? 'text-emerald-600' : 'text-rose-600' }} text-lg">
              {{ $m->type === 'IN' ? '+' : '-' }}{{ number_format($m->quantity) }}
            </td>
            <td class="px-8 py-5">
              <div class="flex items-center gap-2">
                <div class="p-1.5 rounded-lg bg-indigo-50">
                  <i data-lucide="map-pin" class="w-3.5 h-3.5 text-indigo-500"></i>
                </div>
                <span class="font-bold text-slate-600">{{ $m->warehouse?->name ?? 'Gudang Tidak Ditemukan' }}</span>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-8 py-20 text-center">
              <div class="flex flex-col items-center">
                <div
                  class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center mb-4 border border-slate-100">
                  <i data-lucide="history" class="w-10 h-10 text-slate-200"></i>
                </div>
                <p class="text-slate-900 font-bold">Belum ada mutasi stok</p>
                <p class="text-slate-400 text-xs mt-1">Aktivitas masuk/keluar barang akan tercatat otomatis di sini.</p>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($movements->hasPages())
    <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/30">
      {{ $movements->links() }}
    </div>
    @endif
  </div>
</div>
@endsection