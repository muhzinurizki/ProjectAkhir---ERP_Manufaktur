<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ERP Tekstil')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">

<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    {{-- Mobile overlay --}}
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/40 z-40 lg:hidden">
    </div>

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main --}}
    <div class="flex flex-col flex-1 lg:ml-64">

        {{-- Topbar --}}
        @include('layouts.topbar')

        {{-- Content --}}
        <main class="flex-1 p-4 md:p-6 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
