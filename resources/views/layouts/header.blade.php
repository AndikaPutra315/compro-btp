<!-- Header / Navbar -->
<header class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Desktop & Tablet Navbar (Symmetrical & Balanced) -->
        <div class="hidden md:flex items-center justify-between h-20">
            <!-- Brand Logo (Left) -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                <img src="{{ asset('images/logo-btp.webp') }}" alt="Logo PT Borneo Tandayu Perkasa" class="h-10 w-auto object-contain transition-transform duration-200 group-hover:scale-105">
                <div class="flex flex-col">
                    <span class="text-[15px] font-bold tracking-tight text-slate-800 leading-tight group-hover:text-amber-600 transition-colors">
                        PT BORNEO TANDAYU PERKASA
                    </span>
                    <span class="text-[10px] font-semibold tracking-wider text-slate-400 uppercase leading-none mt-1">
                        General Supplier & Maintenance
                    </span>
                </div>
            </a>

            <!-- Navigation Menu (Center) -->
            <nav class="flex items-center justify-center gap-1.5 lg:gap-2">
                <a href="{{ route('home') }}#tentang" class="px-3.5 py-2 text-[14px] font-medium text-slate-600 hover:text-amber-600 hover:bg-amber-50/70 rounded-lg transition-all duration-150">
                    Tentang Kami
                </a>
                <a href="{{ route('home') }}#layanan" class="px-3.5 py-2 text-[14px] font-medium text-slate-600 hover:text-amber-600 hover:bg-amber-50/70 rounded-lg transition-all duration-150">
                    Layanan
                </a>
                <a href="{{ route('home') }}#dokumentasi" class="px-3.5 py-2 text-[14px] font-medium text-slate-600 hover:text-amber-600 hover:bg-amber-50/70 rounded-lg transition-all duration-150">
                    Dokumentasi
                </a>
                <a href="{{ route('produk.all') }}" class="px-3.5 py-2 text-[14px] font-medium text-slate-600 hover:text-amber-600 hover:bg-amber-50/70 rounded-lg transition-all duration-150">
                    Produk
                </a>
                <a href="{{ route('home') }}#klien" class="px-3.5 py-2 text-[14px] font-medium text-slate-600 hover:text-amber-600 hover:bg-amber-50/70 rounded-lg transition-all duration-150">
                    Klien
                </a>
                <a href="{{ route('home') }}#kontak" class="px-3.5 py-2 text-[14px] font-medium text-slate-600 hover:text-amber-600 hover:bg-amber-50/70 rounded-lg transition-all duration-150">
                    Kontak
                </a>
            </nav>

            <!-- Call-to-Action (Right) -->
            <div class="flex items-center justify-end gap-2.5 flex-shrink-0">
                @auth
                    <!-- Tombol Khusus Admin yang sedang Login -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-amber-400 hover:text-amber-300 px-4 py-2.5 rounded-full text-[13px] font-bold border border-amber-500/40 shadow-sm transition-all duration-150 group">
                        <svg class="w-4 h-4 text-amber-400 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Kembali ke Halaman Admin</span>
                    </a>
                @endauth

                <a href="https://wa.me/6285238930391" target="_blank" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-full text-[13px] font-semibold shadow-sm shadow-amber-500/20 hover:shadow-md hover:shadow-amber-500/30 transition-all duration-150">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>

        <!-- Mobile Navbar (< 768px) -->
        <div class="md:hidden">
            <!-- Mobile Brand & Button Row -->
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo-btp.webp') }}" alt="Logo PT Borneo Tandayu Perkasa" class="h-8 w-auto object-contain">
                    <div class="flex flex-col">
                        <span class="text-xs font-bold tracking-tight text-slate-800 leading-tight">
                            BORNEO TANDAYU
                        </span>
                        <span class="text-[9px] font-medium tracking-wider text-slate-400 uppercase leading-none mt-0.5">
                            General Supplier
                        </span>
                    </div>
                </a>

                <div class="flex items-center gap-2">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 bg-slate-900 text-amber-400 px-2.5 py-1.5 rounded-full text-[11px] font-bold border border-amber-500/40">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Admin</span>
                        </a>
                    @endauth

                    <a href="https://wa.me/6285238930391" target="_blank" class="inline-flex items-center gap-1.5 bg-amber-500 hover:bg-amber-600 text-white px-3.5 py-1.5 rounded-full text-xs font-semibold shadow-sm transition-colors">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        <span>Hubungi</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Navigation Links Row (Direct & Clean) -->
            <nav class="flex items-center justify-center overflow-x-auto no-scrollbar py-2 border-t border-slate-100 gap-1">
                <a href="{{ route('home') }}#tentang" class="px-2.5 py-1 text-xs font-medium text-slate-600 hover:text-amber-600 hover:bg-slate-50 rounded-md transition-colors whitespace-nowrap">
                    Tentang Kami
                </a>
                <a href="{{ route('home') }}#layanan" class="px-2.5 py-1 text-xs font-medium text-slate-600 hover:text-amber-600 hover:bg-slate-50 rounded-md transition-colors whitespace-nowrap">
                    Layanan
                </a>
                <a href="{{ route('home') }}#dokumentasi" class="px-2.5 py-1 text-xs font-medium text-slate-600 hover:text-amber-600 hover:bg-slate-50 rounded-md transition-colors whitespace-nowrap">
                    Dokumentasi
                </a>
                <a href="{{ route('produk.all') }}" class="px-2.5 py-1 text-xs font-medium text-slate-600 hover:text-amber-600 hover:bg-slate-100 rounded-md transition-colors whitespace-nowrap">
                    Produk
                </a>
                <a href="{{ route('home') }}#klien" class="px-2.5 py-1 text-xs font-medium text-slate-600 hover:text-amber-600 hover:bg-slate-100 rounded-md transition-colors whitespace-nowrap">
                    Klien
                </a>
                <a href="{{ route('home') }}#kontak" class="px-2.5 py-1 text-xs font-medium text-slate-600 hover:text-amber-600 hover:bg-slate-100 rounded-md transition-colors whitespace-nowrap">
                    Kontak
                </a>
            </nav>
        </div>
    </div>
</header>
