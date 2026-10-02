<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - PT Borneo Tandayu Perkasa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased selection:bg-amber-500 selection:text-white">
    <div class="min-h-screen flex flex-col md:flex-row relative">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-slate-900 text-white shadow-2xl flex-shrink-0 flex flex-col relative z-20 border-r border-slate-800/80">
            <!-- Sidebar Decorative Ambient Glow -->
            <div class="absolute -top-12 -left-12 w-48 h-48 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>
            
            <!-- Sidebar Brand Header -->
            <div class="p-6 border-b border-slate-800/80 relative z-10">
                <div class="flex items-center gap-3.5">
                    <img src="{{ asset('images/logo-btp.webp') }}" alt="Logo PT Borneo Tandayu Perkasa" class="h-10 w-auto object-contain flex-shrink-0 bg-white p-1 rounded-xl shadow-md">
                    <div class="flex flex-col">
                        <h2 class="font-black text-sm leading-tight tracking-wider text-white uppercase">RUANG<br>MANAJEMEN</h2>
                        <span class="text-[9px] font-semibold text-amber-400/90 tracking-wider uppercase mt-1 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Admin Portal
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar Navigation -->
            <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto relative z-10">
                <div class="px-3 pb-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">
                    Menu Utama
                </div>

                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.produk.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.produk.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.produk.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span>Kelola Produk</span>
                </a>

                <a href="{{ route('admin.foto-tentang.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.foto-tentang.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.foto-tentang.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Foto Tentang Kami</span>
                </a>

                <a href="{{ route('admin.dokumentasi.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.dokumentasi.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dokumentasi.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Dokumentasi Proyek</span>
                </a>

                <a href="{{ route('admin.klien.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.klien.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.klien.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Kelola Klien</span>
                </a>
            </nav>


            <!-- Sidebar Bottom Status & Quick Link (Logout moved to profile dropdown) -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-950/40 relative z-10">
                <div class="flex items-center justify-between text-xs text-slate-400 mb-2.5 px-1">
                    <span class="flex items-center gap-1.5 font-medium">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        Sistem Aktif
                    </span>
                    <span class="text-[10px] font-mono text-slate-500 bg-slate-800/80 px-1.5 py-0.5 rounded border border-slate-700/60">CMS v2.0</span>
                </div>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center gap-2 text-xs font-semibold text-amber-400 hover:text-amber-300 py-2 px-3 rounded-lg bg-amber-500/10 hover:bg-amber-500/20 transition-all border border-amber-500/20 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>Lihat Website</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden flex flex-col min-h-screen relative bg-slate-50/80">
            <!-- Background Ornaments / Ambient Glows -->
            <div class="fixed top-0 right-0 -mt-16 -mr-16 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none z-0"></div>
            <div class="fixed bottom-0 right-1/4 -mb-20 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl pointer-events-none z-0"></div>

            <!-- Top Header -->
            <header class="bg-white/90 backdrop-blur-md h-18 sm:h-20 flex items-center justify-between px-6 sm:px-8 border-b border-slate-200/80 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.03)] sticky top-0 z-30">
                <!-- Header Left: Title with Modern Accent -->
                <div class="flex items-center gap-3.5">
                    <div class="w-2 h-7 bg-gradient-to-b from-amber-400 to-amber-600 rounded-full shadow-sm"></div>
                    <div>
                        <h1 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight leading-tight">
                            @yield('title', 'Dashboard')
                        </h1>
                        <p class="text-[11px] text-slate-400 font-medium hidden sm:block">
                            PT Borneo Tandayu Perkasa &bull; Ruang Manajemen
                        </p>
                    </div>
                </div>

                <!-- Header Right: Profile Avatar & Interactive Logout Dropdown -->
                <div class="relative" id="profile-container">
                    <button type="button" 
                            id="profile-toggle-btn"
                            class="flex items-center gap-3 py-1.5 pl-2 pr-3.5 rounded-full bg-slate-50 hover:bg-slate-100/90 border border-slate-200/90 shadow-sm transition-all duration-150 cursor-pointer focus:outline-none focus:ring-2 focus:ring-amber-500/30">
                        <!-- Profile Avatar Logo / Icon -->
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-amber-500 to-amber-600 flex items-center justify-center text-white font-bold text-sm shadow-sm ring-2 ring-amber-500/20 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        
                        <!-- Name & Role -->
                        <div class="text-left hidden sm:block pr-1">
                            <span class="block text-xs font-bold text-slate-800 leading-tight">
                                Halo, {{ Auth::user()->name ?? 'Andi' }}
                            </span>
                            <span class="block text-[10px] text-slate-400 font-medium leading-none mt-0.5">
                                Administrator
                            </span>
                        </div>

                        <!-- Dropdown Chevron Icon -->
                        <svg id="profile-chevron" class="w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <!-- Interactive Profile Dropdown Menu with Logout Button -->
                    <div id="profile-dropdown" 
                         class="absolute right-0 mt-2.5 w-64 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 hidden opacity-0 scale-95 transition-all duration-150 origin-top-right">
                        
                        <!-- User Card Header inside Dropdown -->
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center gap-3 bg-slate-50/50 rounded-t-2xl">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-500 to-amber-600 flex items-center justify-center text-white font-bold text-base shadow-sm ring-2 ring-amber-500/20 flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name ?? 'Andi' }}</p>
                                <span class="inline-block text-[10px] font-semibold text-amber-700 bg-amber-50 border border-amber-200/80 px-2 py-0.5 rounded-full mt-0.5">
                                    Administrator
                                </span>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div class="px-2 py-1.5 space-y-0.5">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-slate-600 hover:bg-amber-50/60 hover:text-amber-700 rounded-xl transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                <span>Dashboard Ruang Manajemen</span>
                            </a>
                            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-slate-600 hover:bg-amber-50/60 hover:text-amber-700 rounded-xl transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                <span>Kunjungi Website Utama</span>
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="my-1.5 border-t border-slate-100"></div>

                        <!-- Logout Action Form (Moved from sidebar to here) -->
                        <div class="px-2 pb-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2.5 text-xs font-bold text-red-600 hover:bg-red-50 hover:text-red-700 rounded-xl transition-colors text-left cursor-pointer group">
                                    <div class="w-7 h-7 rounded-lg bg-red-100 group-hover:bg-red-200 flex items-center justify-center text-red-600 transition-colors flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    </div>
                                    <span>Keluar / Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6 md:p-8 flex-1 relative z-10">
                @if(session('success'))
                    <div class="bg-emerald-50 text-emerald-800 border border-emerald-200 p-4 rounded-xl mb-6 flex items-start gap-3 shadow-sm animate-fade-in">
                        <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <p class="font-semibold text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-50 text-red-700 border border-red-200 p-4 rounded-xl mb-6 flex items-start gap-3 shadow-sm">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <div>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
            
            <!-- Footer Admin -->
            <footer class="bg-white/80 backdrop-blur-sm border-t border-slate-200/80 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-400 mt-auto relative z-10">
                <p>&copy; {{ date('Y') }} PT Borneo Tandayu Perkasa &bull; CMS Ruang Manajemen</p>
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Admin Terverifikasi</span>
                </div>
            </footer>
        </main>
    </div>

    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('profile-toggle-btn');
            const dropdown = document.getElementById('profile-dropdown');
            const chevron = document.getElementById('profile-chevron');
            const container = document.getElementById('profile-container');

            if (toggleBtn && dropdown) {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = dropdown.classList.contains('hidden');
                    if (isHidden) {
                        dropdown.classList.remove('hidden');
                        setTimeout(() => {
                            dropdown.classList.remove('opacity-0', 'scale-95');
                            dropdown.classList.add('opacity-100', 'scale-100');
                        }, 10);
                        if (chevron) chevron.classList.add('rotate-180');
                    } else {
                        closeDropdown();
                    }
                });

                document.addEventListener('click', function(e) {
                    if (container && !container.contains(e.target)) {
                        closeDropdown();
                    }
                });

                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeDropdown();
                    }
                });

                function closeDropdown() {
                    if (dropdown && !dropdown.classList.contains('hidden')) {
                        dropdown.classList.remove('opacity-100', 'scale-100');
                        dropdown.classList.add('opacity-0', 'scale-95');
                        setTimeout(() => {
                            dropdown.classList.add('hidden');
                        }, 150);
                        if (chevron) chevron.classList.remove('rotate-180');
                    }
                }
            }
        });
    </script>
    <!-- Auto-Logout: 30 Menit Tidak Aktif -->
    <script>
        (function() {
            const TIMEOUT_MS     = 30 * 60 * 1000; // 30 menit
            const WARNING_MS     = 5  * 60 * 1000; // peringatan 5 menit sebelum logout
            const LOGOUT_URL     = '{{ route("logout") }}';
            const CSRF_TOKEN     = '{{ csrf_token() }}';

            let logoutTimer, warningTimer, countdownInterval;

            // === Buat elemen modal peringatan ===
            const overlay = document.createElement('div');
            overlay.id = 'autologout-overlay';
            overlay.style.cssText = `
                display:none; position:fixed; inset:0; z-index:9999;
                background:rgba(15,23,42,0.65); backdrop-filter:blur(4px);
                align-items:center; justify-content:center;
            `;

            overlay.innerHTML = `
                <div style="background:#fff; border-radius:1.25rem; padding:2rem 2.5rem; max-width:380px; width:90%; box-shadow:0 25px 60px -10px rgba(0,0,0,.25); text-align:center; font-family:'Inter',sans-serif;">
                    <div style="width:56px;height:56px;border-radius:50%;background:#FEF3C7;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                        <svg width="28" height="28" fill="none" stroke="#D97706" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    </div>
                    <h3 style="font-size:1.1rem;font-weight:800;color:#0F172A;margin:0 0 .5rem;">Sesi Akan Berakhir</h3>
                    <p style="font-size:.85rem;color:#64748B;margin:0 0 1.5rem;line-height:1.5;">
                        Anda tidak aktif. Sesi otomatis berakhir dalam<br>
                        <strong id="autologout-countdown" style="font-size:1.75rem;font-weight:900;color:#D97706;display:block;margin:.5rem 0;">5:00</strong>
                    </p>
                    <div style="display:flex;gap:.75rem;justify-content:center;">
                        <button id="autologout-stay" style="flex:1;padding:.65rem 1rem;border-radius:.75rem;background:#F59E0B;color:#fff;font-weight:700;font-size:.85rem;border:none;cursor:pointer;transition:background .15s;" onmouseover="this.style.background='#D97706'" onmouseout="this.style.background='#F59E0B'">
                            Tetap Login
                        </button>
                        <button id="autologout-now" style="flex:1;padding:.65rem 1rem;border-radius:.75rem;background:#F1F5F9;color:#64748B;font-weight:700;font-size:.85rem;border:none;cursor:pointer;transition:background .15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">
                            Logout Sekarang
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(overlay);

            // === Fungsi logout via POST ===
            function doLogout() {
                clearAll();
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = LOGOUT_URL;
                const csrf = document.createElement('input');
                csrf.type  = 'hidden';
                csrf.name  = '_token';
                csrf.value = CSRF_TOKEN;
                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }

            // === Tampilkan peringatan & mulai countdown ===
            function showWarning() {
                overlay.style.display = 'flex';
                let secondsLeft = Math.floor(WARNING_MS / 1000);
                updateCountdown(secondsLeft);
                countdownInterval = setInterval(function() {
                    secondsLeft--;
                    updateCountdown(secondsLeft);
                    if (secondsLeft <= 0) { clearInterval(countdownInterval); doLogout(); }
                }, 1000);
            }

            function updateCountdown(sec) {
                const el = document.getElementById('autologout-countdown');
                if (el) el.textContent = Math.floor(sec/60) + ':' + String(sec%60).padStart(2,'0');
            }

            function hideWarning() {
                overlay.style.display = 'none';
                clearInterval(countdownInterval);
            }

            function clearAll() {
                clearTimeout(logoutTimer);
                clearTimeout(warningTimer);
                clearInterval(countdownInterval);
            }

            // === Reset timer saat ada aktivitas ===
            function resetTimers() {
                hideWarning();
                clearAll();
                warningTimer = setTimeout(showWarning, TIMEOUT_MS - WARNING_MS);
                logoutTimer  = setTimeout(doLogout,   TIMEOUT_MS);
            }

            // === Event aktivitas pengguna ===
            ['mousemove','mousedown','keydown','touchstart','scroll','click'].forEach(function(evt) {
                document.addEventListener(evt, resetTimers, { passive: true });
            });

            // === Tombol di modal ===
            document.getElementById('autologout-stay').addEventListener('click', resetTimers);
            document.getElementById('autologout-now').addEventListener('click', doLogout);

            // === Mulai ===
            resetTimers();
        })();
    </script>
</body>
</html>
