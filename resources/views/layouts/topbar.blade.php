<header class="h-16 bg-white border-b border-gray-200
               flex items-center justify-between px-6 sticky top-0 z-30">

    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true"
                class="lg:hidden w-9 h-9 flex items-center justify-center
                       rounded-lg bg-gray-100 hover:bg-gray-200">
            <i data-lucide="menu" class="w-5 h-5 text-gray-600"></i>
        </button>

        <h1 class="text-lg font-semibold text-gray-900">
            @yield('page-title', 'Dashboard')
        </h1>
    </div>

    <div x-data="{ open: false }" class="relative flex items-center gap-4">

        {{-- Notification --}}
        <button class="relative w-9 h-9 rounded-lg bg-gray-100 hover:bg-gray-200
                       flex items-center justify-center">
            <i data-lucide="bell" class="w-5 h-5 text-gray-600"></i>
            <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full"></span>
        </button>

        {{-- User --}}
        <button @click="open = !open"
                class="flex items-center gap-2 px-2 py-1 rounded-lg hover:bg-gray-100">
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center
                        text-blue-700 font-semibold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
        </button>

        {{-- Dropdown --}}
        <div x-show="open"
             @click.outside="open = false"
             class="absolute right-0 top-12 w-56 bg-white
                    border border-gray-200 rounded-lg shadow-lg z-50">

            <div class="px-4 py-3 border-b">
                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
            </div>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-50">
                <i data-lucide="user" class="w-4 h-4"></i>
                My Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm hover:bg-gray-50">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Sign out
                </button>
            </form>
        </div>

    </div>
</header>
