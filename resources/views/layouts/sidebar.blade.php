<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-100
              transform transition-all duration-300 ease-in-out
              lg:translate-x-0 flex flex-col shadow-[4px_0_24px_rgba(0,0,0,0.02)]">

    {{-- Brand Area --}}
    <div class="h-20 px-6 flex items-center shrink-0">
        <div class="flex items-center gap-3">
            <div class="relative">
                <div
                    class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white font-bold shadow-lg shadow-slate-200">
                    <span class="text-lg tracking-tighter">E</span>
                </div>
                {{-- Decorative dot --}}
                <div class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></div>
            </div>
            <div class="leading-tight">
                <h1 class="text-sm font-bold text-slate-900 tracking-tight">ERP Tekstil</h1>
                <p class="text-[10px] uppercase font-bold tracking-[0.1em] text-slate-400">V. 2.0.1</p>
            </div>
        </div>
    </div>

    {{-- Navigation Menu --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1 custom-scrollbar">

        {{-- Section: Main --}}
        <a href="{{ route('dashboard') }}" class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('dashboard')
                ? 'bg-slate-900 text-white shadow-md shadow-slate-200'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

            <i data-lucide="layout-dashboard"
                class="w-5 h-5 transition-colors {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
            <span class="text-sm font-semibold">Dashboard</span>

            @if(request()->routeIs('dashboard'))
            <div class="absolute left-[-16px] w-1.5 h-6 bg-slate-900 rounded-r-full"></div>
            @endif
        </a>

        @role('Admin')
        <div class="pt-8 pb-2">
            <p class="px-4 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.15em]">Master Data</p>
        </div>

        <a href="{{ route('products.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('products.*')
                ? 'bg-slate-900 text-white shadow-md shadow-slate-200'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
            <i data-lucide="package"
                class="w-5 h-5 transition-colors {{ request()->routeIs('products.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
            <span class="text-sm font-semibold">Products</span>
        </a>

        <div class="pt-8 pb-2">
            <p class="px-4 text-[10px] font-extrabold text-slate-400 uppercase tracking-[0.15em]">Administration</p>
        </div>

        <a href="#"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all duration-200">
            <i data-lucide="users" class="w-5 h-5 text-slate-400 group-hover:text-slate-600"></i>
            <span class="text-sm font-semibold">User Management</span>
        </a>

        <a href="#"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all duration-200">
            <i data-lucide="shield" class="w-5 h-5 text-slate-400 group-hover:text-slate-600"></i>
            <span class="text-sm font-semibold">Role Management</span>
        </a>
        @endrole

    </nav>

    {{-- User Profile Area --}}
    <div class="m-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 transition-all hover:bg-slate-100/80">
        <div class="flex items-center gap-3">
            <div class="relative h-9 w-9 shrink-0">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=0f172a&color=fff"
                    class="rounded-xl object-cover border border-white shadow-sm" alt="Profile">
                <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full">
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[13px] font-bold text-slate-900 truncate tracking-tight">{{ auth()->user()->name ??
                    'Administrator' }}</p>
                <p class="text-[11px] text-slate-500 truncate font-medium">Head of Factory</p>
            </div>
            <button class="text-slate-400 hover:text-red-500 transition-colors">
                <i data-lucide="log-out" class="w-4 h-4"></i>
            </button>
        </div>
    </div>
</aside>