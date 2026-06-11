<x-app-layout>
    <div class="flex min-h-screen bg-[#F8F9FA] font-sans antialiased text-slate-900" x-data="{ sidebarOpen: true }">
        
        <!-- SIDEBAR NAVIGATION -->
        @include('layouts.admin-sidebar')

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 p-8 overflow-y-auto">
            
            <!-- 1. HEADER & QUICK ACTIONS -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
                <div class="border-l-8 border-black pl-6">
                    <nav class="flex text-[9px] font-black uppercase tracking-[0.3em] text-slate-400 mb-2 gap-2 leading-none">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
                        <span>/</span>
                        <span class="text-indigo-600 italic">Inventory_Master</span>
                    </nav>
                    <h1 class="text-4xl font-black uppercase tracking-tighter italic leading-none text-slate-900">Central Unit Repository.</h1>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <!-- Export Button -->
                    <button class="bg-white border-2 border-black px-6 py-3 text-[10px] font-black uppercase tracking-widest rounded-[5px] hover:bg-slate-50 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Export_Laporan
                    </button>
                    <!-- Add Button -->
                    <a href="{{ route('admin.inventory.create') }}" class="bg-indigo-600 text-white border-2 border-black px-8 py-3.5 text-[10px] font-black uppercase tracking-widest rounded-[5px] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:bg-black transition-all flex items-center gap-2 active:shadow-none active:translate-x-1 active:translate-y-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                        Tambah Barang Baru
                    </a>
                </div>
            </div>

            <!-- 2. PANEL FILTER & PENCARIAN DINAMIS -->
            <div class="bg-white border-2 border-black rounded-[5px] p-8 mb-8 shadow-sm">
                <form action="{{ route('admin.inventory.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- Search -->
                    <div class="md:col-span-5">
                        <label class="text-[9px] font-black uppercase text-slate-400 block mb-2 tracking-widest">Global Search Bar</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="SEARCH MODEL OR BRAND..." 
                                   class="w-full border-2 border-black rounded-[5px] p-3 text-[10px] font-bold uppercase focus:ring-0 focus:border-indigo-600 transition-all pl-10">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                        </div>
                    </div>
                    <!-- Category -->
                    <div class="md:col-span-3">
                        <label class="text-[9px] font-black uppercase text-slate-400 block mb-2 tracking-widest">Taksonomi Kategori</label>
                        <select name="category" onchange="this.form.submit()" class="w-full border-2 border-black rounded-[5px] p-3 text-[10px] font-black uppercase focus:ring-0 cursor-pointer">
                            <option value="">ALL DEPARTMENTS</option>
                            @foreach(['Smartphone', 'Laptop', 'Televisi (TV)', 'Kulkas', 'Mesin Cuci', 'AC (Air Conditioner)', 'Kipas Angin', 'Speaker', 'Headphone', 'Earphone'] as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Grade -->
                    <div class="md:col-span-2">
                        <label class="text-[9px] font-black uppercase text-slate-400 block mb-2 tracking-widest">Quality Grade</label>
                        <select name="grade" onchange="this.form.submit()" class="w-full border-2 border-black rounded-[5px] p-3 text-[10px] font-black uppercase focus:ring-0 cursor-pointer">
                            <option value="">ALL GRADES</option>
                            <option value="A" {{ request('grade') == 'A' ? 'selected' : '' }}>GRADE A</option>
                            <option value="B" {{ request('grade') == 'B' ? 'selected' : '' }}>GRADE B</option>
                            <option value="C" {{ request('grade') == 'C' ? 'selected' : '' }}>GRADE C</option>
                            <option value="D" {{ request('grade') == 'D' ? 'selected' : '' }}>GRADE D</option>
                        </select>
                    </div>
                    <!-- Limit -->
                    <div class="md:col-span-2">
                        <label class="text-[9px] font-black uppercase text-slate-400 block mb-2 tracking-widest">Entries Limit</label>
                        <select name="limit" onchange="this.form.submit()" class="w-full border-2 border-black rounded-[5px] p-3 text-[10px] font-black uppercase focus:ring-0">
                            <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10 DATA</option>
                            <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25 DATA</option>
                            <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50 DATA</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- 3. TABEL INVENTARIS UTAMA -->
            <div class="bg-white border-2 border-black rounded-[5px] overflow-hidden shadow-sm relative">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-black text-white text-[9px] font-black uppercase tracking-[0.2em] italic">
                            <tr>
                                <th class="p-5 border-r border-slate-800">Thumbnail</th>
                                <th class="p-5 border-r border-slate-800">Product_Information</th>
                                <th class="p-5 border-r border-slate-800">Taxonomy</th>
                                <th class="p-5 border-r border-slate-800 text-center">Quality_Grade</th>
                                <th class="p-5 border-r border-slate-800 text-right">Pricing</th>
                                <th class="p-5 border-r border-slate-800 text-center">Inventory</th>
                                <th class="p-5 text-center">Control_Console</th>
                            </tr>
                        </thead>
                        <tbody class="text-[11px] font-bold uppercase tracking-tight divide-y divide-slate-100 italic">
                            @forelse($products as $p)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <!-- Thumbnail -->
                                <td class="p-5 w-24 border-r border-slate-50">
                                    <div class="w-16 h-16 bg-[#f0f0f0] rounded-[5px] border-2 border-black overflow-hidden p-1 shadow-sm">
                                        <img src="{{ $p->image }}" class="w-full h-full object-contain grayscale group-hover:grayscale-0 transition-all duration-500">
                                    </div>
                                </td>
                                <!-- Info -->
                                <td class="p-5 border-r border-slate-50">
                                    <span class="block text-slate-900 text-sm font-black italic tracking-tighter leading-none mb-1">{{ $p->model }}</span>
                                    <span class="text-[9px] text-indigo-600 font-black tracking-widest italic uppercase">{{ $p->brand }}</span>
                                </td>
                                <!-- Taksonomi -->
                                <td class="p-5 border-r border-slate-50 text-slate-400">
                                    <span class="bg-slate-100 border border-slate-200 px-2 py-1 rounded text-[9px] font-black">{{ $p->category }}</span>
                                </td>
                                <!-- Grade -->
                                <td class="p-5 border-r border-slate-50 text-center">
                                    @php
                                        $gradeMap = [
                                            'A' => 'bg-emerald-500', 'B' => 'bg-indigo-600',
                                            'C' => 'bg-amber-400', 'D' => 'bg-rose-500'
                                        ];
                                    @endphp
                                    <span class="{{ $gradeMap[$p->grade] ?? 'bg-black' }} text-white px-4 py-2 rounded-[3px] text-[9px] font-black italic shadow-md uppercase tracking-widest">
                                        GR.{{ $p->grade }}
                                    </span>
                                </td>
                                <!-- Pricing -->
                                <td class="p-5 border-r border-slate-50 text-right font-black italic text-slate-900 text-sm tracking-tighter">
                                    Rp{{ number_format($p->price, 0, ',', '.') }}
                                </td>
                                <!-- Stok -->
                                <td class="p-5 border-r border-slate-50 text-center">
                                    <div class="flex flex-col gap-1 items-center">
                                        <span class="{{ $p->stock < 3 ? 'text-red-600 animate-pulse' : 'text-slate-900' }} font-black">{{ $p->stock }} UNIT</span>
                                        <span class="text-[8px] text-slate-400 italic leading-none">{{ $p->location }}</span>
                                    </div>
                                </td>
                                <!-- Action Console (PERBAIKAN IKON) -->
                                <td class="p-5">
                                    <div class="flex justify-center gap-3">
                                        <!-- Edit Action -->
                                        <a href="{{ route('admin.inventory.edit', $p->id) }}" 
                                           class="p-2.5 bg-slate-100 border-2 border-black rounded-[5px] text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-0.5 active:translate-y-0.5" 
                                           title="Update Data">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>

                                        <!-- Delete Action -->
                                        <form action="{{ route('admin.inventory.destroy', $p->id) }}" method="POST" onsubmit="return confirm('CRITICAL_WARNING: Pindahkan unit ke archive permanen?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2.5 bg-slate-100 border-2 border-black rounded-[5px] text-rose-600 hover:bg-rose-600 hover:text-white transition-all shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-0.5 active:translate-y-0.5" 
                                                    title="Destroy Record">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-32 text-center border-b border-slate-100 bg-white">
                                    <div class="flex flex-col items-center opacity-30 animate-pulse">
                                        <div class="text-6xl mb-6 italic font-black uppercase">Null</div>
                                        <p class="text-[10px] font-black uppercase tracking-[0.8em]">Database_Record_Not_Found</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- 5. FOOTER & PAGINATION -->
                <div class="p-8 bg-[#fafafa] border-t-2 border-black flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 italic">
                        Viewing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} Inventory_Records
                    </div>
                    
                    <div class="custom-pagination">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>

            <!-- 6. API STATUS INDICATOR -->
            <div class="mt-16 flex items-center justify-between opacity-50 border-t border-slate-200 pt-8">
                <div class="flex items-center gap-4">
                    <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(16,185,129,1)]"></div>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] italic text-slate-900 underline">API_Sync: Active [JSON_Endpoint_Monitoring]</span>
                </div>
                <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic leading-none">
                    Security_Hash: {{ md5(Auth::id() . now()) }}
                </div>
            </div>

        </main>
    </div>

    <!-- CUSTOM STYLE FOR PAGINATION & SCROLLBAR -->
    <style>
        .custom-pagination nav svg { height: 1.5rem; width: 1.5rem; }
        .custom-pagination nav div { font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #000; border-radius: 5px; }
    </style>
</x-app-layout>