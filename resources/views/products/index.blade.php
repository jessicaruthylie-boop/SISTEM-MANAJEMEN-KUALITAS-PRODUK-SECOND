<x-app-layout>
    <div class="bg-white min-h-screen text-slate-900 font-sans antialiased pb-24">
        
        <!-- HEADER SECTION: BOLD & CLEAN -->
        <div class="border-b border-slate-200 bg-[#fcfcfc]">
            <div class="max-w-7xl mx-auto px-6 py-12">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-8 h-1 bg-indigo-600 rounded-full"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600">Inventory System</span>
                        </div>
                        <h1 class="text-5xl font-black uppercase tracking-tighter italic leading-none">Katalog Produk.</h1>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.4em] mt-4">Manajemen Kualitas Barang Elektronik Sekon</p>
                    </div>
                    
                    <!-- SEARCH BAR: SHARP DESIGN -->
                    <form action="{{ route('products.index') }}" method="GET" class="w-full md:w-[450px]">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <div class="relative group">
                            <input type="text" name="search" placeholder="Cari model unit (ex: iPhone 14)..." 
                                   value="{{ request('search') }}"
                                   class="w-full border-2 border-slate-900 rounded-[5px] text-[10px] font-black uppercase p-4 focus:ring-0 focus:border-indigo-600 transition-all placeholder:text-slate-300">
                            <button type="submit" class="absolute right-2 top-2 bottom-2 bg-slate-900 text-white px-6 rounded-[3px] font-black text-[10px] uppercase hover:bg-indigo-600 transition-colors">
                                CARI
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 mt-12 grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- LEFT SIDEBAR: NAVIGATION -->
            <div class="lg:col-span-3 space-y-10">
                <div class="sticky top-24">
                    <h3 class="text-xs font-black uppercase tracking-widest mb-8 pb-2 border-b-2 border-slate-900 italic">Filter Kategori</h3>
                    <div class="flex flex-col gap-1">
                        @php
                            $listKategori = ['Smartphone', 'Laptop', 'Komputer / PC', 'Tablet', 'Televisi (TV)', 'Kulkas', 'Mesin Cuci', 'AC (Air Conditioner)', 'Kipas Angin', 'Speaker', 'Headphone', 'Earphone'];
                        @endphp

                        @foreach($listKategori as $cat)
                        <a href="{{ route('products.index', ['category' => $cat]) }}" 
                           class="group flex items-center justify-between px-4 py-3 rounded-[5px] text-[11px] font-bold uppercase tracking-widest transition-all {{ request('category') == $cat ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-900' }}">
                            <span>{{ $cat }}</span>
                            @if(request('category') == $cat)
                                <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                            @endif
                        </a>
                        @endforeach
                    </div>

                    <!-- JAMINAN KUALITAS BANNER -->
                    <div class="mt-12 p-8 bg-indigo-50 border-2 border-indigo-600 rounded-[5px] relative overflow-hidden">
                        <div class="relative z-10">
                            <h4 class="text-[11px] font-black uppercase tracking-widest mb-3 text-indigo-600 italic">Jaminan Kualitas</h4>
                            <p class="text-[10px] leading-relaxed text-indigo-900/60 font-bold uppercase italic">Setiap unit telah melalui inspeksi teknis 21 titik sebelum masuk ke katalog resmi SMK-BES.</p>
                        </div>
                        <div class="absolute -right-4 -bottom-4 opacity-10 text-indigo-600 font-black text-6xl italic select-none">QC</div>
                    </div>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="lg:col-span-9">
                
                <!-- BRAND CHIPS: MODERN TAG STYLE -->
                @if(request('category'))
                <div class="mb-12">
                    <h3 class="text-[10px] font-black uppercase text-slate-400 tracking-[0.3em] mb-4">Pilih Brand Terverifikasi:</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('products.index', ['category' => request('category')]) }}" 
                           class="px-6 py-2.5 border-2 border-slate-900 text-[10px] font-black uppercase rounded-[5px] transition-all {{ !request('brand') ? 'bg-slate-900 text-white' : 'bg-white hover:bg-slate-100' }}">
                            Semua Brand
                        </a>
                        @foreach($brands as $brand)
                        <a href="{{ route('products.index', ['category' => request('category'), 'brand' => $brand]) }}" 
                           class="px-6 py-2.5 border-2 border-slate-900 text-[10px] font-black uppercase rounded-[5px] transition-all {{ request('brand') == $brand ? 'bg-slate-900 text-white shadow-md' : 'bg-white hover:border-indigo-600 hover:text-indigo-600' }}">
                            {{ $brand }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- PRODUCT GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @forelse($products as $p)
                    <div class="group flex flex-col bg-white border border-slate-200 rounded-[5px] hover:border-slate-900 transition-all duration-500 shadow-sm hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,0.02)]">
                        
                        <!-- Product Image Area -->
                        <div class="relative aspect-square p-8 bg-slate-50 border-b border-slate-100 overflow-hidden flex items-center justify-center">
                            <img src="{{ $p->image }}" class="w-full h-full object-contain filter grayscale brightness-110 group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                            
                            <!-- Grade Badge: Floating & Dynamic -->
                            @php
                                $gradeColor = match($p->grade) {
                                    'A' => 'bg-emerald-500', 'B' => 'bg-indigo-600', 'C' => 'bg-amber-500', 'D' => 'bg-rose-500', default => 'bg-black'
                                };
                            @endphp
                            <div class="absolute top-0 right-0">
                                <div class="{{ $gradeColor }} text-white text-[10px] font-black px-4 py-2 border-l border-b border-white/20 rounded-bl-[5px] shadow-sm uppercase tracking-widest">
                                    GRADE {{ $p->grade }}
                                </div>
                            </div>
                        </div>

                        <!-- Product Data -->
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[9px] font-black text-indigo-600 uppercase tracking-widest">{{ $p->brand }}</span>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tight italic">Stok: {{ $p->stock }}</span>
                            </div>
                            <h4 class="text-lg font-black uppercase tracking-tight text-slate-800 leading-tight h-12 overflow-hidden group-hover:text-indigo-600 transition-colors">
                                {{ $p->model }}
                            </h4>
                            
                            <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Market Valuation</span>
                                    <span class="text-xl font-black tracking-tighter italic text-slate-900">
                                        Rp{{ number_format($p->price, 0, ',', '.') }}
                                    </span>
                                </div>

                                <a href="{{ route('products.show', $p->id) }}" class="bg-slate-900 text-white p-3 rounded-[5px] hover:bg-indigo-600 transition-all shadow-lg hover:rotate-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-32 text-center border-2 border-dashed border-slate-200 rounded-[5px] bg-slate-50">
                        <p class="text-xs font-black uppercase tracking-[0.5em] text-slate-300">Unit Tidak Tersedia</p>
                    </div>
                    @endforelse
                </div>

                <!-- PAGINATION: BOLD & MINIMAL -->
                <div class="mt-20 border-t border-slate-100 pt-10">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>