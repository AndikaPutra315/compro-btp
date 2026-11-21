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
                {{-- Dropdown: Tentang Kami --}}
                <div class="relative" id="dd-tentang">
                    <button type="button"
                            onclick="toggleNavDropdown('dd-tentang')"
                            class="inline-flex items-center gap-1 px-3.5 py-2 text-[14px] font-medium text-slate-600 hover:text-amber-600 hover:bg-amber-50/70 rounded-lg transition-all duration-150 cursor-pointer select-none">
                        Tentang Kami
                        <svg id="dd-tentang-chevron" class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="dd-tentang-menu"
                         class="hidden absolute left-0 top-full mt-1.5 w-52 bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50 origin-top-left">
                        <a href="{{ route('home') }}#tentang"
                           class="flex items-center gap-2.5 px-4 py-2.5 text-[13px] font-medium text-slate-700 hover:text-amber-600 hover:bg-amber-50/60 transition-colors">
                            <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Profil Perusahaan
                        </a>
                        <a href="{{ route('home') }}#struktur-organisasi"
                           class="flex items-center gap-2.5 px-4 py-2.5 text-[13px] font-medium text-slate-700 hover:text-amber-600 hover:bg-amber-50/60 transition-colors">
                            <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Struktur Organisasi
                        </a>
                    </div>
                </div>
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
                {{-- Mobile: Tentang dropdown toggler --}}
                <div class="relative flex-shrink-0" id="mob-dd-tentang">
                    <button type="button"
                            onclick="toggleNavDropdown('mob-dd-tentang')"
                            class="inline-flex items-center gap-0.5 px-2.5 py-1 text-xs font-medium text-slate-600 hover:text-amber-600 hover:bg-slate-50 rounded-md transition-colors whitespace-nowrap">
                        Tentang Kami
                        <svg id="mob-dd-tentang-chevron" class="w-3 h-3 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="mob-dd-tentang-menu"
                         class="hidden absolute left-0 top-full mt-1 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50">
                        <a href="{{ route('home') }}#tentang"
                           class="flex items-center gap-2 px-3.5 py-2 text-xs font-medium text-slate-700 hover:text-amber-600 hover:bg-amber-50/60 transition-colors">
                            Profil Perusahaan
                        </a>
                        <a href="{{ route('home') }}#struktur-organisasi"
                           class="flex items-center gap-2 px-3.5 py-2 text-xs font-medium text-slate-700 hover:text-amber-600 hover:bg-amber-50/60 transition-colors">
                            Struktur Organisasi
                        </a>
                    </div>
                </div>
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

<script>
function toggleNavDropdown(id) {
    var menu    = document.getElementById(id + '-menu');
    var chevron = document.getElementById(id + '-chevron');
    if (!menu) return;
    var isHidden = menu.classList.contains('hidden');
    // Close all open nav dropdowns first
    document.querySelectorAll('[id$="-menu"]').forEach(function(m) {
        if (m.id.startsWith('dd-') || m.id.startsWith('mob-dd-')) {
            m.classList.add('hidden');
        }
    });
    document.querySelectorAll('[id$="-chevron"]').forEach(function(c) {
        if (c.id.startsWith('dd-') || c.id.startsWith('mob-dd-')) {
            c.style.transform = '';
        }
    });
    if (isHidden) {
        menu.classList.remove('hidden');
        if (chevron) chevron.style.transform = 'rotate(180deg)';
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    var dropdowns = ['dd-tentang', 'mob-dd-tentang'];
    dropdowns.forEach(function(id) {
        var container = document.getElementById(id);
        var menu      = document.getElementById(id + '-menu');
        var chevron   = document.getElementById(id + '-chevron');
        if (container && menu && !container.contains(e.target)) {
            menu.classList.add('hidden');
            if (chevron) chevron.style.transform = '';
        }
    });
});
</script>
