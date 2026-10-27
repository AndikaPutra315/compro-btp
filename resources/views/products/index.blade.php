@extends('layouts.public')

@section('content')

<!-- Header Banner & Search Section -->
<section class="relative pt-32 pb-16 lg:pt-40 lg:pb-24 bg-slate-900 text-white">
    <!-- Ambient Background Glows -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span>&bull;</span>
            <span class="text-amber-400 font-medium">Katalog Semua Produk</span>
        </nav>

        <div class="max-w-3xl">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-4">
                Etalase & Suku Cadang Industri
            </h1>
            <p class="text-slate-300 text-base sm:text-lg font-light leading-relaxed mb-8">
                Cari dan temukan kebutuhan suku cadang alat berat, truk industri, AC, komponen mekanikal, dan perlengkapan operasional PT Borneo Tandayu Perkasa.
            </p>

            <!-- Search Bar Component -->
            <form action="{{ route('produk.all') }}" method="GET" class="relative max-w-2xl">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <div class="relative flex items-center">
                    <div class="absolute left-4 pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}" 
                           placeholder="Cari nama produk, sparepart, atau kata kunci..." 
                           class="w-full pl-12 pr-28 sm:pr-36 py-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-slate-400 text-sm sm:text-base focus:outline-none focus:ring-4 focus:ring-amber-500/30 focus:border-amber-400 transition-all shadow-lg">
                    <button type="submit" 
                            class="absolute right-2 sm:right-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs sm:text-sm px-4 sm:px-6 py-2.5 rounded-xl transition-all shadow-md active:scale-95 flex items-center gap-1.5">
                        <span>Cari</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Category Filter Section (AIO Dropdown + Quick Pills) -->
        @if(!empty($categories))
            <div class="mt-8 flex flex-wrap items-center gap-2.5">
                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider flex-shrink-0 mr-1 hidden sm:inline-block">Filter:</span>
                
                <!-- AIO (All-in-One) Dropdown Button & Menu -->
                <div class="relative flex-shrink-0 z-30" id="aio-category-wrapper">
                    <button type="button" 
                            id="aio-category-btn" 
                            aria-haspopup="true" 
                            aria-expanded="false" 
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all border shadow-md {{ request('kategori') ? 'bg-amber-500 text-white border-amber-400 hover:bg-amber-600' : 'bg-slate-800 text-slate-100 border-slate-700 hover:bg-slate-700 hover:border-slate-600 hover:text-white' }}">
                        <svg class="w-4 h-4 {{ request('kategori') ? 'text-white' : 'text-amber-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h11"/>
                        </svg>
                        <span>
                            @if(request('kategori'))
                                Kategori: <strong class="underline decoration-white/40">{{ request('kategori') }}</strong>
                            @else
                                Semua Kategori
                            @endif
                        </span>
                        <svg id="aio-category-chevron" class="w-3.5 h-3.5 ml-0.5 text-slate-300 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- AIO Dropdown Menu -->
                    <div id="aio-category-menu" 
                         class="hidden absolute left-0 mt-2 w-72 sm:w-80 bg-slate-900 border border-slate-700 rounded-2xl shadow-2xl p-2 z-50 backdrop-blur-xl">
                        
                        <div class="px-3 py-2 border-b border-slate-800 mb-1 flex items-center justify-between">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-amber-400">Semua Kategori</p>
                                <p class="text-[11px] text-slate-400">Pilih kategori produk</p>
                            </div>
                            <span class="text-[10px] font-medium bg-slate-800 text-slate-400 px-2 py-0.5 rounded-full">
                                {{ count($categories) }} Kategori
                            </span>
                        </div>

                        <!-- Option: Semua Produk -->
                        <a href="{{ route('produk.all', request()->only('q')) }}" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ !request('kategori') ? 'bg-amber-500 text-white font-bold shadow-sm' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 {{ !request('kategori') ? 'text-white' : 'text-amber-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                                Semua Produk
                            </span>
                            <span class="text-[11px] px-2 py-0.5 rounded-full {{ !request('kategori') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400' }}">
                                {{ \App\Models\Product::count() }}
                            </span>
                        </a>

                        <div class="my-1 border-t border-slate-800"></div>

                        <!-- List of Categories -->
                        <div class="max-h-64 overflow-y-auto space-y-0.5 pr-1">
                            @foreach($categories as $cat)
                                @php
                                    $count = $categoryCounts[$cat] ?? 0;
                                    $isActive = request('kategori') === $cat;
                                @endphp
                                <a href="{{ route('produk.all', array_merge(request()->only('q'), ['kategori' => $cat])) }}" 
                                   class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-medium transition-all {{ $isActive ? 'bg-amber-500 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                                    <span class="truncate flex items-center gap-2">
                                        @if($isActive)
                                            <svg class="w-3.5 h-3.5 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @else
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500 flex-shrink-0"></span>
                                        @endif
                                        <span class="truncate">{{ $cat }}</span>
                                    </span>
                                    <span class="text-[11px] px-2 py-0.5 rounded-full flex-shrink-0 ml-2 {{ $isActive ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400' }}">
                                        {{ $count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick Horizontal Pills -->
                <div class="flex items-center gap-2 overflow-x-auto no-scrollbar py-1 flex-1 min-w-0">
                    <a href="{{ route('produk.all', request()->only('q')) }}" 
                       class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all border {{ !request('kategori') ? 'bg-amber-500 text-white border-amber-500 shadow-sm' : 'bg-slate-800/80 text-slate-300 border-slate-700 hover:bg-slate-700 hover:text-white' }}">
                        Semua ({{ \App\Models\Product::count() }})
                    </a>

                    @foreach($categories as $cat)
                        @php
                            $count = $categoryCounts[$cat] ?? 0;
                        @endphp
                        <a href="{{ route('produk.all', array_merge(request()->only('q'), ['kategori' => $cat])) }}" 
                           class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all border {{ request('kategori') === $cat ? 'bg-amber-500 text-white border-amber-500 shadow-sm' : 'bg-slate-800/80 text-slate-300 border-slate-700 hover:bg-slate-700 hover:text-white' }}">
                            {{ $cat }} ({{ $count }})
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Product List Section -->
<section class="py-16 sm:py-20 bg-slate-50 min-h-[50vh]">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Active Filter / Results Indicator -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-slate-200">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                    @if(request('q'))
                        Hasil Pencarian untuk: <span class="text-amber-600">"{{ request('q') }}"</span>
                    @elseif(request('kategori'))
                        Kategori: <span class="text-amber-600">{{ request('kategori') }}</span>
                    @else
                        Daftar Semua Produk
                    @endif
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Menampilkan {{ $products->total() }} produk yang tersedia.
                </p>
            </div>

            @if(request('q') || request('kategori'))
                <a href="{{ route('produk.all') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-red-600 bg-white border border-slate-200 px-3.5 py-2 rounded-xl transition-colors shadow-sm self-start sm:self-auto">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    <span>Reset Filter</span>
                </a>
            @endif
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/90 group transition-all duration-300 flex flex-col h-full">
                        <!-- Product Image -->
                        @php
                            $images = $product->getImagesList();
                        @endphp
                        <div class="relative h-60 overflow-hidden bg-slate-100 flex items-center justify-center cursor-pointer group/img lightbox-trigger"
                             data-images='@json($images)'
                             data-name="{{ $product->nama_produk }}"
                             data-kategori="{{ $product->kategori ?? '' }}"
                             title="Klik untuk melihat foto lebih besar">
                            <img src="{{ asset('storage/' . $product->gambar) }}" 
                                 alt="{{ $product->nama_produk }}" 
                                 loading="lazy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            <!-- Multi-photo Badge (if > 1 photo) -->
                            @if(count($images) > 1)
                                <div class="absolute bottom-3 right-3 bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold px-2.5 py-1 rounded-full flex items-center gap-1.5 shadow-md border border-white/10 pointer-events-none">
                                    <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ count($images) }} Foto</span>
                                </div>
                            @endif

                            <!-- Hover Overlay with Zoom Icon -->
                            <div class="absolute inset-0 bg-slate-900/25 opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                <span class="bg-slate-900/85 text-white text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm flex items-center gap-1.5 shadow-lg border border-white/15 transform translate-y-2 group-hover/img:translate-y-0 transition-transform">
                                    <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                    </svg>
                                    <span>Lihat Foto</span>
                                </span>
                            </div>
                        </div>

                        <!-- Product Content -->
                        <div class="p-5 flex flex-col flex-1 justify-between">
                            <div>
                                <h3 class="text-base font-bold text-slate-900 group-hover:text-amber-600 transition-colors line-clamp-2" title="{{ $product->nama_produk }}">
                                    {{ $product->nama_produk }}
                                </h3>
                                @if($product->kategori && strtolower($product->kategori) !== 'lainnya')
                                    <span class="text-xs text-slate-400 font-medium mt-1 block">
                                        {{ $product->kategori }}
                                    </span>
                                @endif
                            </div>

                            <!-- WhatsApp Inquiry Button -->
                            <div class="mt-4 pt-4 border-t border-slate-100">
                                <a href="https://wa.me/6285238930391?text={{ urlencode('Halo Admin PT Borneo Tandayu Perkasa, saya ingin menanyakan ketersediaan produk: ' . $product->nama_produk) }}" 
                                   target="_blank" 
                                   class="w-full bg-slate-900 hover:bg-amber-500 hover:text-white text-white py-2.5 px-4 rounded-xl font-bold text-xs transition-all duration-200 flex items-center justify-center gap-2 shadow-sm">
                                    <svg class="w-4 h-4 fill-current text-emerald-400 group-hover:text-white" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                    <span>Tanya Stok & Harga</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 bg-white rounded-3xl border border-slate-200/90 shadow-sm max-w-xl mx-auto p-8">
                <div class="w-20 h-20 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-5 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Produk Tidak Ditemukan</h3>
                <p class="text-slate-500 text-sm mb-6">
                    Maaf, tidak ada produk yang sesuai dengan kriteria pencarian Anda. Silakan coba kata kunci lain atau hubungi kami langsung.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('produk.all') }}" class="w-full sm:w-auto px-6 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-colors">
                        Reset Pencarian
                    </a>
                    <a href="https://wa.me/6285238930391" target="_blank" class="w-full sm:w-auto px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-bold transition-colors flex items-center justify-center gap-1.5">
                        <span>Tanya via WhatsApp</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- Help Banner at Bottom -->
        <div class="mt-16 bg-gradient-to-r from-slate-900 to-slate-800 rounded-3xl p-8 sm:p-10 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 border border-slate-800">
            <div class="max-w-xl text-center md:text-left">
                <span class="text-amber-400 font-bold text-xs uppercase tracking-wider block mb-1">Pengadaan Khusus</span>
                <h3 class="text-2xl font-bold mb-2">Tidak Menemukan Suku Cadang yang Dicari?</h3>
                <p class="text-slate-300 text-sm">
                    Kami melayani pengadaan suku cadang khusus dan custom untuk berbagai merek alat berat & mesin industri Anda.
                </p>
            </div>
            <a href="https://wa.me/6285238930391" target="_blank" class="bg-amber-500 hover:bg-amber-600 text-white px-8 py-3.5 rounded-full font-bold text-sm transition-all shadow-lg hover:shadow-amber-500/30 flex items-center gap-2 whitespace-nowrap active:scale-95">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                <span>Konsultasi Pengadaan</span>
            </a>
        </div>
    </div>
</section>

<!-- Lightbox Modal Popup (Multi-Foto) -->
<div id="product-lightbox-modal" 
     class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-6 bg-slate-950/85 backdrop-blur-md transition-opacity duration-300" 
     role="dialog" 
     aria-modal="true"
     aria-labelledby="lb-product-name">

    <!-- Modal Content Box -->
    <div id="lb-content-box" 
         class="relative w-full max-w-4xl bg-slate-900 border border-slate-700/90 rounded-3xl shadow-2xl overflow-hidden flex flex-col transform transition-all duration-300 scale-95 opacity-0">

        <!-- Top Header -->
        <div class="p-4 sm:p-5 border-b border-slate-800 flex items-center justify-between gap-4 bg-slate-900/90 backdrop-blur-sm">
            <div class="min-w-0">
                <span id="lb-product-kategori" class="text-xs font-bold text-amber-400 uppercase tracking-wider block mb-0.5 truncate"></span>
                <h3 id="lb-product-name" class="text-base sm:text-xl font-extrabold text-white truncate"></h3>
            </div>
            
            <div class="flex items-center gap-3 flex-shrink-0">
                <!-- Counter Badge -->
                <span id="lb-counter" class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-800 text-slate-300 border border-slate-700">
                    <span id="lb-curr-idx">1</span> / <span id="lb-total-idx">1</span>
                </span>
                
                <!-- Close Button (X) -->
                <button type="button" 
                        id="lb-close-btn" 
                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-800 hover:bg-red-500/20 text-slate-400 hover:text-red-400 border border-slate-700 hover:border-red-500/30 flex items-center justify-center transition-all duration-200 active:scale-95 cursor-pointer" 
                        aria-label="Tutup">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Main Image Area with Navigation Arrows -->
        <div class="relative bg-slate-950 flex items-center justify-center select-none overflow-hidden" style="min-height: 280px; max-height: 65vh; height: 500px;">
            <!-- Main Photo -->
            <img id="lb-main-img" 
                 src="" 
                 alt="Foto Produk" 
                 class="max-w-full max-h-full object-contain transition-opacity duration-200 opacity-100">

            <!-- Prev Arrow Button (<) -->
            <button type="button" 
                    id="lb-prev-btn" 
                    class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-slate-900/80 hover:bg-amber-500 text-white border border-white/15 hover:border-amber-400 flex items-center justify-center shadow-xl backdrop-blur-sm transition-all hover:scale-110 active:scale-95 z-10 cursor-pointer" 
                    aria-label="Foto Sebelumnya">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>

            <!-- Next Arrow Button (>) -->
            <button type="button" 
                    id="lb-next-btn" 
                    class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-slate-900/80 hover:bg-amber-500 text-white border border-white/15 hover:border-amber-400 flex items-center justify-center shadow-xl backdrop-blur-sm transition-all hover:scale-110 active:scale-95 z-10 cursor-pointer" 
                    aria-label="Foto Berikutnya">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

        <!-- Footer / Action bar -->
        <div class="p-4 sm:p-5 border-t border-slate-800 bg-slate-900 flex flex-col sm:flex-row items-center justify-between gap-3">
            <!-- Dots Selector -->
            <div id="lb-dots" class="flex items-center gap-2"></div>

            <!-- WhatsApp Order CTA -->
            <a id="lb-wa-btn" 
               href="#" 
               target="_blank" 
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs sm:text-sm px-6 py-2.5 rounded-xl transition-all shadow-md active:scale-95">
                <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                <span>Tanya Stok Produk Ini</span>
            </a>
        </div>
    </div>
</div>

<script>
(function() {
    // AIO Category Dropdown
    const catBtn = document.getElementById('aio-category-btn');
    const catMenu = document.getElementById('aio-category-menu');
    const catChevron = document.getElementById('aio-category-chevron');
    const catWrapper = document.getElementById('aio-category-wrapper');

    if (catBtn && catMenu) {
        function openCatMenu() {
            catMenu.classList.remove('hidden');
            if (catChevron) catChevron.classList.add('rotate-180');
            catBtn.setAttribute('aria-expanded', 'true');
        }

        function closeCatMenu() {
            catMenu.classList.add('hidden');
            if (catChevron) catChevron.classList.remove('rotate-180');
            catBtn.setAttribute('aria-expanded', 'false');
        }

        catBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (catMenu.classList.contains('hidden')) {
                openCatMenu();
            } else {
                closeCatMenu();
            }
        });

        document.addEventListener('click', function(e) {
            if (catWrapper && !catWrapper.contains(e.target)) {
                closeCatMenu();
            }
        });
    }

    // Lightbox Modal Logic
    const modal       = document.getElementById('product-lightbox-modal');
    const contentBox  = document.getElementById('lb-content-box');
    const mainImg     = document.getElementById('lb-main-img');
    const titleEl     = document.getElementById('lb-product-name');
    const kategoriEl  = document.getElementById('lb-product-kategori');
    const counterEl   = document.getElementById('lb-counter');
    const currIdxEl   = document.getElementById('lb-curr-idx');
    const totalIdxEl  = document.getElementById('lb-total-idx');
    const prevBtn     = document.getElementById('lb-prev-btn');
    const nextBtn     = document.getElementById('lb-next-btn');
    const closeBtn    = document.getElementById('lb-close-btn');
    const dotsEl      = document.getElementById('lb-dots');
    const waBtn       = document.getElementById('lb-wa-btn');

    let currentImages = [];
    let currentIndex = 0;

    function renderImage(idx) {
        if (!currentImages.length) return;
        currentIndex = (idx + currentImages.length) % currentImages.length;
        
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = currentImages[currentIndex];
            mainImg.style.opacity = '1';
        }, 120);

        if (currIdxEl) currIdxEl.textContent = currentIndex + 1;
        
        // Update dots
        if (dotsEl) {
            Array.from(dotsEl.children).forEach((dot, i) => {
                if (i === currentIndex) {
                    dot.className = 'w-6 h-2 rounded-full bg-amber-500 transition-all duration-300';
                } else {
                    dot.className = 'w-2 h-2 rounded-full bg-slate-700 hover:bg-slate-500 transition-all duration-300 cursor-pointer';
                }
            });
        }
    }

    function openLightbox(images, name, kategori) {
        if (!images || !images.length) return;
        currentImages = images;
        currentIndex = 0;

        if (titleEl) titleEl.textContent = name || '';
        if (kategoriEl) kategoriEl.textContent = kategori || '';
        if (totalIdxEl) totalIdxEl.textContent = currentImages.length;

        // WhatsApp link update
        if (waBtn) {
            waBtn.href = 'https://wa.me/6285238930391?text=' + encodeURIComponent('Halo Admin PT Borneo Tandayu Perkasa, saya ingin menanyakan ketersediaan produk: ' + name);
        }

        // Single photo vs multi photo
        if (currentImages.length > 1) {
            prevBtn.classList.remove('hidden');
            nextBtn.classList.remove('hidden');
            counterEl.classList.remove('hidden');
            
            // Build dots
            dotsEl.innerHTML = '';
            currentImages.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.setAttribute('aria-label', 'Lihat foto ' + (i + 1));
                dot.addEventListener('click', (e) => {
                    e.stopPropagation();
                    renderImage(i);
                });
                dotsEl.appendChild(dot);
            });
            dotsEl.classList.remove('hidden');
        } else {
            prevBtn.classList.add('hidden');
            nextBtn.classList.add('hidden');
            counterEl.classList.add('hidden');
            dotsEl.innerHTML = '';
            dotsEl.classList.add('hidden');
        }

        renderImage(0);

        // Show modal with animation
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            contentBox.classList.remove('scale-95', 'opacity-0');
            contentBox.classList.add('scale-100', 'opacity-100');
        }, 20);
    }

    function closeLightbox() {
        contentBox.classList.remove('scale-100', 'opacity-100');
        contentBox.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
            mainImg.src = '';
        }, 200);
    }

    // Attach trigger to all product image cards
    document.querySelectorAll('.lightbox-trigger').forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            try {
                const images = JSON.parse(this.dataset.images || '[]');
                const name = this.dataset.name || '';
                const kategori = this.dataset.kategori || '';
                openLightbox(images, name, kategori);
            } catch (err) {
                console.error('Failed to parse lightbox images', err);
            }
        });
    });

    if (prevBtn) prevBtn.addEventListener('click', (e) => { e.stopPropagation(); renderImage(currentIndex - 1); });
    if (nextBtn) nextBtn.addEventListener('click', (e) => { e.stopPropagation(); renderImage(currentIndex + 1); });
    if (closeBtn) closeBtn.addEventListener('click', (e) => { e.stopPropagation(); closeLightbox(); });

    modal.addEventListener('click', function(e) {
        if (!contentBox.contains(e.target)) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!modal.classList.contains('hidden')) {
                closeLightbox();
            }
            if (catMenu && !catMenu.classList.contains('hidden')) {
                catMenu.classList.add('hidden');
                if (catChevron) catChevron.classList.remove('rotate-180');
            }
        }
        if (!modal.classList.contains('hidden')) {
            if (e.key === 'ArrowLeft') renderImage(currentIndex - 1);
            if (e.key === 'ArrowRight') renderImage(currentIndex + 1);
        }
    });

    // Mobile Swipe Support
    let touchStartX = 0;
    modal.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    modal.addEventListener('touchend', (e) => {
        const touchEndX = e.changedTouches[0].screenX;
        if (touchStartX - touchEndX > 50) {
            renderImage(currentIndex + 1); // swipe left -> next
        } else if (touchEndX - touchStartX > 50) {
            renderImage(currentIndex - 1); // swipe right -> prev
        }
    }, { passive: true });
})();
</script>

@endsection
