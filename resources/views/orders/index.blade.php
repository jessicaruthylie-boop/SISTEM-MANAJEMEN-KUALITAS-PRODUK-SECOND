<x-app-layout>
    <div class="bg-white min-h-screen text-slate-900 font-sans antialiased pb-24">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <h2 class="text-3xl font-black uppercase tracking-tighter mb-10 italic border-b-4 border-slate-900 pb-4 inline-block">Riwayat Pesanan & Keranjang</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- KIRI: DAFTAR PESANAN DIPROSES -->
                <div class="lg:col-span-2 space-y-6">
                    <h3 class="text-xs font-black uppercase tracking-[0.3em] text-indigo-600 mb-6">Pesanan Sedang Diproses</h3>
                    
                    @forelse($orders->where('status', 'Diproses') as $order)
                    <div class="border-2 border-black p-6 rounded-[5px] flex justify-between items-center bg-slate-50">
                        <div class="flex gap-6 items-center">
                            <div class="w-16 h-16 bg-black text-white flex items-center justify-center font-black text-xs rounded-[5px]">📦</div>
                            <div>
                                <h4 class="font-black uppercase text-sm">{{ $order->product_name }}</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Qty: {{ $order->qty }} | Payment: {{ $order->payment_method }}</p>
                                <span class="inline-block mt-2 px-3 py-1 bg-indigo-600 text-white text-[9px] font-black uppercase rounded-[3px]">Status: Dalam Pengantaran</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase leading-none mb-1">Total Bayar</p>
                            <p class="text-lg font-black italic tracking-tighter">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="border-2 border-dashed border-slate-200 p-10 text-center rounded-[5px]">
                        <p class="text-[10px] font-black uppercase text-slate-400">Belum ada pesanan aktif.</p>
                    </div>
                    @endforelse
                </div>

                <!-- KANAN: RINGKASAN KERANJANG -->
                <div class="space-y-6">
                    <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 mb-6">Isi Keranjang Belanja</h3>
                    <div class="border-2 border-black p-8 rounded-[5px] bg-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                        <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-4">
                            <span class="text-xs font-black uppercase italic">Item di Keranjang</span>
                            <span class="bg-black text-white px-3 py-1 rounded-full text-[10px] font-black">{{ $orders->where('status', 'Keranjang')->count() }}</span>
                        </div>
                        
                        <div class="space-y-4 mb-8">
                            @foreach($orders->where('status', 'Keranjang') as $cart)
                            <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-tight">
                                <span class="truncate w-32">{{ $cart->product_name }}</span>
                                <span>Rp{{ number_format($cart->total_price) }}</span>
                            </div>
                            @endforeach
                        </div>

                        <a href="{{ route('products.index') }}" class="block w-full text-center bg-indigo-600 text-white py-3 text-[10px] font-black uppercase tracking-widest rounded-[5px] hover:bg-black transition">Tambah Barang Lagi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>