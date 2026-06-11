<x-app-layout>
    <div class="flex min-h-screen bg-[#f3f4f6] font-sans antialiased text-slate-900" x-data="{ sidebarOpen: true }">
        
        <!-- SIDEBAR NAVIGATION -->
        <aside :class="sidebarOpen ? 'w-72' : 'w-20'" class="bg-white border-r-2 border-black transition-all duration-300 flex flex-col sticky top-0 h-screen z-50">
            <div class="p-6 border-b-2 border-black flex items-center justify-between">
                <div class="flex items-center gap-3" x-show="sidebarOpen">
                    <div class="w-8 h-8 bg-black flex items-center justify-center rounded-[5px]">
                        <span class="text-indigo-500 font-black italic text-xs uppercase">QC</span>
                    </div>
                    <span class="text-lg font-black text-slate-900 italic tracking-tighter uppercase">SMK-BES <span class="text-indigo-600 text-[10px] not-italic">PRO</span></span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen" class="p-1.5 rounded-[5px] border-2 border-black hover:bg-slate-100 transition-colors">
                    <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>

            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 rounded-[5px] bg-black text-white font-black text-[10px] uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(79,70,229,1)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span x-show="sidebarOpen">Dashboard_Panel</span>
                </a>
                <a href="{{ route('admin.inventory.index') }}" class="flex items-center gap-3 p-3 rounded-[5px] text-slate-400 hover:bg-slate-100 hover:text-black font-black text-[10px] uppercase tracking-widest transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span x-show="sidebarOpen">Inventory_Master</span>
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 p-3 rounded-[5px] text-slate-400 hover:bg-slate-100 hover:text-black font-black text-[10px] uppercase tracking-widest transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 002 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span x-show="sidebarOpen">Financial_Vault</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 rounded-[5px] text-slate-400 hover:bg-slate-100 hover:text-black font-black text-[10px] uppercase tracking-widest transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span x-show="sidebarOpen">User_Surveillance</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 p-10 overflow-y-auto">
            
            <!-- HEADER -->
            <div class="mb-12 border-l-8 border-black pl-8">
                <span class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 leading-none">System Oversight Intelligence</span>
                <h1 class="text-4xl font-black italic tracking-tighter text-slate-900 mt-2 uppercase">Administrator Terminal.exe</h1>
            </div>

            <!-- BENTO WIDGETS -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12 uppercase italic">
                <div class="bg-white p-8 rounded-[5px] border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                    <span class="text-[9px] font-black uppercase text-slate-400 tracking-widest block mb-2 leading-none">Total Revenue</span>
                    <h3 class="text-3xl font-black text-indigo-600 tracking-tighter">Rp{{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white p-8 rounded-[5px] border-2 border-black shadow-[6px_6px_0px_0px_rgba(245,158,11,1)]">
                    <span class="text-[9px] font-black uppercase text-slate-400 tracking-widest block mb-2 leading-none">Pending Orders</span>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $stats['pending_orders'] }} Units</h3>
                </div>
                <div class="bg-white p-8 rounded-[5px] border-2 border-black shadow-[6px_6px_0px_0px_rgba(244,63,94,1)]">
                    <span class="text-[9px] font-black uppercase text-slate-400 tracking-widest block mb-2 leading-none">Stock Warning</span>
                    <h3 class="text-3xl font-black text-rose-600 tracking-tighter animate-pulse">{{ $stats['low_stock'] }} Unit</h3>
                </div>
                <div class="bg-white p-8 rounded-[5px] border-2 border-black shadow-[6px_6px_0px_0px_rgba(16,185,129,1)]">
                    <span class="text-[9px] font-black uppercase text-slate-400 tracking-widest block mb-2 leading-none">Active Persona</span>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $stats['active_users'] }} Users</h3>
                </div>
            </div>

            <!-- INVENTORY MASTER TABLE -->
            <div class="bg-white border-2 border-black rounded-[5px] overflow-hidden shadow-sm mb-12">
                <div class="p-6 border-b-2 border-black flex justify-between items-center bg-[#fdfdfd]">
                    <h2 class="text-xs font-black uppercase tracking-widest text-slate-900 italic">Inventory database control</h2>
                    <a href="#" class="bg-black text-white px-4 py-2 text-[9px] font-black uppercase rounded-[3px] hover:bg-indigo-600 transition-all">+ Publish New Unit</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 text-[9px] font-black uppercase text-slate-400 tracking-widest border-b-2 border-black italic">
                            <tr>
                                <th class="p-5">Product_Name</th>
                                <th class="p-5">Category</th>
                                <th class="p-5 text-center">Grade_Id</th>
                                <th class="p-5 text-right">Value</th>
                                <th class="p-5 text-center">Stock</th>
                            </tr>
                        </thead>
                        <tbody class="text-[11px] font-bold uppercase tracking-tight">
                            @foreach($products as $p)
                            <tr class="hover:bg-slate-50 transition-colors border-b border-slate-100">
                                <td class="p-5">
                                    <span class="block text-slate-900">{{ $p->model }}</span>
                                    <span class="text-[8px] text-slate-400 italic">Brand: {{ $p->brand }}</span>
                                </td>
                                <td class="p-5 text-slate-400">{{ $p->category }}</td>
                                <td class="p-5 text-center">
                                    @php
                                        $color = match($p->grade) { 'A' => 'bg-emerald-500', 'B' => 'bg-indigo-600', 'C' => 'bg-amber-400', 'D' => 'bg-rose-500', default => 'bg-black' };
                                    @endphp
                                    <span class="{{ $color }} text-white px-3 py-1 rounded-[3px] text-[8px] font-black italic">GR.{{ $p->grade }}</span>
                                </td>
                                <td class="p-5 text-right font-black italic">Rp{{ number_format($p->price, 0, ',', '.') }}</td>
                                <td class="p-5 text-center">{{ $p->stock }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t-2 border-black flex justify-center bg-slate-50">
                    {{ $products->links() }}
                </div>
            </div>

        </main>
    </div>

    <!-- CUSTOM PAGINATION STYLE -->
    <style>
        .pagination nav svg { height: 1.2rem; width: 1.2rem; }
        .pagination nav div { font-size: 10px; font-weight: 900; text-transform: uppercase; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #000; border-radius: 5px; }
    </style>
</x-app-layout>