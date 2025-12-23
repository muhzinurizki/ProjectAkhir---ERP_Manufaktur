<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200
           transform transition-transform duration-300
           lg:translate-x-0 flex flex-col">

    {{-- Brand --}}
    <div class="h-16 px-6 flex items-center border-b border-gray-100">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold">
                E
            </div>
            <div>
                <h1 class="text-sm font-semibold text-gray-900">ERP Tekstil</h1>
                <p class="text-xs text-gray-500">Enterprise System</p>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1 text-sm">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition
           {{ request()->routeIs('dashboard')
                ? 'bg-blue-50 text-blue-700'
                : 'text-gray-700 hover:bg-gray-100' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5 text-gray-500"></i>
            Dashboard
        </a>

        @role('Admin')
        <p class="px-3 pt-4 pb-1 text-xs font-semibold text-gray-400 uppercase">
            Administration
        </p>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-gray-100">
            <i data-lucide="users" class="w-5 h-5 text-gray-500"></i>
            User Management
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-gray-100">
            <i data-lucide="shield" class="w-5 h-5 text-gray-500"></i>
            Role Management
        </a>
        @endrole

        @role('Purchasing')
        <p class="px-3 pt-4 pb-1 text-xs font-semibold text-gray-400 uppercase">
            Purchasing
        </p>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-gray-100">
            <i data-lucide="shopping-cart" class="w-5 h-5 text-gray-500"></i>
            Purchase Request
        </a>
        @endrole

    </nav>
</aside>
