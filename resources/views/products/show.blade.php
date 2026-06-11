<x-app-layout>
    <div class="bg-[#f4f6f8] min-h-screen text-slate-900 font-sans antialiased pb-20" 
         x-data="{ 
            qty: 1, 
            price: {{ $product->price }}, 
            shipping: 35000, 
            payment: '',
            get subtotal() { return this.qty * this.price },
            get total() { return this.subtotal + this.shipping },
            paymentDetails: {
                'Bank Mandiri': { va: '8891-200' + {{ Auth::id() }}, note: 'MANDIRI VIRTUAL ACCOUNT.' },
                'Bank BCA': { va: '1234-500' + {{ Auth::id() }}, note: 'BCA VIRTUAL ACCOUNT.' },
                'Bank BRI': { va: '1122-800' + {{ Auth::id() }}, note: 'BRIVA BRI.' },
                'Dana': { va: '0812-3456-7890', note: 'DANA MERCHANT SMK-BES.' },
                'Ovo': { va: '0812-3456-7890', note: 'OVO MERCHANT SMK-BES.' }
            }
         }">

        <!-- TOP MINIMAL NAV -->
        <div class="bg-white border-b border-slate-200 sticky top-0 z-[100]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center text-[10px] font-black uppercase tracking-[0.2em]">
                <a href="{{ route('products.index') }}" class="flex items-center gap-2 text-slate-400 hover:text-indigo-600 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    Back to Catalog
                </a>
                <div class="flex items-center gap-4 italic">
                    <span class="text-slate-300">Auth_Session: {{ Auth::user()->name }}</span>
                    <div class="h-4 w-px bg-slate-200"></div>
                    <span class="text-emerald-500 font-black">Secure Checkout</span>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                <!-- KOLOM KIRI: DATA LENGKAP (65%) -->
                <div class="w-full lg:w-[65%] space-y-6">
                    
                    <!-- 1. FRAME PRODUK & MEREK -->
                    <div class="bg-white border-2 border-black rounded-[5px] p-10 shadow-sm relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-6 z-10">
                            <span class="bg-indigo-600 text-white font-black text-xs px-5 py-2 rounded-[3px] uppercase italic shadow-lg">
                                {{ $product->brand }} Official
                            </span>
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <!-- Visual Frame -->
                            <div class="w-full aspect-video bg-[#fafafa] border-2 border-slate-100 rounded-[5px] flex items-center justify-center relative mb-8 overflow-hidden">
                                <img src="{{ $product->image }}" class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none">
                                    <span class="text-[15rem] font-black uppercase italic">{{ $product->brand }}</span>
                                </div>
                            </div>

                            <!-- Merek Teks -->
                            <div class="text-center">
                                <h1 class="text-5xl font-black uppercase tracking-tighter italic text-slate-900 mb-2 leading-none">
                                    {{ $product->model }}
                                </h1>
                                <p class="text-[10px] font-black uppercase tracking-[0.5em] text-indigo-500">Quality Verified Unit</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- 2 & 3. DATA PEMESAN -->
                        <div class="bg-white border-2 border-black rounded-[5px] p-6 shadow-sm">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 flex items-center gap-2 italic">
                                <span class="w-4 h-px bg-indigo-600"></span> Informasi Pemesan
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase block">Nama Pemesan:</span>
                                    <p class="text-xs font-black uppercase tracking-tight">{{ Auth::user()->name }}</p>
                                </div>
                                <div>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase block">Alamat Pengiriman:</span>
                                    <p class="text-xs font-black uppercase tracking-tight">📍 {{ Auth::user()->address }}, {{ Auth::user()->post_code }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- 4. DATA TOKO & LOKASI -->
                        <div class="bg-white border-2 border-black rounded-[5px] p-6 shadow-sm">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 flex items-center gap-2 italic">
                                <span class="w-4 h-px bg-indigo-600"></span> Identitas Toko
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase block">Nama Toko:</span>
                                    <p class="text-xs font-black uppercase tracking-tight text-indigo-600 italic underline">SMK-BES OFFICIAL STORE</p>
                                </div>
                                <div>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase block">Lokasi Toko:</span>
                                    <p class="text-xs font-black uppercase tracking-tight">🏭 {{ $product->location }} (Central Distribution)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DESKRIPSI PRODUK -->
                    <div class="bg-white border-2 border-black rounded-[5px] p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1.5 h-1.5 bg-indigo-600 rounded-full"></div>
                            <h3 class="text-[11px] font-black uppercase tracking-widest text-slate-900 italic">Technical Description Report</h3>
                        </div>
                        <p class="text-xs font-bold leading-relaxed text-slate-500 uppercase italic tracking-wide">
                            "{{ $product->description }}. Unit ini telah melewati fase verifikasi Grade {{ $product->grade }} oleh tim manajemen kualitas."
                        </p>
                    </div>
                </div>

                <!-- KOLOM KANAN: TERMINAL (35%) -->
                <div class="w-full lg:w-[35%] lg:sticky lg:top-24">
                    <div class="bg-slate-900 border-2 border-black rounded-[5px] overflow-hidden shadow-[15px_15px_0px_0px_rgba(79,70,229,1)]">
                        
                        <div class="bg-black p-6 border-b border-slate-800 flex justify-between items-center">
                            <h2 class="text-sm font-black text-white uppercase italic tracking-widest leading-none italic">ORDER_TERMINAL.EXE</h2>
                        </div>

                        <!-- FORM START -->
                        <form action="{{ route('orders.store') }}" method="POST" class="p-8 space-y-8">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" value="{{ $product->model }}">
                            <input type="hidden" name="total_price" :value="total">
                            <input type="hidden" name="qty" :value="qty">

                            <!-- 5. JUMLAH PESANAN -->
                            <div class="space-y-4">
                                <label class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 italic">01. Config_Quantity</label>
                                <div class="flex items-center justify-between bg-white/5 border border-slate-700 rounded-[5px] p-4">
                                    <span class="text-[10px] font-black text-white uppercase italic">Unit_Qty</span>
                                    <div class="flex items-center gap-5">
                                        <button type="button" @click="if(qty > 1) qty--" class="w-8 h-8 flex items-center justify-center border border-slate-600 rounded-[3px] text-white hover:bg-white hover:text-black transition-all">-</button>
                                        <span class="text-lg font-black text-white w-6 text-center italic" x-text="qty"></span>
                                        <button type="button" @click="if(qty < {{ $product->stock }}) qty++" class="w-8 h-8 flex items-center justify-center border border-slate-600 rounded-[3px] text-white hover:bg-white hover:text-black transition-all">+</button>
                                    </div>
                                </div>
                            </div>

                            <!-- PAYMENT -->
                            <div class="space-y-4">
                                <label class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 italic">02. Financial_Protocol</label>
                                <select name="payment_method" x-model="payment" required 
                                        class="w-full bg-slate-800 border border-slate-700 rounded-[5px] p-4 text-[10px] font-black uppercase text-white focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all cursor-pointer">
                                    <option value="">-- SELECT PROTOCOL --</option>
                                    <optgroup label="Bank VA" class="bg-slate-900">
                                        <option value="Bank Mandiri">Mandiri VA</option>
                                        <option value="Bank BCA">BCA VA</option>
                                        <option value="Bank BRI">BRI VA</option>
                                    </optgroup>
                                    <optgroup label="E-Wallet" class="bg-slate-900">
                                        <option value="Dana">Dana App</option>
                                        <option value="Ovo">Ovo App</option>
                                    </optgroup>
                                </select>

                                <!-- VA Display -->
                                <div x-show="payment" x-transition class="p-6 bg-white text-black rounded-[5px] border-l-[8px] border-indigo-600 shadow-xl">
                                    <span class="text-[8px] font-black uppercase tracking-widest text-indigo-600 block mb-1 underline">Billing Number:</span>
                                    <p class="text-xl font-black tracking-widest leading-none italic mb-2" x-text="paymentDetails[payment]?.va"></p>
                                    <p class="text-[8px] font-bold uppercase opacity-60 leading-relaxed italic" x-text="paymentDetails[payment]?.note"></p>
                                </div>
                            </div>

                            <!-- 6 & 7. HARGA ONGKIR & TOTAL -->
                            <div class="border-t border-slate-800 pt-8 space-y-4">
                                <div class="flex justify-between text-[10px] font-black uppercase text-slate-500 italic">
                                    <span>Unit_Subtotal (x<span x-text="qty"></span>)</span>
                                    <span x-text="'Rp' + subtotal.toLocaleString('id-ID')"></span>
                                </div>
                                <div class="flex justify-between text-[10px] font-black uppercase text-slate-500 italic">
                                    <span>Shipping_Logistics (J&T)</span>
                                    <span>Rp35.000</span>
                                </div>
                                
                                <div class="flex justify-between items-center bg-white text-black p-6 rounded-[5px] mt-6 border-b-4 border-indigo-600 shadow-lg">
                                    <div class="flex flex-col leading-none">
                                        <span class="text-[10px] font-black uppercase italic text-indigo-600 italic">Final Price</span>
                                        <span class="text-[7px] font-bold opacity-40 uppercase mt-1 italic tracking-tighter text-black">Tax & QC_Fee Included</span>
                                    </div>
                                    <span class="text-2xl font-black tracking-tighter italic" x-text="'Rp' + total.toLocaleString('id-ID')"></span>
                                </div>
                            </div>

                            <!-- 8. BUTTON ACTIONS -->
                            <div class="grid grid-cols-2 gap-3 pt-4">
                                <button type="submit" name="status" value="Keranjang" class="w-full border border-slate-700 py-4 text-[9px] font-black uppercase tracking-widest rounded-[5px] hover:bg-white hover:text-black transition-all text-slate-500 italic">
                                    + ADD_CART
                                </button>
                                <button type="submit" name="status" value="Diproses" class="w-full bg-indigo-600 py-4 text-[9px] font-black uppercase tracking-widest rounded-[5px] hover:bg-indigo-500 transition-all shadow-lg text-white group italic">
                                    EXECUTIVE ORDER <span class="group-hover:translate-x-1 inline-block transition-transform ml-1">→</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        select { -webkit-appearance: none; -moz-appearance: none; appearance: none; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 5px; }
    </style>
</x-app-layout>