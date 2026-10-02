@extends('layouts.public')

@section('content')

<!-- Header Banner & Search Section -->
<section class="relative pt-32 pb-16 lg:pt-40 lg:pb-20 bg-slate-900 overflow-hidden text-white">
    <!-- Ambient Background Glows -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

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

        <!-- Category Filter Pills -->
        @if(isset($categories) && $categories->count() > 0)
            <div class="mt-8 flex items-center gap-2 overflow-x-auto no-scrollbar pb-2">
                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider flex-shrink-0 mr-1">Filter:</span>
                
                <a href="{{ route('produk.all', request()->only('q')) }}" 
                   class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all border {{ !request('kategori') ? 'bg-amber-500 text-white border-amber-500 shadow-sm' : 'bg-slate-800 text-slate-300 border-slate-700 hover:bg-slate-700 hover:text-white' }}">
                    Semua ({{ \App\Models\Product::count() }})
                </a>

                @foreach($categories as $cat)
                    <a href="{{ route('produk.all', array_merge(request()->only('q'), ['kategori' => $cat])) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all border {{ request('kategori') === $cat ? 'bg-amber-500 text-white border-amber-500 shadow-sm' : 'bg-slate-800 text-slate-300 border-slate-700 hover:bg-slate-700 hover:text-white' }}">
                        {{ $cat }}
                    </a>
                @endforeach
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
                        <div class="relative h-60 overflow-hidden bg-slate-100 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $product->gambar) }}" 
                                 alt="{{ $product->nama_produk }}" 
                                 loading="lazy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            @if($product->kategori && strtolower($product->kategori) !== 'lainnya')
                                <div class="absolute top-3.5 left-3.5">
                                    <span class="bg-white/95 backdrop-blur-sm text-slate-800 text-[11px] font-bold px-3 py-1 rounded-full shadow-sm border border-slate-100">
                                        {{ $product->kategori }}
                                    </span>
                                </div>
                            @endif
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

@endsection
