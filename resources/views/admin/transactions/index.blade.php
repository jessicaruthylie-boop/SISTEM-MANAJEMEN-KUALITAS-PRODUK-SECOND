<x-app-layout>
    <div class="flex min-h-screen bg-[#f4f6f8] text-slate-900 font-sans antialiased" x-data="{ sidebarOpen: true, tab: 'ledger' }">
        
        <!-- SIDEBAR NAVIGATION -->
        @include('layouts.admin-sidebar')

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-8 overflow-y-auto overflow-x-hidden">
            
            <!-- SYSTEM HEADER & TAB CONTROL -->
            <div class="max-w-[1600px] mx-auto mb-10 border-b-2 border-black pb-8">
                <div class="flex flex-col md:flex-row justify-between items-end gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="bg-black text-white text-[9px] font-black px-2 py-1 rounded-[3px] tracking-[0.3em]">SECURE_VAULT_V.2.1.2</span>
                            <div class="h-px w-12 bg-indigo-600 shadow-[0_0_8px_#6366f1]"></div>
                        </div>
                        <h1 class="text-5xl font-black uppercase tracking-tighter italic leading-none">Financial Vault.</h1>
                    </div>

                    <!-- TAB NAVIGATION -->
                    <div class="flex border-2 border-black rounded-[5px] p-1 bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <button @click="tab = 'ledger'" :class="tab === 'ledger' ? 'bg-black text-white' : 'text-slate-400 hover:text-black'" class="px-8 py-2 text-[10px] font-black uppercase tracking-widest transition-all rounded-[3px]">01. Ledger</button>
                        <button @click="tab = 'config'" :class="tab === 'config' ? 'bg-black text-white' : 'text-slate-400 hover:text-black'" class="px-8 py-2 text-[10px] font-black uppercase tracking-widest transition-all rounded-[3px]">02. Config</button>
                        <button @click="tab = 'analytics'" :class="tab === 'analytics' ? 'bg-black text-white' : 'text-slate-400 hover:text-black'" class="px-8 py-2 text-[10px] font-black uppercase tracking-widest transition-all rounded-[3px]">03. Analytics</button>
                    </div>
                </div>
            </div>

            <div class="max-w-[1600px] mx-auto">

                <!-- ======================================================= -->
                <!-- TAB 01: LEDGER -->
                <!-- ======================================================= -->
                <div x-show="tab === 'ledger'" class="space-y-10 animate-fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-white border-2 border-black p-6 rounded-[5px] shadow-[6px_6px_0px_0px_rgba(59,130,246,1)]">
                            <span class="text-[9px] font-black uppercase text-slate-400 block mb-2 italic">Cash_Inflow_Dec</span>
                            <h3 class="text-2xl font-black text-blue-600 tracking-tighter italic leading-none">IDR {{ number_format($stats['revenue'], 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-white border-2 border-black p-6 rounded-[5px] shadow-[6px_6px_0px_0px_rgba(241,196,15,1)]">
                            <span class="text-[9px] font-black uppercase text-slate-400 block mb-2 italic">Awaiting_Verify</span>
                            <h3 class="text-2xl font-black text-amber-500 tracking-tighter leading-none">{{ $stats['awaiting'] }} TX</h3>
                        </div>
                        <div class="bg-white border-2 border-black p-6 rounded-[5px]">
                            <span class="text-[9px] font-black uppercase text-slate-400 block mb-2 italic">Active_Queue</span>
                            <h3 class="text-2xl font-black text-blue-500 tracking-tighter leading-none">{{ $stats['pending_tx'] }} Orders</h3>
                        </div>
                        <div class="bg-slate-900 border-2 border-black p-6 rounded-[5px] text-white">
                            <span class="text-[9px] font-black uppercase text-indigo-400 block mb-2 italic">System_Status</span>
                            <h3 class="text-xl font-black text-emerald-400 tracking-widest uppercase italic leading-none">Optimal</h3>
                        </div>
                    </div>

                    <div class="bg-white border-2 border-black rounded-[5px] overflow-hidden shadow-sm">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-black text-white text-[9px] font-black uppercase tracking-[0.2em] italic">
                                    <th class="p-5 border-r border-slate-800">Order_ID & Timestamp</th>
                                    <th class="p-5 border-r border-slate-800">Customer_Persona</th>
                                    <th class="p-5 border-r border-slate-800 text-right">Billing_Total</th>
                                    <th class="p-5 border-r border-slate-800">Payment_Gateway</th>
                                    <th class="p-5 border-r border-slate-800 text-center">Status</th>
                                    <th class="p-5 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-[11px] font-bold uppercase tracking-tight divide-y-2 divide-slate-100 italic">
                                @foreach($orders as $o)
                                <tr class="hover:bg-slate-50 transition-all">
                                    <td class="p-5 border-r border-slate-50 leading-tight">
                                        <span class="block text-slate-900 font-black">#BES-{{ $o->id }}</span>
                                        <span class="text-[8px] text-slate-400">{{ $o->created_at->format('d M Y, H:i') }}</span>
                                    </td>
                                    <td class="p-5 border-r border-slate-50">
                                        <span class="block">{{ $o->user->name }}</span>
                                        <span class="text-[8px] text-indigo-600 font-black tracking-widest">NIK: {{ substr($o->user->nik, 0, 4) }}XXXXXX</span>
                                    </td>
                                    <td class="p-5 border-r border-slate-50 text-right font-black">
                                        Rp{{ number_format($o->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="p-5 border-r border-slate-50">{{ $o->payment_method }}</td>
                                    <td class="p-5 border-r border-slate-50 text-center">
                                        <span class="px-3 py-1 border rounded-full text-[8px] font-black uppercase">{{ $o->status }}</span>
                                    </td>
                                    <td class="p-5 text-center">
                                        @if($o->status == 'Diproses')
                                        <form action="{{ route('admin.transactions.verify', $o->id) }}" method="POST">@csrf @method('PATCH')
                                            <button class="bg-indigo-600 text-white px-4 py-1.5 rounded-[3px] text-[9px] font-black">VERIFY</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ======================================================= -->
                <!-- TAB 02: CONFIG -->
                <!-- ======================================================= -->
                <div x-show="tab === 'config'" class="animate-fade-in space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                        <div class="bg-white border-2 border-black rounded-[5px] p-6 shadow-sm">
                            <h3 class="text-xs font-black uppercase italic tracking-widest mb-6 border-b-2 border-black pb-3 text-indigo-600">01. Bank VA</h3>
                            <div class="space-y-3">
                                @foreach(['BCA' => '3901', 'Mandiri' => '88608', 'BNI' => '8241'] as $name => $code)
                                <div class="p-3 border border-slate-200 rounded-[5px]">
                                    <span class="text-[9px] font-black uppercase text-slate-400 block">{{ $name }}</span>
                                    <input type="text" value="{{ $code }} + [NIK]" class="w-full bg-slate-50 border-0 border-b border-slate-200 text-[10px] font-black text-[#00A3FF] p-1 focus:ring-0">
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-slate-900 border-2 border-black rounded-[5px] p-6 text-white shadow-lg">
                            <h3 class="text-xs font-black uppercase italic tracking-widest mb-6 border-b border-slate-700 pb-3 text-indigo-400">02. E-Wallet Hub</h3>
                            <div class="space-y-4">
                                <label class="text-[8px] font-black uppercase text-slate-500 block">Gateway Number:</label>
                                <input type="text" value="0812-7788-9900" class="w-full bg-transparent border-2 border-slate-700 rounded-[5px] p-3 text-xl font-black text-[#00A3FF] focus:ring-0 italic">
                                <p class="text-[8px] font-bold text-slate-500 uppercase tracking-widest">A/N: SMK-BES QUALITY MGMT</p>
                            </div>
                        </div>

                        <div class="bg-white border-2 border-black rounded-[5px] p-8 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
                            <h3 class="text-xs font-black uppercase italic tracking-widest mb-6 border-b-2 border-black pb-3 text-indigo-600">03. Protocol</h3>
                            <textarea class="w-full h-40 bg-slate-50 border-2 border-slate-100 rounded-[5px] text-[10px] font-bold uppercase text-slate-500 p-4 focus:ring-0">VA Valid selama 24 jam. Verifikasi otomatis 1-5 menit. E-wallet verifikasi manual.</textarea>
                            <button class="mt-6 w-full bg-indigo-600 text-white border-2 border-black py-4 rounded-[5px] font-black uppercase text-[10px]">COMMIT_CONFIG.EXE</button>
                        </div>
                    </div>
                </div>

                <!-- ======================================================= -->
                <!-- TAB 03: ANALYTICS (FIXED) -->
                <!-- ======================================================= -->
                <div x-show="tab === 'analytics'" class="animate-fade-in space-y-10">
                    
                    <!-- 1. KPI CARDS -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-white border-2 border-black p-6 rounded-[5px] shadow-[6px_6px_0px_0px_rgba(59,130,246,1)]">
                            <span class="text-[9px] font-black uppercase text-slate-400 block mb-2 leading-none">Total_Gross_Revenue</span>
                            <h3 class="text-2xl font-black italic tracking-tighter text-blue-600 leading-none">IDR 425.5M</h3>
                        </div>
                        <div class="bg-white border-2 border-black p-6 rounded-[5px] shadow-[6px_6px_0px_0px_rgba(16,185,129,1)]">
                            <span class="text-[9px] font-black uppercase text-slate-400 block mb-2 leading-none">Net_Profit_15%</span>
                            <h3 class="text-2xl font-black italic tracking-tighter text-emerald-500 leading-none">IDR 63.8M</h3>
                        </div>
                        <div class="bg-white border-2 border-black p-6 rounded-[5px] shadow-[6px_6px_0px_0px_rgba(241,196,15,1)]">
                            <span class="text-[9px] font-black uppercase text-slate-400 block mb-2 leading-none">Success_Rate</span>
                            <h3 class="text-2xl font-black italic tracking-tighter leading-none">94.2%</h3>
                        </div>
                        <div class="bg-slate-900 border-2 border-black p-6 rounded-[5px] text-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                            <span class="text-[9px] font-black text-indigo-400 block mb-2 leading-none italic">Avg_Order_Value</span>
                            <h3 class="text-2xl font-black italic tracking-tighter leading-none">IDR 2.8M</h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
                        <!-- Revenue Growth Chart -->
                        <div class="bg-white border-2 border-black rounded-[5px] p-8 shadow-sm">
                            <h3 class="text-xs font-black uppercase tracking-widest mb-10 border-b-2 border-black pb-4 text-indigo-600 underline italic">01. Weekly Revenue Chart</h3>
                            <div class="h-64 flex items-end justify-between gap-4 px-4 border-l-2 border-b-2 border-black pb-1 relative">
                                @foreach([40, 70, 45, 90, 60, 100, 85] as $val)
                                <div class="flex-1 bg-indigo-600 rounded-t-[2px] transition-all hover:bg-black group relative" style="height: {{ $val }}%">
                                    <span class="absolute -top-10 left-1/2 -translate-x-1/2 text-[10px] font-black opacity-0 group-hover:opacity-100 bg-white border-2 border-black px-2 py-1 shadow-md z-20">{{ $val }}M</span>
                                </div>
                                @endforeach
                            </div>
                            <div class="flex justify-between mt-6 text-[9px] font-black uppercase text-slate-400 italic">
                                <span>MON</span><span>TUE</span><span>WED</span><span>THU</span><span>FRI</span><span>SAT</span><span>SUN</span>
                            </div>
                        </div>

                        <!-- User Surveillance Logs -->
                        <div class="bg-white border-2 border-black rounded-[5px] p-8 shadow-sm">
                            <h3 class="text-xs font-black uppercase italic tracking-widest mb-8 border-b-2 border-black pb-4 text-indigo-600">02. Core User Behavior</h3>
                            <div class="space-y-4">
                                @foreach([
                                    ['n' => 'Jessica Ruth', 't' => 5, 's' => '22.5M', 'i' => 'JR'],
                                    ['n' => 'Dionysius', 't' => 3, 's' => '35.2M', 'i' => 'DN'],
                                    ['n' => 'Christina', 't' => 4, 's' => '12.8M', 'i' => 'CH'],
                                ] as $usr)
                                <div class="p-5 bg-slate-900 text-white rounded-[5px] relative group overflow-hidden shadow-lg border-l-[8px] border-indigo-600">
                                    <div class="flex justify-between items-start relative z-10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 bg-indigo-600 flex items-center justify-center font-black italic text-sm rounded-[3px]">{{ $usr['i'] }}</div>
                                            <div>
                                                <h4 class="text-xs font-black uppercase italic tracking-widest mb-1">{{ $usr['n'] }}</h4>
                                                <p class="text-[8px] font-bold text-slate-500 uppercase tracking-[0.2em] italic">Validated_Persona</p>
                                            </div>
                                        </div>
                                        <span class="text-indigo-400 font-black italic text-[10px]">TX: {{ $usr['t'] }}</span>
                                    </div>
                                    <div class="mt-6 flex justify-between items-end relative z-10">
                                        <div class="flex flex-col">
                                            <span class="text-[8px] font-black uppercase text-slate-500 italic mb-2">Total Expenditure</span>
                                            <span class="text-xl font-black tracking-tighter text-white italic">IDR {{ $usr['s'] }}</span>
                                        </div>
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_8px_#10b981]"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER STATUS -->
                    <div class="mt-20 border-t-2 border-slate-200 pt-8 flex flex-col md:flex-row justify-between items-center gap-6 opacity-40 italic">
                        <div class="flex gap-10 text-[9px] font-black uppercase tracking-widest">
                            <div><span>System:</span><span class="text-emerald-600 ml-2">OPTIMAL</span></div>
                            <div><span>Model:</span><span class="text-indigo-600 ml-2">LINEAR_RECURSIVE</span></div>
                        </div>
                        <p class="text-[9px] font-black uppercase tracking-[0.2em]">SMK-BES © {{ date('Y') }}</p>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- STYLES -->
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
    </style>
</x-app-layout>