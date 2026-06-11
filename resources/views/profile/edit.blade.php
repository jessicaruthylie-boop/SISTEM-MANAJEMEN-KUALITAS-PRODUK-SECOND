<x-app-layout>
    <div class="bg-white min-h-screen text-slate-900 font-sans antialiased pb-24">
        <div class="max-w-4xl mx-auto px-6 py-12">
            <h2 class="text-3xl font-black uppercase tracking-tighter mb-10 italic">Informasi Profil Pengguna</h2>

            <!-- DATA LENGKAP USER -->
            <div class="border-2 border-black p-10 rounded-[5px] bg-white shadow-[8px_8px_0px_0px_rgba(79,70,229,0.1)] mb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Nama Lengkap</label>
                        <p class="font-black uppercase text-lg border-b border-slate-100 pb-2">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Nomor NIK</label>
                        <p class="font-black uppercase text-lg border-b border-slate-100 pb-2">{{ Auth::user()->nik }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Email Akun</label>
                        <p class="font-black text-lg border-b border-slate-100 pb-2 lowercase">{{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Nomor Telepon</label>
                        <p class="font-black text-lg border-b border-slate-100 pb-2">{{ Auth::user()->phone }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest block mb-2">Alamat Lengkap & Kode Pos</label>
                        <p class="font-black uppercase text-lg border-b border-slate-100 pb-2">{{ Auth::user()->address }} ({{ Auth::user()->post_code }})</p>
                    </div>
                </div>
            </div>

            <!-- FITUR TAMBAH / HAPUS AKUN -->
            <div class="border-2 border-black p-10 rounded-[5px] bg-slate-50">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 mb-8">Manajemen Keanggotaan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tambah Akun -->
                    <div class="p-6 border-2 border-black rounded-[5px] bg-white">
                        <h4 class="font-black uppercase text-xs mb-2">Tambah Akun Baru</h4>
                        <p class="text-[10px] text-slate-500 uppercase font-bold mb-6">Mendaftarkan akun tambahan ke dalam sistem SMK-BES.</p>
                        <a href="{{ route('register') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 text-[10px] font-black uppercase rounded-[5px] hover:bg-black transition">Mulai Sign Up</a>
                    </div>

                    <!-- Hapus Akun -->
                    <div class="p-6 border-2 border-black rounded-[5px] bg-white">
                        <h4 class="font-black uppercase text-xs mb-2 text-red-600">Hapus Akun Ini</h4>
                        <p class="text-[10px] text-slate-500 uppercase font-bold mb-6">Menghapus seluruh data permanen dari database kami.</p>
                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini? Data akan hilang selamanya.')" 
                                    class="bg-red-600 text-white px-8 py-3 text-[10px] font-black uppercase rounded-[5px] hover:bg-black transition">
                                Hapus Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>