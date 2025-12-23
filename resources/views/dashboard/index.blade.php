@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white p-5 rounded-xl shadow-sm">
        <p class="text-sm text-slate-500">PR Pending</p>
        <p class="text-2xl font-semibold mt-2">0</p>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm">
        <p class="text-sm text-slate-500">WO Aktif</p>
        <p class="text-2xl font-semibold mt-2">0</p>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm">
        <p class="text-sm text-slate-500">Stok Kritis</p>
        <p class="text-2xl font-semibold mt-2">0</p>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-sm">
        <p class="text-sm text-slate-500">Invoice Unpaid</p>
        <p class="text-2xl font-semibold mt-2">0</p>
    </div>

</div>

@endsection
