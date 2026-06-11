<x-app-layout>
    <div class="bg-[#f8fafc] min-h-screen text-slate-900 font-sans antialiased pb-24">
        <div class="max-w-5xl mx-auto px-6 py-12">
            
            <!-- HEADER -->
            <div class="flex items-center gap-6 mb-12">
                <h2 class="text-4xl font-black uppercase tracking-tighter italic leading-none text-indigo-600">Keranjang.</h2>
                <div class="h-px flex-1 bg-slate-300"></div>
                <div class="text-[10px] font-black uppercase text-slate-400 tracking-[0.3em] whitespace-nowrap">
                    Items_In_Bucket: {{ $carts->count() }}
                </div>
            </div>

            <!-- LIST ITEMS -->
            <div class="space-y-4">
                @forelse($carts as $item)
                <div class="bg-white border-2 border-black rounded-[5px] p-6 flex flex-col md:flex-row justify-between items-center shadow-[6px_6px_0px_0px_rgba(0,0,0,0.05)] hover:shadow-[6px_6px_0px_0px_rgba(79,70,229,1)] transition-all group">
                    <div class="flex items-center gap-8">
                        <!-- Placeholder Image -->
                        <div class="w-20 h-20 bg-slate-100 border border-slate-200 rounded-[5px] flex items-center justify-center font-black text-indigo-600 italic text-xs uppercase overflow-hidden">
                            Unit
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest block mb-1">Ref_ID: #00{{ $item->product_id }}</span>
                            <h4 class="text-xl font-black uppercase italic leading-none mb-3 group-hover:text-indigo-600 transition-colors">{{ $item->product_name }}</h4>
                            <div class="flex gap-4 text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                <span>Quantity: <span class="text-black">{{ $item->qty }}</span></span>
                                <span>|</span>
                                <span>Method: <span class="text-black">{{ $item->payment_method }}</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 md:mt-0 flex items-center gap-12">
                        <div class="text-right">
                            <span class="text-[9px] font-black uppercase text-slate-300 block mb-1 tracking-widest leading-none">Subtotal Valuation</span>
                            <span class="text-2xl font-black italic tracking-tighter text-slate-900 leading-none">
                                Rp{{ number_format($item->total_price, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex gap-3">
                            <!-- BUTTON PESAN (Checkout) -->
                            <form action="{{ route('orders.checkout', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-[5px] text-[10px] font-black uppercase tracking-widest hover:bg-black transition-all shadow-lg">
                                    Pesan
                                </button>
                            </form>

                            <!-- BUTTON BATALKAN (Delete) -->
                            <form action="{{ route('orders.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin membatalkan item ini dari keranjang?')" 
                                        class="border-2 border-black text-black px-6 py-3 rounded-[5px] text-[10px] font-black uppercase tracking-widest hover:bg-red-600 hover:text-white hover:border-red-600 transition-all">
                                    Batalkan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Tampilan Jika Kosong -->
                <div class="text-center py-32 border-4 border-dashed border-slate-200 rounded-[5px] bg-white">
                    <div class="text-5xl mb-6 opacity-20">🛒</div>
                    <p class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-400 italic">No Items Found in Your Bucket</p>
                    <a href="{{ route('products.index') }}" class="inline-block mt-10 bg-black text-white px-10 py-4 text-[10px] font-black uppercase tracking-widest rounded-[5px] hover:bg-indigo-600 transition-all">
                        Return to Katalog →
                    </a>
                </div>
                @endforelse
            </div>

            <!-- FOOTER INFO -->
            <div class="mt-20 border-t border-slate-200 pt-8 flex justify-between items-center opacity-30">
                <span class="text-[8px] font-black uppercase tracking-widest italic">Inventory Bucket System v.2.0</span>
                <span class="text-[8px] font-black uppercase tracking-widest italic">All transactions are encrypted</span>
            </div>
        </div>
    </div>
</x-app-layout>