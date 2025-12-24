@extends('layouts.app')

@section('title', 'Input Barang Masuk')
@section('page-title', 'Stock Inbound')

@section('content')
<div class="max-w-4xl mx-auto pb-20">
  {{-- Breadcrumb --}}
  <div class="mb-8">
    <a href="{{ route('inventory.index') }}"
      class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-900 transition-all group">
      <div
        class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center group-hover:border-slate-900 transition-all shadow-sm">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
      </div>
      Kembali ke Log Mutasi
    </a>
  </div>

  <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
    {{-- Header Form --}}
    <div class="px-10 py-10 border-b border-slate-50 bg-emerald-600 text-white relative overflow-hidden">
      <div class="relative z-10">
        <h2 class="text-2xl font-extrabold tracking-tight">Stock Inbound (Masuk)</h2>
        <p class="text-emerald-100 text-sm mt-1 font-medium">Tambah saldo stok ke dalam gudang dari Supplier atau Retur.
        </p>
      </div>
      <i data-lucide="plus-circle" class="w-40 h-40 text-white opacity-10 absolute -right-10 -bottom-10"></i>
    </div>

    <form method="POST" action="{{ route('inventory.stock-in.store') }}" class="p-10 space-y-8">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Destinasi & Barang --}}
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <h3 class="text-[11px] font-black text-emerald-600 uppercase tracking-[0.2em]">01. Destinasi & Produk</h3>
            <div class="h-px flex-1 bg-slate-100"></div>
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-bold uppercase tracking-wider text-slate-400 ml-1">Pilih Produk</label>
            <select name="product_id" required
              class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold focus:bg-white focus:ring-4 focus:ring-emerald-50 focus:border-emerald-600 outline-none transition-all shadow-sm">
              <option value="">-- Pilih Produk --</option>
              @foreach($products as $p)
              <option value="{{ $p->id }}">{{ $p->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-bold uppercase tracking-wider text-slate-400 ml-1">Gudang Penerima</label>
            <select name="warehouse_id" required
              class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold focus:bg-white focus:ring-4 focus:ring-emerald-50 focus:border-emerald-600 outline-none transition-all shadow-sm">
              <option value="">-- Pilih Gudang --</option>
              @foreach($warehouses as $w)
              <option value="{{ $w->id }}">{{ $w->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Kuantitas & Referensi --}}
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <h3 class="text-[11px] font-black text-emerald-600 uppercase tracking-[0.2em]">02. Detail Jumlah</h3>
            <div class="h-px flex-1 bg-slate-100"></div>
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-bold uppercase tracking-wider text-slate-400 ml-1">Jumlah (Qty)</label>
            <input type="number" step="0.0001" name="quantity" placeholder="0.0000" required
              class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-[16px] font-black text-slate-900 focus:bg-white focus:ring-4 focus:ring-emerald-50 focus:border-emerald-600 outline-none transition-all shadow-sm">
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-bold uppercase tracking-wider text-slate-400 ml-1">No. Referensi / Surat
              Jalan</label>
            <input name="reference" placeholder="Contoh: SJ-2023-001"
              class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold focus:bg-white focus:ring-4 focus:ring-emerald-50 focus:border-emerald-600 outline-none transition-all shadow-sm">
          </div>
        </div>
      </div>

      {{-- Catatan --}}
      <div class="space-y-2">
        <label class="text-[10px] font-bold uppercase tracking-wider text-slate-400 ml-1">Catatan Tambahan</label>
        <textarea name="note" rows="3" placeholder="Tambahkan detail jika diperlukan..."
          class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold focus:bg-white focus:ring-4 focus:ring-emerald-50 focus:border-emerald-600 outline-none transition-all shadow-sm"></textarea>
      </div>

      {{-- Submit --}}
      <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-50">
        <button type="submit"
          class="w-full md:w-auto px-12 py-4 bg-emerald-600 text-white text-sm font-bold rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition-all flex items-center justify-center gap-3 active:scale-95">
          <i data-lucide="check-circle" class="w-5 h-5"></i>
          Konfirmasi Barang Masuk
        </button>
      </div>
    </form>
  </div>
</div>
@endsection