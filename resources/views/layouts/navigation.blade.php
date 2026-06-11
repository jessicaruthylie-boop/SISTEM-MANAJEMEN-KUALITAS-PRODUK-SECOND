<nav x-data="{ open: false }" class="bg-white border-b-2 border-black sticky top-0 z-[9999] shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Branding / Logo -->
                <div class="shrink-0 flex items-center mr-8">
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                       class="border-2 border-black px-3 py-1 rounded-[5px] hover:bg-slate-900 group transition-all">
                        <span class="text-indigo-600 font-black italic tracking-tighter text-xl group-hover:text-white uppercase">SMK-BES</span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-6 sm:flex h-full">
                    @if(Auth::user()->role === 'admin')
                        <!-- MENU KHUSUS ADMINISTRATOR UTAMA -->
                        <a href="{{ route('admin.dashboard') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-[10px] font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('admin.dashboard') ? 'border-indigo-600 text-black' : 'border-transparent text-slate-400 hover:text-slate-700' }}">
                            Dashboard_Panel
                        </a>

                        <a href="{{ route('admin.inventory.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-[10px] font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('admin.inventory.*') ? 'border-indigo-600 text-black' : 'border-transparent text-slate-400 hover:text-slate-700' }}">
                            Inventory_Master
                        </a>

                        <a href="{{ route('admin.transactions.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-[10px] font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('admin.transactions.*') ? 'border-indigo-600 text-black' : 'border-transparent text-slate-400 hover:text-slate-700' }}">
                            Financial_Vault
                        </a>

                        <a href="{{ route('admin.users.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-[10px] font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('admin.users.*') ? 'border-indigo-600 text-black' : 'border-transparent text-slate-400 hover:text-slate-700' }}">
                            User_Surveillance
                        </a>
                    @else
                        <!-- MENU KHUSUS CUSTOMER (USER) -->
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-[10px] font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('dashboard') ? 'border-indigo-600 text-black' : 'border-transparent text-slate-400 hover:text-slate-700' }}">
                            Dashboard
                        </a>

                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-[10px] font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('products.*') ? 'border-indigo-600 text-black' : 'border-transparent text-slate-400 hover:text-slate-700' }}">
                            Produk
                        </a>

                        <a href="{{ route('orders.cart') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-[10px] font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('orders.cart') ? 'border-indigo-600 text-black' : 'border-transparent text-slate-400 hover:text-slate-700' }}">
                            Keranjang
                            @php $cartCount = \App\Models\Order::where('user_id', Auth::id())->where('status', 'Keranjang')->count(); @endphp
                            @if($cartCount > 0)
                                <span class="ml-2 bg-indigo-600 text-white text-[8px] px-1.5 py-0.5 rounded-full shadow-lg">{{ $cartCount }}</span>
                            @endif
                        </a>

                        <a href="{{ route('orders.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-[10px] font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('orders.index') ? 'border-indigo-600 text-black' : 'border-transparent text-slate-400 hover:text-slate-700' }}">
                            Pesanan
                        </a>

                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-[10px] font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('profile.*') ? 'border-indigo-600 text-black' : 'border-transparent text-slate-400 hover:text-slate-700' }}">
                            Profil
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Side Settings -->
            <div class="flex items-center gap-6">
                <!-- Role Indicator Badge -->
                <div class="hidden sm:flex flex-col items-end border-r border-slate-200 pr-6">
                    <span class="text-[8px] font-black uppercase text-slate-400 tracking-widest leading-none mb-1">Operator_Ident</span>
                    <span class="text-[10px] font-black uppercase {{ Auth::user()->role === 'admin' ? 'text-indigo-600' : 'text-emerald-600' }}">
                        {{ Auth::user()->name }} [{{ Auth::user()->role }}]
                    </span>
                </div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[10px] font-black uppercase text-red-600 border-2 border-red-600 px-4 py-1.5 rounded-[5px] hover:bg-red-600 hover:text-white transition-all italic">
                        Terminate_Session
                    </button>
                </form>

                <!-- Hamburger (Mobile) -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-[5px] text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out border border-slate-200">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-slate-200">
        <div class="pt-2 pb-3 space-y-1 bg-slate-50">
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard_Panel</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.inventory.index')" :active="request()->routeIs('admin.inventory.*')">Inventory_Master</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.transactions.index')" :active="request()->routeIs('admin.transactions.*')">Financial_Vault</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">User_Surveillance</x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">Produk</x-nav-link>
                <x-responsive-nav-link :href="route('orders.cart')" :active="request()->routeIs('orders.cart')">Keranjang</x-nav-link>
                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">Pesanan</x-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">Profil</x-nav-link>
            @endif
        </div>
    </div>
</nav>