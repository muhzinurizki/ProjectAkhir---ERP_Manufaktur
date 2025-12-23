@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- WELCOME BANNER --}}
<div class="mb-8">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h2>
                <p class="text-blue-100 mt-2">Here's what's happening with your ERP system today.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 backdrop-blur-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- KPI CARDS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">

    {{-- WO Aktif --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">WO Aktif</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">24</p>
                <div class="mt-3 flex items-center text-sm text-green-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    12% dari bulan lalu
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Stok Kritis --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Stok Kritis</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">8</p>
                <div class="mt-3 flex items-center text-sm text-red-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    3% dari bulan lalu
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Invoice Unpaid --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Invoice Unpaid</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">Rp 45.200.000</p>
                <div class="mt-3 flex items-center text-sm text-amber-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    5% dari bulan lalu
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- Total Users --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Users</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">42</p>
                <div class="mt-3 flex items-center text-sm text-green-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    8% dari bulan lalu
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4a4 4 0 110 8 4 4 0 010-8zm0 10a6 6 0 00-6 6h12a6 6 0 00-6-6z"/>
                </svg>
            </div>
        </div>
    </div>

</div>

{{-- CHARTS AND ACTIVITY --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Production Chart --}}
    <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Production Overview</h3>
            <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                View Report
            </button>
        </div>

        <div class="h-80 flex flex-col items-center justify-center">
            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 3v18m4-14v14m4-10v10M7 7v14M3 11v10"/>
            </svg>
            <p class="text-gray-500 font-medium">Production Chart</p>
            <p class="text-sm text-gray-400 mt-1">Data visualization for production metrics</p>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Recent Activity</h3>

        <div class="space-y-4">
            <div class="flex items-start">
                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3"></div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">New order received</p>
                    <p class="text-xs text-gray-500">Today, 10:30 AM</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3"></div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Production completed</p>
                    <p class="text-xs text-gray-500">Yesterday, 4:15 PM</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 mr-3"></div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Inventory update</p>
                    <p class="text-xs text-gray-500">Dec 22, 2:45 PM</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="w-2 h-2 bg-purple-500 rounded-full mt-2 mr-3"></div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Financial report generated</p>
                    <p class="text-xs text-gray-500">Dec 21, 9:30 AM</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3"></div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Invoice sent</p>
                    <p class="text-xs text-gray-500">Dec 20, 11:20 AM</p>
                </div>
            </div>
        </div>

        <button class="w-full mt-6 text-center text-sm text-blue-600 hover:text-blue-800 font-medium py-2 border-t border-gray-100">
            View all activity
        </button>
    </div>

</div>

@endsection
