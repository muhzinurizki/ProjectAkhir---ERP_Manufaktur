<header class="h-16 bg-white border-b flex items-center justify-between px-6 sticky top-0 z-20">

  <div class="flex items-center gap-3">
    {{-- Mobile Menu Button --}}
    <button @click="sidebarOpen = true" class="lg:hidden text-slate-600">
      ☰
    </button>

    <h1 class="text-sm font-medium text-slate-700">
      @yield('page-title', 'Dashboard')
    </h1>
  </div>

  <div class="flex items-center gap-4 text-sm">
    <span class="text-slate-600">
      {{ auth()->user()->name }}
    </span>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="text-red-500 hover:underline">
        Logout
      </button>
    </form>
  </div>

</header>