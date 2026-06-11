<x-app-layout>
    <div class="bg-white min-h-screen text-slate-900 pb-20 px-6 font-sans antialiased">
        <div class="max-w-4xl mx-auto py-12">
            
            <!-- BREADCRUMB HEADER -->
            <div class="mb-10 border-l-8 border-black pl-6">
                <nav class="flex text-[9px] font-black uppercase tracking-[0.3em] text-slate-400 mb-2 gap-2 leading-none">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
                    <span>/</span>
                    <a href="{{ route('admin.inventory.index') }}" class="hover:text-indigo-600">Inventory</a>
                    <span>/</span>
                    <span class="text-indigo-600 italic">Create_New</span>
                </nav>
                <h2 class="text-4xl font-black uppercase italic tracking-tighter leading-none text-slate-900 mt-2">REGISTER_NEW_UNIT.SYS</h2>
            </div>

            <!-- FORM START DENGAN LOGIKA FORMAL -->
            <form action="{{ route('admin.inventory.store') }}" method="POST" class="space-y-10" 
                  x-data="{ 
                    selectedGrade: '', 
                    category: '',
                    rawPrice: '',
                    formatIDR(val) {
                        if (!val) return 'Rp0';
                        return 'Rp' + new Intl.NumberFormat('id-ID').format(val);
                    },
                    brandData: {
                        'Smartphone': ['Samsung', 'Apple (iPhone)', 'Xiaomi', 'Oppo', 'Vivo', 'Realme', 'Infinix', 'Tecno', 'itel'],
                        'Laptop': ['MacBook (Apple)', 'ASUS', 'Lenovo', 'HP', 'Dell', 'Acer', 'MSI', 'Axioo'],
                        'Komputer / PC': ['Dell', 'HP', 'Lenovo', 'ASUS', 'Acer', 'Apple', 'MSI'],
                        'Televisi (TV)': ['Samsung TV', 'LG TV', 'Sony Bravia', 'TCL TV', 'Panasonic TV', 'Sharp TV', 'Polytron TV'],
                        'Kulkas': ['LG Refrigerator', 'Samsung Refrigerator', 'Sharp Refrigerator', 'Panasonic Refrigerator'],
                        'Mesin Cuci': ['LG Washing Machine', 'Samsung Washing Machine', 'Sharp Washing Machine'],
                        'AC (Air Conditioner)': ['Daikin AC', 'Panasonic AC', 'LG AC', 'Samsung AC', 'Sharp AC'],
                        'Kipas Angin': ['Cosmos', 'Miyako', 'Maspion', 'Panasonic', 'Sharp', 'Sekai'],
                        'Speaker': ['JBL', 'Sony Audio', 'Bose', 'Samsung Audio', 'Harman Kardon', 'Marshall'],
                        'Headphone': ['Sony', 'Bose', 'Sennheiser', 'JBL', 'Audio-Technica', 'Beats'],
                        'Earphone': ['Sony', 'JBL', 'Xiaomi', 'Samsung', 'Razer', 'Apple']
                    }
                  }">
                
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="grade" :value="selectedGrade" required>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    
                    <!-- SISI KIRI: TAKSONOMI -->
                    <div class="space-y-8">
                        <!-- 01. Category -->
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block italic">01. Select Department</label>
                            <select name="category" x-model="category" required 
                                    class="w-full border-2 border-black rounded-[5px] p-4 text-xs font-black uppercase focus:ring-0 focus:border-indigo-600 transition-all bg-slate-50">
                                <option value="">-- CHOOSE CATEGORY --</option>
                                <template x-for="(brands, cat) in brandData" :key="cat">
                                    <option :value="cat" x-text="cat"></option>
                                </template>
                            </select>
                        </div>

                        <!-- 02. Brand -->
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block italic">02. Select Brand</label>
                            <select name="brand" required 
                                    class="w-full border-2 border-black rounded-[5px] p-4 text-xs font-black uppercase focus:ring-0 focus:border-indigo-600 transition-all bg-slate-50 disabled:opacity-30"
                                    :disabled="!category">
                                <option value="">-- CHOOSE BRAND --</option>
                                <template x-if="category" x-for="brand in brandData[category]" :key="brand">
                                    <option :value="brand" x-text="brand"></option>
                                </template>
                            </select>
                        </div>

                        <!-- 03. Quality Grading -->
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 block italic">03. Quality Grading (Select One)</label>
                            <div class="grid grid-cols-4 gap-3">
                                @foreach(['A', 'B', 'C', 'D'] as $grade)
                                <button type="button" 
                                        @click="selectedGrade = '{{ $grade }}'"
                                        :class="selectedGrade === '{{ $grade }}' ? 'bg-indigo-600 border-indigo-600 text-white shadow-lg' : 'bg-white border-slate-200 text-slate-400 hover:border-black hover:text-black'"
                                        class="h-16 border-2 rounded-[5px] flex items-center justify-center font-black text-xl italic transition-all duration-200 uppercase">
                                    {{ $grade }}
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- SISI KANAN: HARGA & TEKNIS -->
                    <div class="space-y-8">
                        <!-- 04. Model Name -->
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 block italic">04. Model Name / Serial</label>
                            <input type="text" name="model" required 
                                   class="w-full border-2 border-black rounded-[5px] p-4 text-xs font-black uppercase focus:ring-0 focus:border-indigo-600 placeholder:opacity-20" 
                                   placeholder="e.g. GALAXY S24 ULTRA">
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <!-- 05. Pricing (LIVE FORMATTER) -->
                            <div class="relative">
                                <label class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-3 block italic">05. Pricing (IDR - JUTAAN)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 font-black text-xs opacity-40">IDR</span>
                                    <input type="number" name="price" x-model="rawPrice" required 
                                           class="w-full border-2 border-black rounded-[5px] p-4 pl-12 text-xs font-black italic focus:ring-0 placeholder:opacity-20"
                                           placeholder="e.g. 15000000">
                                </div>
                                <!-- FORMATTER PREVIEW -->
                                <div class="mt-2 flex justify-between items-center px-2">
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Verification Value:</span>
                                    <span class="text-xs font-black text-indigo-600 italic tracking-tighter bg-indigo-50 px-2 py-0.5 rounded-[3px]" x-text="formatIDR(rawPrice)"></span>
                                </div>
                            </div>
                            
                            <!-- 06. Stock & Location -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block italic">06. Qty Stock</label>
                                    <input type="number" name="stock" required 
                                           class="w-full border-2 border-black rounded-[5px] p-3 text-xs font-black italic focus:ring-0">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block italic">07. Warehouse</label>
                                    <input type="text" name="location" required 
                                           class="w-full border-2 border-black rounded-[5px] p-3 text-xs font-black uppercase focus:ring-0" 
                                           placeholder="JAKARTA">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 08. Description -->
                <div class="pt-6 border-t-2 border-slate-50">
                    <label class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mb-4 block italic underline">08. Technical Inspection Report (Description)</label>
                    <textarea name="description" required rows="6" 
                              class="w-full border-2 border-black rounded-[5px] p-6 text-xs font-bold uppercase italic leading-relaxed focus:ring-0 focus:border-indigo-600 bg-[#fdfdfd]" 
                              placeholder="MASUKKAN ANALISA FISIK DAN FUNGSIONAL UNIT..."></textarea>
                </div>

                <!-- ACTIONS BUTTON -->
                <div class="mt-12 flex flex-col md:flex-row gap-4 border-t-2 border-black pt-10">
                    <button type="submit" 
                            class="flex-1 bg-indigo-600 text-white border-2 border-black py-5 rounded-[5px] font-black uppercase tracking-[0.3em] hover:bg-black transition-all shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] active:translate-y-1 active:shadow-none">
                        PUBLISH_TO_ARCHIVE.EXE
                    </button>
                    <a href="{{ route('admin.inventory.index') }}" 
                       class="px-12 border-2 border-black flex items-center justify-center font-black text-[10px] uppercase rounded-[5px] hover:bg-slate-50 italic transition-all">
                        CANCEL_PROCESS
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>