<x-app-layout>
    <div class="bg-white min-h-screen text-slate-900 font-sans antialiased pb-24">
        
        <!-- SYSTEM STATUS LINE -->
        <div class="border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-6 py-2 flex justify-between items-center">
                <div class="flex items-center gap-4 text-[10px] font-bold tracking-[0.2em] uppercase text-slate-400">
                    <span>System: SMK-BES v2.0</span>
                    <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                    <span>Status: <span class="text-emerald-600">Operational</span></span>
                </div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    {{ date('l, d F Y') }}
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 mt-12">
            
            <!-- HERO: MINIMALIST STRUCTURE -->
            <div class="border-2 border-slate-900 rounded-[5px] p-10 md:p-16 mb-8 relative bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,0.05)]">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-block border border-indigo-600 text-indigo-600 text-[10px] font-black px-3 py-1 uppercase tracking-widest rounded-[5px] mb-6">
                            Verified Management
                        </div>
                        <h1 class="text-5xl md:text-6xl font-black leading-[0.9] tracking-tighter uppercase mb-8">
                            Kualitas <br>Tanpa <br><span class="text-indigo-600">Kompromi.</span>
                        </h1>
                        <p class="max-w-sm text-sm font-medium leading-relaxed text-slate-500 mb-10 uppercase tracking-tight">
                            Selamat datang di sistem manajemen kualitas elektronik sekon. Platform inspeksi terpercaya untuk unit Grade A hingga D.
                        </p>
                        <div class="flex gap-4">
                            <a href="{{ route('products.index') }}" class="bg-indigo-600 text-white px-10 py-4 text-[11px] font-black uppercase tracking-widest rounded-[5px] hover:bg-slate-900 transition-all">
                                Katalog Produk
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:flex flex-col gap-4 border-l border-slate-200 pl-12">
                        <div class="py-4">
                            <span class="block text-4xl font-black tracking-tighter italic">99.2%</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akurasi Verifikasi</span>
                        </div>
                        <div class="py-4 border-y border-slate-100">
                            <span class="block text-4xl font-black tracking-tighter italic">24/7</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Monitoring Sistem</span>
                        </div>
                        <div class="py-4">
                            <span class="block text-4xl font-black tracking-tighter italic">10+</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori Elektronik</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QUALITY GRADE LEGEND (CATATAN BARU) -->
            <div class="mb-16 grid grid-cols-2 md:grid-cols-4 border border-slate-200 rounded-[5px] divide-x divide-slate-200 overflow-hidden">
                <div class="p-4 flex items-center gap-4 bg-white">
                    <span class="text-[10px] font-black bg-emerald-500 text-white px-2 py-1 rounded-[3px]">GR. A</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">SANGAT BAGUS</span>
                </div>
                <div class="p-4 flex items-center gap-4 bg-white">
                    <span class="text-[10px] font-black bg-indigo-600 text-white px-2 py-1 rounded-[3px]">GR. B</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">BAGUS</span>
                </div>
                <div class="p-4 flex items-center gap-4 bg-white">
                    <span class="text-[10px] font-black bg-amber-500 text-white px-2 py-1 rounded-[3px]">GR. C</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">CUKUP BAGUS</span>
                </div>
                <div class="p-4 flex items-center gap-4 bg-white">
                    <span class="text-[10px] font-black bg-rose-500 text-white px-2 py-1 rounded-[3px]">GR. D</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">KURANG BAGUS</span>
                </div>
            </div>

            <!-- SECTION HEADER -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-1 bg-indigo-600 rounded-[5px]"></span>
                    <h2 class="text-3xl font-black uppercase tracking-tighter italic">Recommended</h2>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em]">
                    5 Unit dengan skor inspeksi tertinggi minggu ini
                </p>
            </div>

            <!-- PRODUCT GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                @foreach($recommendations as $item)
                @php
                    $gradeTheme = match($item->grade) {
                        'A' => 'border-emerald-500 text-emerald-600',
                        'B' => 'border-indigo-600 text-indigo-600',
                        'C' => 'border-amber-500 text-amber-600',
                        'D' => 'border-rose-500 text-rose-600',
                        default => 'border-slate-900 text-slate-900'
                    };
                @endphp
                <div class="group flex flex-col bg-white border border-slate-200 rounded-[5px] hover:border-slate-900 transition-all duration-300">
                    
                    <div class="relative aspect-square p-6 bg-slate-50 border-b border-slate-100 flex items-center justify-center overflow-hidden rounded-t-[4px]">
                        <img src="{{ $item->image }}" class="w-full h-full object-contain filter grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                        <div class="absolute top-3 right-3">
                            <div class="bg-white border-2 {{ $gradeTheme }} text-[10px] font-black px-3 py-1 rounded-[5px] uppercase shadow-sm">
                                GR.{{ $item->grade }}
                            </div>
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <span class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em] mb-2">{{ $item->category }}</span>
                        <h3 class="text-sm font-black uppercase tracking-tight text-slate-800 leading-snug h-10 overflow-hidden mb-6 group-hover:text-indigo-600 transition-colors">
                            {{ $item->model }}
                        </h3>
                        
                        <div class="mt-auto pt-6 border-t border-slate-100 flex flex-col gap-4">
                            <div class="flex flex-col">
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Fixed Price</span>
                                <span class="text-xl font-black tracking-tighter text-slate-900 italic">
                                    Rp{{ number_format($item->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('products.show', $item->id) }}" class="w-full bg-slate-900 text-white text-center py-3 text-[10px] font-black uppercase tracking-widest rounded-[5px] hover:bg-indigo-600 transition-all">
                                Detail Unit
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- QUICK NAVIGATION -->
            <div class="mt-24">
                <div class="flex items-center gap-6 mb-10 text-[10px] font-black uppercase tracking-[0.4em] text-slate-300">
                    <span class="whitespace-nowrap">Browse by Category</span>
                    <span class="w-full h-px bg-slate-200"></span>
                </div>
                <div class="flex flex-wrap justify-center gap-3">
                    @foreach(['Smartphone', 'Laptop', 'PC', 'Tablet', 'Television', 'Fridge', 'Washer', 'AC', 'Fan', 'Audio'] as $cat)
                    <a href="{{ route('products.index', ['category' => $cat]) }}" class="px-8 py-3 bg-white border border-slate-200 rounded-[5px] text-[10px] font-black uppercase tracking-widest text-slate-500 hover:border-slate-900 hover:text-slate-900 transition-all">
                        {{ $cat }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- FOOTER INFO BOX -->
            <div class="mt-24 border-2 border-slate-900 rounded-[5px] overflow-hidden flex flex-col md:flex-row">
                <div class="p-10 border-b md:border-b-0 md:border-r border-slate-900 flex-1">
                    <h4 class="text-xs font-black uppercase mb-4 text-indigo-600 tracking-widest italic">Verification</h4>
                    <p class="text-xs font-medium text-slate-500 leading-relaxed uppercase">Proses pengecekan 21 titik komponen fisik dan fungsional untuk setiap unit elektronik seken.</p>
                </div>
                <div class="p-10 border-b md:border-b-0 md:border-r border-slate-900 flex-1">
                    <h4 class="text-xs font-black uppercase mb-4 text-indigo-600 tracking-widest italic">Shipping</h4>
                    <p class="text-xs font-medium text-slate-500 leading-relaxed uppercase">Pengemasan standar logistik aman dengan proteksi kayu dan asuransi penuh untuk seluruh wilayah.</p>
                </div>
                <div class="p-10 flex-1">
                    <h4 class="text-xs font-black uppercase mb-4 text-indigo-600 tracking-widest italic">Guaranteed</h4>
                    <p class="text-xs font-medium text-slate-500 leading-relaxed uppercase">Garansi transparansi kondisi barang sesuai dengan grade yang telah ditentukan oleh tim QC kami.</p>
                </div>
            </div>

            <div class="mt-20 text-center text-[10px] font-bold text-slate-300 uppercase tracking-[0.4em]">
                SMK-BES © {{ date('Y') }} Quality Management System
            </div>
        </div>
    </div>
</x-app-layout>