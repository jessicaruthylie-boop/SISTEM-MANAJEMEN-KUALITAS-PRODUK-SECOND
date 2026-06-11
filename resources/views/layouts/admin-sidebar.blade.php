<aside :class="sidebarOpen ? 'w-72' : 'w-20'" class="bg-white border-r-2 border-black transition-all duration-300 flex flex-col sticky top-0 h-screen z-50 shadow-sm">
    <!-- Branding Area -->
    <div class="p-6 border-b-2 border-black flex items-center justify-between bg-white">
        <div class="flex items-center gap-3" x-show="sidebarOpen">
            <div class="w-8 h-8 bg-black flex items-center justify-center rounded-[5px] shadow-lg">
                <span class="text-indigo-500 font-black italic text-xs uppercase">QC</span>
            </div>
            <span class="text-lg font-black text-slate-900 italic tracking-tighter uppercase leading-none">SMK-BES <span class="text-indigo-600 text-[10px] not-italic font-bold">PRO</span></span>
        </div>
        <button @click="sidebarOpen = !sidebarOpen" class="p-1.5 rounded-[5px] border-2 border-black hover:bg-slate-100 transition-colors">
            <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 rounded-[5px] font-black text-[10px] uppercase tracking-widest transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-black text-white shadow-[4px_4px_0px_0px_rgba(79,70,229,1)]' : 'text-slate-400 hover:bg-slate-50 hover:text-black' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span x-show="sidebarOpen">Dashboard Status</span>
        </a>

        <div class="pt-4 pb-2 px-3" x-show="sidebarOpen">
            <span class="text-[8px] font-black uppercase tracking-[0.4em] text-slate-300">Management</span>
        </div>

        <a href="{{ route('admin.inventory.index') }}" class="flex items-center gap-3 p-3 rounded-[5px] font-black text-[10px] uppercase tracking-widest transition-all {{ request()->routeIs('admin.inventory.*') ? 'bg-black text-white shadow-[4px_4px_0px_0px_rgba(79,70,229,1)]' : 'text-slate-400 hover:bg-slate-50 hover:text-black' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            <span x-show="sidebarOpen">Inventory Master</span>
        </a>

        <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 p-3 rounded-[5px] font-black text-[10px] uppercase tracking-widest transition-all {{ request()->routeIs('admin.transactions.*') ? 'bg-black text-white shadow-[4px_4px_0px_0px_rgba(79,70,229,1)]' : 'text-slate-400 hover:bg-slate-50 hover:text-black' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 002 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <span x-show="sidebarOpen">Financial Vault</span>
        </a>

        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 rounded-[5px] font-black text-[10px] uppercase tracking-widest transition-all {{ request()->routeIs('admin.users.*') ? 'bg-black text-white shadow-[4px_4px_0px_0px_rgba(79,70,229,1)]' : 'text-slate-400 hover:bg-slate-50 hover:text-black' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <span x-show="sidebarOpen">User surveillance</span>
        </a>
    </nav>

    <!-- API Status -->
    <div class="p-6 border-t-2 border-black">
        <div class="flex items-center gap-3 text-[10px] font-black uppercase text-emerald-600 italic">
            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
            <span x-show="sidebarOpen">API_Sync: Active</span>
        </div>
    </div>
</aside>