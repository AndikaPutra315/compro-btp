@extends('layouts.public')

@section('content')

<!-- Hero Section -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-slate-900/90 mix-blend-multiply z-10"></div>
            <img src="{{ asset('images/bg.webp') }}" alt="Background BTP" class="w-full h-full object-cover">
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white leading-tight mb-8">
                PT BORNEO <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600 drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">TANDAYU</span> PERKASA
            </h1>
            <p class="text-xl md:text-2xl text-slate-200 font-light mb-10 max-w-2xl mx-auto">
                FIRST SOLUTION STARTS FROM HERE
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="https://wa.me/6285238930391" target="_blank" class="bg-amber-500 hover:bg-amber-600 text-white px-8 py-4 rounded-full font-bold text-lg transition-all shadow-lg hover:shadow-amber-500/30 transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Hubungi Kami via WhatsApp
                </a>
                <a href="#layanan" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white px-8 py-4 rounded-full font-bold text-lg transition-all hover:shadow-lg transform hover:-translate-y-1 text-center">
                    Lihat Layanan
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Kami -->
<style>
/* ── Slide-to-top-left Carousel ── */
#btp-book-wrap { position: relative; }
#btp-book {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
    border-radius: 1rem;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

.btp-page {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    border-radius: 1rem;
    overflow: hidden;
    will-change: transform, opacity;
    /* Default: hidden at bottom-right, waiting */
    transform: translate(55%, 45%) scale(0.82);
    opacity: 0;
    z-index: 5;
}

/* Active slide — sits at origin, fully visible */
.btp-page.is-active {
    transform: translate(0, 0) scale(1);
    opacity: 1;
    z-index: 10;
    transition:
        transform 0.65s cubic-bezier(0.4, 0, 0.2, 1),
        opacity   0.55s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Slide exits to TOP-LEFT */
.btp-page.slide-out-tl {
    transform: translate(-55%, -45%) scale(0.82);
    opacity: 0;
    z-index: 10;
    transition:
        transform 0.65s cubic-bezier(0.4, 0, 0.2, 1),
        opacity   0.55s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Next slide waits at BOTTOM-RIGHT, invisible */
.btp-page.slide-in-wait {
    transform: translate(55%, 45%) scale(0.82);
    opacity: 0;
    z-index: 5;
    transition: none;
}

/* Slide exits to BOTTOM-RIGHT (for backward nav) */
.btp-page.slide-out-br {
    transform: translate(55%, 45%) scale(0.82);
    opacity: 0;
    z-index: 10;
    transition:
        transform 0.65s cubic-bezier(0.4, 0, 0.2, 1),
        opacity   0.55s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Prev slide waits at TOP-LEFT, invisible */
.btp-page.slide-in-wait-rev {
    transform: translate(-55%, -45%) scale(0.82);
    opacity: 0;
    z-index: 5;
    transition: none;
}

/* Subtle shimmer overlay while transitioning */
.btp-page::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg,
        rgba(255,255,255,0.12) 0%,
        rgba(255,255,255,0)    60%);
    pointer-events: none;
    border-radius: inherit;
    z-index: 2;
}
</style>

<section id="tentang" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">

            <!-- Book Carousel Column -->
            <div class="lg:w-1/2 w-full">
                <div class="relative">
                    <!-- Amber decorative card behind -->
                    <div class="absolute -inset-4 bg-amber-100 rounded-3xl transform rotate-3 z-0"></div>

                    @php
                        $slides = $companyPhotos->isNotEmpty()
                            ? $companyPhotos->map(fn($p) => [
                                'src' => asset('storage/' . $p->gambar),
                                'alt' => $p->judul ?? 'PT Borneo Tandayu Perkasa',
                              ])->values()->all()
                            : [[
                                'src' => 'https://images.unsplash.com/photo-1504307651254-35680f356f12?q=80&w=2070&auto=format&fit=crop',
                                'alt' => 'PT Borneo Tandayu Perkasa',
                              ]];
                        $total = count($slides);
                    @endphp

                    <!-- Book wrapper (3-D perspective) -->
                    <div id="btp-book-wrap" class="relative z-10 rounded-2xl">
                        <div id="btp-book">
                            @foreach($slides as $i => $slide)
                            <div class="btp-page"
                                 data-index="{{ $i }}"
                                 style="z-index: {{ $i === 0 ? 20 : (10 - $i) }};">
                                <img src="{{ $slide['src'] }}"
                                     alt="{{ $slide['alt'] }}"
                                     class="w-full h-full object-cover">
                                @if($companyPhotos->isNotEmpty())
                                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-slate-900/65 to-transparent px-5 py-4">
                                    <p class="text-white text-sm font-semibold truncate">{{ $slide['alt'] }}</p>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div><!-- /#btp-book -->

                        @if($total > 1)
                        <!-- Prev button -->
                        <button id="btp-prev"
                                class="absolute left-3 top-1/2 -translate-y-1/2 z-30 w-10 h-10 bg-white/90 hover:bg-white rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-xl"
                                aria-label="Sebelumnya">
                            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <!-- Next button -->
                        <button id="btp-next"
                                class="absolute right-3 top-1/2 -translate-y-1/2 z-30 w-10 h-10 bg-white/90 hover:bg-white rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-xl"
                                aria-label="Berikutnya">
                            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        <!-- Dot indicators -->
                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-30 flex gap-2">
                            @foreach($slides as $i => $slide)
                            <button class="btp-dot rounded-full transition-all duration-300 {{ $i === 0 ? 'w-5 h-2 bg-white' : 'w-2 h-2 bg-white/50 hover:bg-white/80' }}"
                                    data-index="{{ $i }}" aria-label="Slide {{ $i + 1 }}"></button>
                            @endforeach
                        </div>

                        @endif
                    </div>
                </div>
            </div>

            <!-- Text Column -->
            <div class="lg:w-1/2 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-600 font-semibold text-sm">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span> Tentang Kami
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 leading-tight">
                    Mitra Terpercaya untuk Sektor <span class="text-amber-500">Industri &amp; Pertambangan</span>
                </h2>
                <p class="text-lg text-slate-600 leading-relaxed">
                    <strong>PT. Borneo Tandayu Perkasa</strong> adalah perusahaan yang bergerak di bidang General Supplier, dengan fokus utama dalam menyediakan kebutuhan suku cadang dan jasa perbaikan untuk sektor industri dan pertambangan.
                </p>
                <p class="text-lg text-slate-600 leading-relaxed">
                    Kami berkomitmen untuk memberikan solusi terbaik dan tepat guna bagi setiap klien, didukung oleh tim profesional yang berpengalaman di bidangnya.
                </p>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    const pages   = Array.from(document.querySelectorAll('.btp-page'));
    const dots    = Array.from(document.querySelectorAll('.btp-dot'));
    const counter = document.getElementById('btp-counter');
    const prevBtn = document.getElementById('btp-prev');
    const nextBtn = document.getElementById('btp-next');

    if (!pages.length || pages.length < 2) return;

    const total  = pages.length;
    let current  = 0;
    let busy     = false;
    let timer    = null;
    const DELAY  = 3000;
    const DUR    = 650; /* animation duration ms */

    /* ── dot styling ── */
    function syncDots(idx) {
        dots.forEach((d, i) => {
            if (i === idx) {
                d.classList.add('w-5', 'h-2', 'bg-white');
                d.classList.remove('w-2', 'bg-white/50');
            } else {
                d.classList.remove('w-5', 'bg-white');
                d.classList.add('w-2', 'bg-white/50');
            }
        });
        if (counter) counter.textContent = idx + 1;
    }

    /* Reset outgoing page: strip animation classes & inline styles so CSS default hides it */
    function resetPage(p) {
        p.classList.remove('is-active', 'slide-out-tl', 'slide-out-br', 'slide-in-wait', 'slide-in-wait-rev');
        p.style.removeProperty('z-index');
        p.style.removeProperty('transform');
        p.style.removeProperty('opacity');
        p.style.removeProperty('transition');
    }

    /* ── FORWARD: current slides out to top-left, next comes from bottom-right ── */
    function slideForward(toIdx) {
        if (busy) return;
        busy = true;

        const outPage = pages[current];
        const inPage  = pages[toIdx];

        /* 1. Position incoming slide at bottom-right (invisible, no transition) */
        inPage.classList.add('slide-in-wait');
        inPage.style.zIndex = 8;
        void inPage.offsetWidth; /* force reflow */

        /* 2. Trigger both transitions on next frame */
        requestAnimationFrame(() => {
            /* Out: active slide flies to top-left */
            outPage.classList.remove('is-active');
            outPage.classList.add('slide-out-tl');
            outPage.style.zIndex = 10;

            /* In: incoming slide animates to centre */
            inPage.classList.remove('slide-in-wait');
            inPage.classList.add('is-active');
            inPage.style.zIndex = 12;

            setTimeout(() => {
                resetPage(outPage);
                current = toIdx;
                syncDots(current);
                busy = false;
            }, DUR + 50);
        });
    }

    /* ── BACKWARD: current slides out to bottom-right, prev comes from top-left ── */
    function slideBackward(toIdx) {
        if (busy) return;
        busy = true;

        const outPage = pages[current];
        const inPage  = pages[toIdx];

        /* 1. Position incoming slide at top-left (invisible, no transition) */
        inPage.classList.add('slide-in-wait-rev');
        inPage.style.zIndex = 8;
        void inPage.offsetWidth;

        requestAnimationFrame(() => {
            /* Out: current slides to bottom-right */
            outPage.classList.remove('is-active');
            outPage.classList.add('slide-out-br');
            outPage.style.zIndex = 10;

            /* In: prev slide animates to centre */
            inPage.classList.remove('slide-in-wait-rev');
            inPage.classList.add('is-active');
            inPage.style.zIndex = 12;

            setTimeout(() => {
                resetPage(outPage);
                current = toIdx;
                syncDots(current);
                busy = false;
            }, DUR + 50);
        });
    }

    function next() { slideForward((current + 1) % total); }
    function prev() { slideBackward((current - 1 + total) % total); }

    function startTimer() {
        clearInterval(timer);
        timer = setInterval(next, DELAY);
    }

    if (nextBtn) nextBtn.addEventListener('click', () => { next(); startTimer(); });
    if (prevBtn) prevBtn.addEventListener('click', () => { prev(); startTimer(); });

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            if (i === current || busy) return;
            i > current ? slideForward(i) : slideBackward(i);
            startTimer();
        });
    });

    /* Pause on hover */
    const wrap = document.getElementById('btp-book-wrap');
    if (wrap) {
        wrap.addEventListener('mouseenter', () => clearInterval(timer));
        wrap.addEventListener('mouseleave', startTimer);
    }

    /* Init — CSS hides all by default, just activate the first */
    pages[0].classList.add('is-active');
    syncDots(0);
    startTimer();
})();
</script>




<!-- Visi & Misi -->
<section class="py-20 bg-slate-50 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 rounded-full bg-blue-500/10 blur-3xl"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Visi & Misi</h2>
            <div class="w-20 h-1.5 bg-amber-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Visi Card -->
            <div class="bg-white rounded-2xl p-10 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_50px_-20px_rgba(245,158,11,0.3)] relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-full -mr-16 -mt-16 transition-all group-hover:scale-150 group-hover:bg-amber-100/50"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-amber-100 text-amber-500 rounded-xl flex items-center justify-center mb-8 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Visi Kami</h3>
                    <p class="text-slate-600 text-lg leading-relaxed">
                        "Menjadi perusahaan General Supplier terpercaya dan terdepan dalam memberikan solusi pengadaan suku cadang serta jasa perbaikan yang inovatif dan berkualitas tinggi untuk industri dan pertambangan di Indonesia."
                    </p>
                </div>
            </div>

            <!-- Misi Card -->
            <div class="bg-white rounded-2xl p-10 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_50px_-20px_rgba(245,158,11,0.3)] relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-full -mr-16 -mt-16 transition-all group-hover:scale-150 group-hover:bg-amber-100/50"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-amber-100 text-amber-500 rounded-xl flex items-center justify-center mb-8 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 8h8"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Misi Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-amber-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-slate-600 text-lg">Menyediakan produk dan jasa dengan standar kualitas terbaik.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-amber-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-slate-600 text-lg">Membangun kemitraan jangka panjang yang saling menguntungkan dengan klien.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-amber-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-slate-600 text-lg">Memberikan pelayanan yang responsif, profesional, dan tepat waktu.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Kami -->
<section id="layanan" class="py-20 bg-slate-900 text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Layanan Kami</h2>
            <div class="w-20 h-1.5 bg-amber-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Layanan 1 -->
            <div class="bg-slate-800 rounded-xl p-8 hover:bg-slate-700 transition-colors border border-slate-700 group">
                <div class="w-14 h-14 bg-slate-700 group-hover:bg-amber-500 rounded-lg flex items-center justify-center mb-6 transition-colors">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Spare Part Alat Berat</h3>
                <p class="text-slate-400 text-sm">Menyediakan berbagai macam suku cadang alat berat berkualitas untuk operasional yang tanpa hambatan.</p>
            </div>

            <!-- Layanan 2 -->
            <div class="bg-slate-800 rounded-xl p-8 hover:bg-slate-700 transition-colors border border-slate-700 group">
                <div class="w-14 h-14 bg-slate-700 group-hover:bg-amber-500 rounded-lg flex items-center justify-center mb-6 transition-colors">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Consumable Goods</h3>
                <p class="text-slate-400 text-sm">Kebutuhan bahan habis pakai untuk industri dan pertambangan yang selalu siap sedia kapanpun Anda butuhkan.</p>
            </div>

            <!-- Layanan 3 -->
            <div class="bg-slate-800 rounded-xl p-8 hover:bg-slate-700 transition-colors border border-slate-700 group">
                <div class="w-14 h-14 bg-slate-700 group-hover:bg-amber-500 rounded-lg flex items-center justify-center mb-6 transition-colors">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Jasa Perbaikan & Pemeliharaan</h3>
                <p class="text-slate-400 text-sm">Layanan pemeliharaan preventif dan korektif oleh teknisi andal untuk memastikan mesin Anda beroperasi optimal.</p>
            </div>

            <!-- Layanan 4 -->
            <div class="bg-slate-800 rounded-xl p-8 hover:bg-slate-700 transition-colors border border-slate-700 group">
                <div class="w-14 h-14 bg-slate-700 group-hover:bg-amber-500 rounded-lg flex items-center justify-center mb-6 transition-colors">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Jasa Pengadaan & Instalasi AC</h3>
                <p class="text-slate-400 text-sm">Pengadaan unit AC untuk industri beserta instalasi profesional dan perawatan berkala.</p>
            </div>
        </div>
    </div>
</section>

<!-- Kelebihan Kami -->
<section class="py-20 bg-amber-50 relative">
    <!-- Overlay Pattern -->
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row gap-16 items-center">
            <div class="lg:w-5/12">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 leading-tight">Kenapa Memilih <br><span class="text-amber-500">Borneo Tandayu Perkasa?</span></h2>
                <p class="text-slate-600 text-lg mb-8">Kami memberikan lebih dari sekadar produk kami memberikan nilai tambah untuk setiap proyek Anda dengan keunggulan kompetitif yang kami miliki.</p>
                <a href="https://wa.me/6285238930391" target="_blank" class="inline-flex items-center gap-2 text-amber-600 font-bold hover:text-amber-700 transition-colors">
                    Diskusikan Kebutuhan Anda <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="lg:w-7/12 w-full">
                <div class="space-y-4">
                    <!-- Point 1 -->
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-1">Komitmen pada Kualitas</h4>
                            <p class="text-slate-600">Suku cadang dan layanan yang kami berikan telah melewati standar QC yang ketat.</p>
                        </div>
                    </div>
                    <!-- Point 2 -->
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-1">Respons Cepat</h4>
                            <p class="text-slate-600">Mengerti akan pentingnya waktu dalam industri, kami memberikan layanan responsif dan tanggap.</p>
                        </div>
                    </div>
                    <!-- Point 3 -->
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-1">Dukungan Teknis</h4>
                            <p class="text-slate-600">Tim teknisi kami siap memberikan konsultasi dan dukungan kapan saja Anda butuhkan.</p>
                        </div>
                    </div>
                    <!-- Point 4 -->
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-1">Fleksibilitas & Reputasi</h4>
                            <p class="text-slate-600">Solusi yang dapat disesuaikan dengan skala bisnis Anda dengan reputasi yang telah terbukti di banyak klien besar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Klien Kami (Marquee) -->
<section id="klien" class="py-16 sm:py-20 bg-slate-50/60 border-y border-slate-200/80 overflow-hidden relative">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-10 text-center">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Telah Dipercaya Oleh</h2>
        <div class="w-16 h-1 bg-amber-500 mx-auto rounded-full mt-3"></div>
    </div>

    <!-- Enhanced Infinite Marquee Slider with Logo Above Company Name -->
    <style>
        @keyframes marqueeScroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        .client-marquee-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding: 10px 0;
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to right, t1111ransparent, black 10%, black 90%, transparent);
        }
        .client-marquee-track {
            display: flex;
            width: max-content;
            animation: marqueeScroll 45s linear infinite;
        }
        .client-marquee-container:hover .client-marquee-track {
            animation-play-state: paused;
        }
        .client-item {
            width: 260px;
            flex-shrink: 0;
            margin: 0 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 8px 4px;
            transition: transform 0.3s ease;
        }
        .client-item:hover {
            transform: translateY(-3px);
        }
        .client-logo-box {
            width: 100%;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }
        .client-logo-img {
            max-width: 210px !important;
            max-height: 72px !important;
            width: auto !important;
            height: auto !important;
            object-fit: contain !important;
            display: block !important;
            margin: 0 auto;
        }
    </style>

    @php
        $clientList = (isset($clients) && $clients->isNotEmpty())
            ? $clients
            : collect([
                (object)['nama_perusahaan' => 'PT. Astra Agro Lestari', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Bara Pramulya Abadi', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Belengkong Mineral Resources', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Bhadra Cemerlang', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Borneo Persada Sukses Indonesia', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. DKND Gulden Investama', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Diesel Utama Indonesia', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Diesel Utama Mineral', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Global Energi Lestari', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Kalimantan Mitra Persada', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Makmur Sejahtera Wisesa', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Tanjung Power Indonesia', 'logo_url' => asset('images/client-placeholder.svg')],
                (object)['nama_perusahaan' => 'PT. Tri Buana Mas', 'logo_url' => asset('images/client-placeholder.svg')],
            ]);

        // Ensure seamless looping by repeating if the list is short
        $displayClients = $clientList;
        if ($displayClients->count() < 8) {
            $displayClients = $displayClients->concat($clientList);
        }
    @endphp

    <div class="client-marquee-container">
        <div class="client-marquee-track">
            {{-- First set of clients --}}
            @foreach($displayClients as $c)
                <div class="client-item group">
                    <!-- Logo Perusahaan Fixed Ukuran Besar (Bagian Atas) -->
                    <div class="client-logo-box">
                        <img src="{{ $c->logo_url }}"
                             alt="Logo {{ $c->nama_perusahaan }}"
                             loading="lazy"
                             style="max-width: 210px; max-height: 72px; width: auto; height: auto; object-fit: contain; display: block;"
                             class="client-logo-img transition-transform duration-300 group-hover:scale-105">
                    </div>
                    <!-- Nama Perusahaan di Bawah Logo -->
                    <span class="text-sm sm:text-base font-bold text-slate-800 block text-center leading-snug line-clamp-2 mt-3 transition-colors duration-200 group-hover:text-amber-600">
                        {{ $c->nama_perusahaan }}
                    </span>
                </div>
            @endforeach

            {{-- Duplicate set for seamless continuous marquee loop --}}
            @foreach($displayClients as $c)
                <div class="client-item group" aria-hidden="true">
                    <!-- Logo Perusahaan Fixed Ukuran Besar (Bagian Atas) -->
                    <div class="client-logo-box">
                        <img src="{{ $c->logo_url }}"
                             alt="Logo {{ $c->nama_perusahaan }}"
                             loading="lazy"
                             style="max-width: 210px; max-height: 72px; width: auto; height: auto; object-fit: contain; display: block;"
                             class="client-logo-img transition-transform duration-300 group-hover:scale-105">
                    </div>
                    <!-- Nama Perusahaan di Bawah Logo -->
                    <span class="text-sm sm:text-base font-bold text-slate-800 block text-center leading-snug line-clamp-2 mt-3 transition-colors duration-200 group-hover:text-amber-600">
                        {{ $c->nama_perusahaan }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Struktur Organisasi -->
<section id="struktur-organisasi" class="py-20 bg-white border-t border-slate-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Struktur Organisasi</h2>
            <div class="w-20 h-1.5 bg-amber-500 mx-auto rounded-full"></div>
        </div>

        @if(isset($orgRoots) && $orgRoots->isNotEmpty())
            <div class="org-chart-container overflow-x-auto pb-4">
                <div class="org-chart" style="min-width: fit-content; margin: 0 auto;">
                    @include('partials.org-chart-node', ['nodes' => $orgRoots])
                </div>
            </div>
        @else
            <p class="text-center text-slate-400 py-10">Belum ada data struktur organisasi.</p>
        @endif
    </div>
</section>

<style>
/* ══════════════════════════════
   Org Chart – Public Landing
══════════════════════════════ */
.org-chart { text-align: center; }
.org-chart ul {
    display: flex;
    justify-content: center;
    gap: 16px;
    padding-top: 28px;
    position: relative;
    flex-wrap: wrap;
}
/* vertical line FROM parent down */
.org-chart ul::before {
    content: '';
    position: absolute;
    top: 0; left: 50%;
    border-left: 2px solid #CBD5E1;
    height: 28px;
    transform: translateX(-50%);
}
.org-chart li {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    padding-top: 28px;
    list-style: none;
}
/* vertical line INTO each child */
.org-chart li::before {
    content: '';
    position: absolute;
    top: 0; left: 50%;
    border-left: 2px solid #CBD5E1;
    height: 28px;
    transform: translateX(-50%);
}
/* horizontal connectors between siblings */
.org-chart li:not(:only-child)::after {
    content: '';
    position: absolute;
    top: 0;
    border-top: 2px solid #CBD5E1;
    width: 50%;
}
.org-chart li:not(:only-child):first-child::after  { left: 50%; }
.org-chart li:not(:only-child):last-child::after   { left: 0; width: 50%; }
.org-chart li:not(:only-child):not(:first-child):not(:last-child)::after { left: 0; width: 100%; }

/* Node card */
.org-node-card {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    min-width: 130px;
    max-width: 180px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 14px rgba(0,0,0,0.10);
    border: 1.5px solid #E2E8F0;
    background: #fff;
}
.org-node-header {
    width: 100%;
    background: #1E293B;
    color: #fff;
    padding: 7px 12px;
    text-align: center;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .06em;
    text-transform: uppercase;
}
.org-node-body {
    padding: 8px 14px 10px;
    font-size: 12px;
    font-weight: 600;
    color: #1E293B;
    text-align: center;
    line-height: 1.4;
}
</style>

<!-- Dokumentasi Proyek -->
<section id="dokumentasi" class="py-16 sm:py-24 bg-slate-50 border-y border-slate-200/80">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header with Compact Text and Navigation Controls -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-12 gap-4">
            <div>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Dokumentasi Proyek
                </h2>
                <p class="text-slate-500 text-sm sm:text-base mt-1.5 max-w-xl">
                    Rekam jejak kualitas pengerjaan dan perbaikan teknis PT Borneo Tandayu Perkasa.
                </p>
            </div>

            <!-- Arrow Navigation Controls -->
            <div class="hidden sm:flex items-center gap-3 flex-shrink-0">
                <button id="doc-scroll-prev"
                        class="w-11 h-11 rounded-full bg-white hover:bg-amber-500 hover:text-white text-slate-700 flex items-center justify-center transition-all duration-200 border border-slate-200 shadow-sm hover:shadow active:scale-95"
                        aria-label="Sebelumnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button id="doc-scroll-next"
                        class="w-11 h-11 rounded-full bg-white hover:bg-amber-500 hover:text-white text-slate-700 flex items-center justify-center transition-all duration-200 border border-slate-200 shadow-sm hover:shadow active:scale-95"
                        aria-label="Berikutnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        @if(isset($projectDocs) && $projectDocs->count() > 0)
            <!-- Prominent Large-Image Showcase Track -->
            <div id="doc-scroll-track"
                 class="flex overflow-x-auto gap-6 sm:gap-8 pb-8 snap-x snap-mandatory no-scrollbar"
                 style="scroll-behavior: smooth; -webkit-overflow-scrolling: touch;">
                @foreach($projectDocs as $doc)
                    @php
                        $imgUrl = Str::startsWith($doc->gambar, 'http') ? $doc->gambar : asset('storage/' . $doc->gambar);
                    @endphp
                    <div class="snap-start flex-none group"
                         style="flex: 0 0 auto; width: clamp(288px, 77vw, 594px);">
                        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full">

                            <!-- Massive Photo Container with Direct Click-to-Enlarge Modal -->
                            <div class="relative w-full overflow-hidden bg-slate-950 block cursor-zoom-in group/img"
                                 style="height: clamp(234px, 40vw, 396px);"
                                 onclick="openDocModal('{{ $imgUrl }}', '{{ addslashes($doc->judul) }}', '{{ addslashes($doc->kategori ?? '') }}')">
                                <img src="{{ $imgUrl }}"
                                     alt="{{ $doc->judul }}"
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-500">

                                @if($doc->kategori)
                                    <div class="absolute top-4 left-4 z-10">
                                        <span class="bg-slate-900/85 backdrop-blur-md text-white text-xs font-semibold px-3.5 py-1.5 rounded-full shadow-md border border-white/10">
                                            {{ $doc->kategori }}
                                        </span>
                                    </div>
                                @endif

                                <!-- Hover Overlay Hint -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 flex items-end justify-between p-5">
                                    <span class="text-white text-xs font-medium bg-slate-900/80 backdrop-blur-sm px-3 py-1.5 rounded-lg flex items-center gap-1.5 shadow">
                                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                        Klik untuk memperbesar
                                    </span>
                                </div>
                            </div>

                            <!-- Clean, Spacious Caption Bar (No BTP text) -->
                            <div class="px-5 py-4 bg-white border-t border-slate-100 flex items-center justify-between gap-4">
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-base sm:text-lg font-bold text-slate-900 truncate group-hover:text-amber-600 transition-colors" title="{{ $doc->judul }}">
                                        {{ $doc->judul }}
                                    </h3>
                                    @if($doc->kategori)
                                        <p class="text-xs text-slate-400 font-medium mt-0.5 truncate">{{ $doc->kategori }}</p>
                                    @endif
                                </div>
                                <button type="button"
                                        onclick="openDocModal('{{ $imgUrl }}', '{{ addslashes($doc->judul) }}', '{{ addslashes($doc->kategori ?? '') }}')"
                                        class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-500 hover:text-white px-3.5 py-2 rounded-xl transition-all duration-150 flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                    <span>Perbesar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Lightbox / Fullscreen Modal for Crystal-Clear Viewing -->
            <div id="doc-modal"
                 class="fixed inset-0 z-50 hidden bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4 sm:p-6 transition-opacity duration-300"
                 onclick="closeDocModal(event)">
                <div class="relative max-w-5xl w-full bg-slate-900 rounded-2xl overflow-hidden shadow-2xl border border-slate-800 flex flex-col"
                     onclick="event.stopPropagation()">

                    <!-- Modal Header -->
                    <div class="flex items-center justify-between px-6 py-4 bg-slate-900/90 border-b border-slate-800">
                        <div class="min-w-0 pr-4">
                            <span id="doc-modal-cat" class="text-amber-400 text-xs font-semibold uppercase tracking-wider block"></span>
                            <h4 id="doc-modal-title" class="text-white text-base sm:text-lg font-bold truncate"></h4>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a id="doc-modal-raw" href="#" target="_blank" class="text-xs text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                <span>Tab Baru</span>
                            </a>
                            <button type="button"
                                    onclick="closeDocModalDirect()"
                                    class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-red-500 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Big Image Display -->
                    <div class="bg-black/90 flex items-center justify-center p-2 sm:p-4 max-h-[75vh] overflow-hidden">
                        <img id="doc-modal-img" src="" alt="Dokumentasi Proyek Penuh" class="max-h-[72vh] max-w-full object-contain rounded-lg">
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const track = document.getElementById('doc-scroll-track');
                    const prevBtn = document.getElementById('doc-scroll-prev');
                    const nextBtn = document.getElementById('doc-scroll-next');

                    if (track && prevBtn && nextBtn) {
                        prevBtn.addEventListener('click', function() {
                            track.scrollBy({ left: -600, behavior: 'smooth' });
                        });
                        nextBtn.addEventListener('click', function() {
                            track.scrollBy({ left: 600, behavior: 'smooth' });
                        });
                    }

                    // Keyboard escape to close modal
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') {
                            closeDocModalDirect();
                        }
                    });
                });

                function openDocModal(imgUrl, title, category) {
                    const modal = document.getElementById('doc-modal');
                    const modalImg = document.getElementById('doc-modal-img');
                    const modalTitle = document.getElementById('doc-modal-title');
                    const modalCat = document.getElementById('doc-modal-cat');
                    const modalRaw = document.getElementById('doc-modal-raw');

                    if (modal && modalImg) {
                        modalImg.src = imgUrl;
                        if (modalTitle) modalTitle.textContent = title;
                        if (modalCat) modalCat.textContent = category || 'Dokumentasi Proyek';
                        if (modalRaw) modalRaw.href = imgUrl;
                        modal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }
                }

                function closeDocModal(event) {
                    if (event.target === document.getElementById('doc-modal')) {
                        closeDocModalDirect();
                    }
                }

                function closeDocModalDirect() {
                    const modal = document.getElementById('doc-modal');
                    if (modal) {
                        modal.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                }
            </script>
        @else
            <div class="text-center py-16 bg-white rounded-2xl border border-slate-200 border-dashed">
                <p class="text-slate-500 text-sm">Belum ada dokumentasi proyek.</p>
            </div>
        @endif
    </div>
</section>

<!-- Etalase Produk (Horizontal Scroll Track) -->
<section id="produk" class="py-16 sm:py-24 bg-white border-t border-slate-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header with Navigation Controls & "Lihat Semua" Link -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-12 gap-4">
            <div>

                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Etalase Suku Cadang & Produk
                </h2>
                <p class="text-slate-500 text-sm sm:text-base mt-1.5 max-w-xl">
                    Pilihan suku cadang industri dan komponen alat berat berkualitas siap memenuhi kebutuhan operasional Anda.
                </p>
            </div>

            <!-- Controls & Direct Link -->
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ route('produk.all') }}" class="hidden md:inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 px-4 py-2.5 rounded-full transition-colors mr-1">
                    <span>Lihat Semua ({{ $products->count() }})</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>

                <!-- Arrow Navigation Controls -->
                <button id="prod-scroll-prev"
                        class="w-11 h-11 rounded-full bg-slate-50 hover:bg-amber-500 hover:text-white text-slate-700 flex items-center justify-center transition-all duration-200 border border-slate-200 shadow-sm active:scale-95"
                        aria-label="Produk Sebelumnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button id="prod-scroll-next"
                        class="w-11 h-11 rounded-full bg-slate-50 hover:bg-amber-500 hover:text-white text-slate-700 flex items-center justify-center transition-all duration-200 border border-slate-200 shadow-sm active:scale-95"
                        aria-label="Produk Berikutnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        @if($products->count() > 0)
            <!-- Horizontal Product Showcase Track (Panjang ke Samping) -->
            <div id="prod-scroll-track"
                 class="flex overflow-x-auto gap-6 sm:gap-7 pb-8 snap-x snap-mandatory no-scrollbar"
                 style="scroll-behavior: smooth; -webkit-overflow-scrolling: touch;">
                @foreach($products as $product)
                    <div class="snap-start flex-none group"
                         style="flex: 0 0 auto; width: clamp(260px, 75vw, 320px);">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/90 transition-all duration-300 flex flex-col h-full">
                            <!-- Image -->
                            <div class="relative h-60 sm:h-64 overflow-hidden bg-slate-100 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $product->gambar) }}"
                                     alt="{{ $product->nama_produk }}"
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>

                            <!-- Content -->
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

                                <div class="mt-4 pt-3 border-t border-slate-100">
                                    <a href="https://wa.me/6285238930391?text={{ urlencode('Halo Admin PT Borneo Tandayu Perkasa, saya ingin menanyakan produk: ' . $product->nama_produk) }}"
                                       target="_blank"
                                       class="w-full bg-slate-900 hover:bg-amber-500 hover:text-white text-white py-2.5 px-3 rounded-xl font-bold text-xs transition-all duration-200 flex items-center justify-center gap-1.5 shadow-sm">
                                        <svg class="w-3.5 h-3.5 fill-current text-emerald-400 group-hover:text-white" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                        <span>Tanya Stok &amp; Harga</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Action Buttons: "Lihat Semua" & WhatsApp Inquiry -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4 text-center">
                <!-- Dedicated "Lihat Semua" Button -->
                <a href="{{ route('produk.all') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-8 py-3.5 rounded-full font-bold text-sm transition-all shadow-md hover:shadow-amber-500/30 transform hover:-translate-y-0.5 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    <span>Lihat Semua Produk (Katalog Lengkap)</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>

                <a href="https://wa.me/6285238930391" target="_blank"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-8 py-3.5 rounded-full font-bold text-sm transition-all shadow-md transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 fill-current text-emerald-400" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>Tanya Ketersediaan Khusus</span>
                </a>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const prodTrack = document.getElementById('prod-scroll-track');
                    const prodPrev = document.getElementById('prod-scroll-prev');
                    const prodNext = document.getElementById('prod-scroll-next');
                    if (prodTrack && prodPrev && prodNext) {
                        prodPrev.addEventListener('click', function() {
                            prodTrack.scrollBy({ left: -340, behavior: 'smooth' });
                        });
                        prodNext.addEventListener('click', function() {
                            prodTrack.scrollBy({ left: 340, behavior: 'smooth' });
                        });
                    }
                });
            </script>
        @else
            <div class="text-center py-20 bg-white rounded-2xl border border-slate-200 border-dashed">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-500 mb-2">Belum ada produk</h3>
                <p class="text-slate-400">Produk akan segera ditambahkan ke katalog kami.</p>
            </div>
        @endif
    </div>
</section>

@endsection
