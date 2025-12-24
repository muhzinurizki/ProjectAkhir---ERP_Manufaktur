@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Overview')

@section('content')

{{-- WELCOME BANNER --}}
<div class="mb-10">
    <div class="relative overflow-hidden bg-slate-900 rounded-[2rem] p-8 text-white shadow-2xl shadow-slate-200">
        {{-- Decorative Circles --}}
        <div class="absolute top-[-10%] right-[-5%] w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-20%] right-[10%] w-40 h-40 bg-emerald-500/10 rounded-full blur-2xl"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight">Selamat Datang, {{ explode(' ',
                    auth()->user()->name)[0] }}! 👋</h2>
                <p class="text-slate-400 mt-2 font-medium max-w-md">Sistem ERP Tekstil memantau 12 unit produksi hari
                    ini secara real-time.</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <div class="px-5 py-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <p class="text-[10px] uppercase tracking-[0.1em] text-slate-400 font-bold mb-1">Server Status</p>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-sm font-bold">Optimal</span>
                    </div>
                </div>
                <div class="px-5 py-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <p class="text-[10px] uppercase tracking-[0.1em] text-slate-400 font-bold mb-1">Local Time</p>
                    <span class="text-sm font-bold">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- KPI CARDS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    @php
    $stats = [
    ['label' => 'WO Aktif', 'value' => '24', 'trend' => '+12%', 'icon' => 'activity', 'color' => 'indigo'],
    ['label' => 'Stok Kritis', 'value' => '8', 'trend' => '-3%', 'icon' => 'alert-triangle', 'color' => 'rose'],
    ['label' => 'Unpaid Invoices', 'value' => 'Rp 45.2M', 'trend' => '+5%', 'icon' => 'credit-card', 'color' =>
    'amber'],
    ['label' => 'Total Users', 'value' => '42', 'trend' => '+8%', 'icon' => 'users', 'color' => 'emerald'],
    ];
    @endphp

    @foreach($stats as $stat)
    <div
        class="group bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div
                class="w-12 h-12 rounded-2xl bg-{{ $stat['color'] }}-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                <i data-lucide="{{ $stat['icon'] }}" class="w-6 h-6 text-{{ $stat['color'] }}-600"></i>
            </div>
            <span
                class="text-xs font-bold px-2.5 py-1 rounded-full bg-{{ str_contains($stat['trend'], '+') ? 'emerald' : 'rose' }}-50 text-{{ str_contains($stat['trend'], '+') ? 'emerald' : 'rose' }}-600">
                {{ $stat['trend'] }}
            </span>
        </div>
        <div>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">{{ $stat['label'] }}</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1">{{ $stat['value'] }}</p>
        </div>
    </div>
    @endforeach
</div>

{{-- CHARTS AND ACTIVITY --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Chart Placeholder --}}
    <div class="lg:col-span-2 bg-white rounded-[2rem] border border-slate-100 p-8 shadow-sm">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Efisiensi Produksi</h3>
                <p class="text-sm text-slate-500 font-medium">Data output harian 7 hari terakhir</p>
            </div>
            <select class="text-sm border-slate-200 rounded-xl focus:ring-slate-900 focus:border-slate-900">
                <option>Minggu Ini</option>
                <option>Bulan Ini</option>
            </select>
        </div>

        <div
            class="h-72 w-full bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center group cursor-pointer hover:bg-slate-100 transition-colors">
            <div
                class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <i data-lucide="bar-chart-3" class="w-6 h-6 text-slate-400"></i>
            </div>
            <p class="text-slate-500 font-bold text-sm">Integrasikan Chart.js / ApexCharts</p>
            <p class="text-slate-400 text-xs mt-1">Klik untuk konfigurasi data</p>
        </div>
    </div>

    {{-- Activity Log --}}
    <div class="bg-white rounded-[2rem] border border-slate-100 p-8 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-8">Aktivitas Terbaru</h3>

        <div
            class="relative space-y-8 before:absolute before:inset-0 before:ml-3 before:-translate-x-px before:h-full before:w-0.5 before:bg-gradient-to-b before:from-slate-200 before:via-slate-100 before:to-transparent">

            {{-- Activity Item --}}
            <div class="relative flex items-center justify-between group">
                <div class="flex items-center">
                    <div
                        class="absolute left-0 w-6 h-6 rounded-full border-4 border-white bg-indigo-600 shadow-sm z-10 transition-transform group-hover:scale-125">
                    </div>
                    <div class="pl-10">
                        <p class="text-sm font-bold text-slate-900">Pesanan Baru #8821</p>
                        <p class="text-xs text-slate-500 font-medium">10 menit yang lalu</p>
                    </div>
                </div>
            </div>

            <div class="relative flex items-center justify-between group">
                <div class="flex items-center">
                    <div
                        class="absolute left-0 w-6 h-6 rounded-full border-4 border-white bg-emerald-500 shadow-sm z-10">
                    </div>
                    <div class="pl-10">
                        <p class="text-sm font-bold text-slate-900">Produksi Selesai (Batch A)</p>
                        <p class="text-xs text-slate-500 font-medium">2 jam yang lalu</p>
                    </div>
                </div>
            </div>

            <div class="relative flex items-center justify-between group">
                <div class="flex items-center">
                    <div class="absolute left-0 w-6 h-6 rounded-full border-4 border-white bg-amber-500 shadow-sm z-10">
                    </div>
                    <div class="pl-10">
                        <p class="text-sm font-bold text-slate-900">Stok Benang Menipis</p>
                        <p class="text-xs text-slate-500 font-medium">5 jam yang lalu</p>
                    </div>
                </div>
            </div>
        </div>

        <button
            class="w-full mt-10 py-3 rounded-xl bg-slate-50 text-slate-600 text-sm font-bold hover:bg-slate-900 hover:text-white transition-all">
            Lihat Semua Aktivitas
        </button>
    </div>
</div>

@endsection