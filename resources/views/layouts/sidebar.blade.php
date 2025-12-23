<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
  class="fixed z-40 inset-y-0 left-0 w-64 bg-white border-r transform lg:translate-x-0 transition-transform duration-200 ease-in-out">
  <div class="h-16 flex items-center px-6 border-b">
    <span class="text-lg font-semibold tracking-tight">
      ERP Tekstil
    </span>
  </div>

  <nav class="px-4 py-6 space-y-1 text-sm">

    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-slate-100">
      Dashboard
    </a>

    @role('Admin')
    <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-slate-100">
      User Management
    </a>
    @endrole

    @role('Purchasing')
    <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-slate-100">
      Purchase Request
    </a>
    @endrole

    @role('Warehouse')
    <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-slate-100">
      Inventory
    </a>
    @endrole

    @role('Production')
    <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-slate-100">
      Production
    </a>
    @endrole

    @role('Finance')
    <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-slate-100">
      Finance
    </a>
    @endrole

  </nav>
</aside>