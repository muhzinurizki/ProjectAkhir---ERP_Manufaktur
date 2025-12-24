<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-100 transform transition-all duration-300 ease-in-out lg:translate-x-0 flex flex-col shadow-[4px_0_24px_rgba(0,0,0,0.02)]">

    {{-- Brand Area --}}
    <div class="h-24 px-8 flex items-center shrink-0">
        <div class="flex items-center gap-4">
            <div class="relative">
                <div
                    class="w-11 h-11 rounded-2xl bg-slate-900 flex items-center justify-center text-white font-bold shadow-xl shadow-slate-200">
                    <span class="text-xl tracking-tighter">E</span>
                </div>
                <div class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 border-[3px] border-white rounded-full">
                </div>
            </div>
            <div class="leading-tight">
                <h1 class="text-sm font-black text-slate-900 tracking-tight">ERP TEKSTIL</h1>
                <p class="text-[10px] uppercase font-bold tracking-[0.15em] text-slate-400">Warehouse App</p>
            </div>
        </div>
    </div>

    {{-- Navigation Menu --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2 custom-scrollbar">

        {{-- Section: Dashboard --}}
        @php
        $menus = [
        ['route' => 'dashboard', 'icon' => 'layout-dashboard', 'label' => 'Dashboard', 'role' => 'all'],

        // MASTER DATA
        ['header' => 'Master Data', 'role' => 'Admin'],
        ['route' => 'products.index', 'icon' => 'package', 'label' => 'Products', 'role' => 'Admin'],
        ['route' => 'warehouses.index', 'icon' => 'warehouse', 'label' => 'Warehouses', 'role' => 'Admin'],
        ['route' => 'suppliers.index', 'icon' => 'truck', 'label' => 'Suppliers', 'role' => 'Admin'],

        // OPERASIONAL
        ['header' => 'Inventory & Stock', 'role' => 'Admin'],
        ['route' => 'inventory.index', 'icon' => 'clipboard-list', 'label' => 'Stock Overview', 'role' => 'Admin'],
        ['route' => 'inventory.stock-in', 'icon' => 'list-plus', 'label' => 'Stock In (Masuk)', 'role' => 'Admin'],
        ['route' => 'inventory.stock-out', 'icon' => 'list-minus', 'label' => 'Stock Out (Keluar)', 'role' => 'Admin'],

        ['header' => 'Administration', 'role' => 'Admin'],
        ['route' => 'users.index', 'icon' => 'users', 'label' => 'User Management', 'role' => 'Admin'],
        ['route' => 'roles.index', 'icon' => 'shield', 'label' => 'Role Management', 'role' => 'Admin'],
        ];
        @endphp

        @foreach($menus as $menu)
        @if(isset($menu['header']))
        <div class="pt-6 pb-2 px-4">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ $menu['header'] }}</p>
        </div>
        @else
        @php
        $isActive = request()->routeIs(explode('.', $menu['route'])[0] . '*');
        @endphp
        <a href="{{ Route::has($menu['route']) ? route($menu['route']) : '#' }}"
            class="group flex items-center justify-between px-3 py-2.5 rounded-2xl transition-all duration-200
                   {{ $isActive ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center transition-all
                            {{ $isActive ? 'bg-white/10' : 'bg-slate-50 group-hover:bg-white' }}">
                    <i data-lucide="{{ $menu['icon'] }}"
                        class="w-4.5 h-4.5 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-slate-900' }}"></i>
                </div>
                <span class="text-sm font-bold tracking-tight">{{ $menu['label'] }}</span>
            </div>

            @if($isActive)
            <div class="w-1.5 h-1.5 rounded-full bg-indigo-400 shadow-[0_0_8px_rgba(129,140,248,0.8)] mr-1"></div>
            @endif
        </a>
        @endif
        @endforeach
    </nav>

    {{-- User Profile Area --}}
    <div class="p-4 mt-auto">
        <div class="p-4 rounded-[2rem] bg-slate-900 text-white shadow-2xl shadow-slate-300">
            <div class="flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=6366f1&color=fff"
                    class="w-10 h-10 rounded-2xl border-2 border-slate-800" alt="Profile">
                <div class="flex-1 min-w-0">
                    <p class="text-[12px] font-bold truncate tracking-tight">{{ auth()->user()->name ?? 'Administrator'
                        }}</p>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Super Admin</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-8 h-8 rounded-xl bg-slate-800 flex items-center justify-center hover:bg-rose-500 transition-colors group">
                        <i data-lucide="log-out" class="w-4 h-4 text-slate-400 group-hover:text-white"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>