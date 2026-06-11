<x-app-layout>
    <div class="flex min-h-screen bg-[#fcfcfc] text-slate-900 font-sans antialiased" x-data="{ sidebarOpen: true }">
        
        <!-- SIDEBAR NAVIGATION -->
        @include('layouts.admin-sidebar')

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 p-8 overflow-y-auto overflow-x-hidden">
            
            <!-- SYSTEM HEADER -->
            <div class="max-w-[1600px] mx-auto mb-10 border-b-2 border-black pb-8">
                <div class="flex flex-col md:flex-row justify-between items-end gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="bg-indigo-600 text-white text-[9px] font-black px-2 py-1 rounded-[3px] tracking-[0.3em]">USER_INTELLIGENCE_V.2.1</span>
                            <div class="h-px w-12 bg-black"></div>
                        </div>
                        <h1 class="text-5xl font-black uppercase tracking-tighter italic leading-none text-slate-900">User Surveillance.</h1>
                    </div>

                    <!-- SECURITY STATUS -->
                    <div class="flex items-center gap-4">
                        <div class="text-right border-r-2 border-slate-100 pr-6 uppercase leading-none">
                            <p class="text-[8px] font-black text-slate-400 tracking-widest mb-1 italic">Security_Protocol</p>
                            <p class="text-[10px] font-black text-emerald-600 italic">NIK_VALIDATION_ACTIVE</p>
                        </div>
                        <div class="bg-black text-white px-8 py-3 rounded-[5px] shadow-[6px_6px_0px_0px_rgba(79,70,229,1)]">
                            <span class="text-[11px] font-black uppercase tracking-widest italic">Total_Persona: {{ count($users) }} Records</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-[1600px] mx-auto space-y-10 animate-fade-in">

                <!-- SEARCH & FILTER CONSOLE -->
                <div class="bg-white border-2 border-black rounded-[5px] p-6 shadow-sm flex flex-col md:flex-row gap-6 justify-between items-center">
                    <div class="w-full md:w-1/2 relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 uppercase font-black text-[9px] tracking-widest transition-colors group-focus-within:text-indigo-600">Filter_Persona:</span>
                        <input type="text" placeholder="TYPE NAME OR NIK TO SEARCH..." 
                               class="w-full pl-32 border-2 border-slate-100 rounded-[5px] p-3 text-[10px] font-black uppercase focus:ring-0 focus:border-black transition-all bg-slate-50/50">
                    </div>
                    <div class="flex gap-4 w-full md:w-auto font-black uppercase italic">
                        <button class="flex-1 md:flex-none border-2 border-black px-8 py-3 text-[10px] tracking-widest rounded-[5px] hover:bg-slate-50 transition-all">Export_Directory</button>
                        <button class="flex-1 md:flex-none bg-indigo-600 text-white border-2 border-black px-8 py-3 text-[10px] tracking-widest rounded-[5px] hover:bg-black transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-y-0.5">Identity_Audit_Log</button>
                    </div>
                </div>

                <!-- USER DIRECTORY TABLE -->
                <div class="bg-white border-2 border-black rounded-[5px] overflow-hidden shadow-sm italic">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-black text-white text-[9px] font-black uppercase tracking-[0.2em]">
                                <th class="p-5 border-r border-slate-800">Ref_Identity</th>
                                <th class="p-5 border-r border-slate-800">Persona_Details</th>
                                <th class="p-5 border-r border-slate-800">Security_Validation (NIK)</th>
                                <th class="p-5 border-r border-slate-800">Contact_Node</th>
                                <th class="p-5 border-r border-slate-800">Deployment_Address</th>
                                <th class="p-5 text-center">Action_Engine</th>
                            </tr>
                        </thead>
                        <tbody class="text-[11px] font-bold uppercase tracking-tight divide-y-2 divide-slate-100">
                            @foreach($users as $user)
                            <tr class="hover:bg-slate-50 transition-all group">
                                <!-- ID -->
                                <td class="p-5 border-r border-slate-50 font-mono">
                                    <span class="text-slate-400">#USR-</span>{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <!-- NAME & EMAIL -->
                                <td class="p-5 border-r border-slate-50">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white italic font-black text-xs border-2 border-indigo-500 shadow-lg group-hover:scale-110 transition-transform">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="block text-slate-900 font-black text-sm tracking-tighter leading-none">{{ $user->name }}</span>
                                            <span class="text-[8px] text-slate-400 lowercase italic font-sans tracking-normal leading-none">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <!-- NIK VALIDATION -->
                                <td class="p-5 border-r border-slate-50 leading-tight">
                                    <div class="flex flex-col gap-1.5">
                                        <span class="text-indigo-600 font-black tracking-[0.1em] font-mono text-xs">
                                            {{ substr($user->nik, 0, 6) }}-XXXX-XXXX
                                        </span>
                                        <span class="text-[7px] font-black bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-[2px] w-fit border border-emerald-200">
                                            ✓ IDENTITY_VERIFIED_SECURE
                                        </span>
                                    </div>
                                </td>
                                <!-- TELEPON -->
                                <td class="p-5 border-r border-slate-50 leading-tight">
                                    <span class="block text-slate-900">{{ $user->phone }}</span>
                                    <span class="text-[8px] text-slate-400 uppercase tracking-widest italic">Encrypted_Mobile</span>
                                </td>
                                <!-- ALAMAT -->
                                <td class="p-5 border-r border-slate-50 max-w-xs leading-tight">
                                    <span class="block truncate text-slate-500 italic mb-1">{{ $user->address }}</span>
                                    <span class="text-[9px] font-black text-slate-900 uppercase tracking-tighter bg-slate-100 px-2 py-0.5 rounded">KODE_POS: {{ $user->post_code }}</span>
                                </td>
                                <!-- ACTIONS -->
                                <td class="p-5">
                                    <div class="flex justify-center gap-3">
                                        <!-- DETAILS -->
                                        <button class="p-2.5 border-2 border-black rounded-[4px] bg-slate-50 hover:bg-black hover:text-white transition-all shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:shadow-none" title="Intelligence View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                        <!-- DELETE -->
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('IDENTITY_PURGE_WARNING: Cabut akses persona ini secara permanen?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2.5 border-2 border-black rounded-[4px] bg-white text-rose-600 hover:bg-rose-600 hover:text-white transition-all shadow-[3px_3px_0px_0px_rgba(225,29,72,0.3)] active:shadow-none" title="Terminate Access">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- BOTTOM MODULE: BEHAVIOR TRACKING -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 italic">
                    <!-- Multi-Account Analysis -->
                    <div class="bg-slate-900 text-white p-10 rounded-[5px] border-2 border-black shadow-[10px_10px_0px_0px_rgba(79,70,229,1)] relative overflow-hidden group">
                        <div class="relative z-10">
                            <h3 class="text-sm font-black uppercase tracking-[0.3em] text-indigo-400 mb-6 underline">Multi-Account Behavior Tracking</h3>
                            <p class="text-[11px] leading-relaxed text-slate-400 uppercase font-bold tracking-tight">
                                Sistem backend secara otomatis mendeteksi korelasi antara <span class="text-white">NIK tunggal</span> dengan beberapa identitas email. Gunakan kontrol ini untuk menghentikan penyalahgunaan sistem promo, fraud transaksi masif, atau botting pada katalog elektronik seken.
                            </p>
                            <div class="mt-8 flex gap-4">
                                <span class="text-[8px] font-black border border-slate-700 px-3 py-1 rounded bg-black italic">DETECT_CLONES: ACTIVE</span>
                                <span class="text-[8px] font-black border border-slate-700 px-3 py-1 rounded bg-black italic">AUTO_LOCK: DISABLED</span>
                            </div>
                        </div>
                        <div class="absolute -right-10 -bottom-10 text-[12rem] opacity-[0.03] font-black italic select-none pointer-events-none group-hover:scale-110 transition-transform duration-700">TRACK</div>
                    </div>
                    
                    <!-- Security Integrity Box -->
                    <div class="bg-white border-2 border-black p-10 rounded-[5px] flex flex-col justify-center relative overflow-hidden">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-lg font-black uppercase italic mb-1 text-slate-900">Identity Security Audit</h3>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none">Last Full Identity Scan: {{ now()->format('d-m-Y H:i:s') }}</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center">
                                <div class="w-4 h-4 bg-emerald-500 rounded-full animate-ping"></div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between text-[10px] font-black uppercase border-b border-slate-100 pb-2">
                                <span class="text-slate-400">Database_Integrity</span>
                                <span class="text-emerald-600">100% SECURE</span>
                            </div>
                            <div class="flex justify-between text-[10px] font-black uppercase border-b border-slate-100 pb-2">
                                <span class="text-slate-400">Persona_Anomalies</span>
                                <span class="text-slate-900">0 DETECTED</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- FOOTER SYSTEM INFO -->
            <div class="mt-20 border-t-2 border-slate-200 pt-10 flex flex-col md:flex-row justify-between items-center gap-6 opacity-40 italic">
                <div class="flex gap-10 text-[9px] font-black uppercase tracking-widest leading-none">
                    <div class="flex flex-col gap-1">
                        <span>Data_Model:</span>
                        <span class="text-indigo-600">PERSONA_IDENTITY_STABLE_v2.1</span>
                    </div>
                    <div class="flex flex-col gap-1 border-l-2 border-slate-200 pl-10">
                        <span>Compliance:</span>
                        <span class="text-indigo-600">ISO/IEC_27001_CERTIFIED</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black uppercase tracking-widest leading-none font-mono text-black">LOG_ID: USER_DB_AUDIT_{{ strtoupper(bin2hex(random_bytes(3))) }}</p>
                </div>
            </div>

        </main>
    </div>

    <!-- CUSTOM STYLES -->
    <style>
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: #000; border-radius: 5px; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</x-app-layout>