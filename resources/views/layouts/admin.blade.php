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
        <aside id="admin-sidebar" class="sidebar-expanded w-full md:w-64 bg-slate-900 text-white shadow-2xl flex-shrink-0 flex flex-col relative z-20 border-r border-slate-800/80 transition-all duration-300 ease-in-out overflow-hidden">
            <!-- Sidebar Decorative Ambient Glow -->
            <div class="absolute -top-12 -left-12 w-48 h-48 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>
            
            <!-- Sidebar Brand Header -->
            <div id="sidebar-header" class="p-4 border-b border-slate-800/80 relative z-10 flex items-center justify-between min-w-0 transition-all duration-300">
                <div class="flex items-center gap-3.5 min-w-0 overflow-hidden">
                    <img src="{{ asset('images/logo-btp.webp') }}" alt="Logo PT Borneo Tandayu Perkasa" class="h-10 w-10 object-contain flex-shrink-0 bg-white p-1 rounded-xl shadow-md">
                    <div id="sidebar-brand-text" class="flex flex-col min-w-0 overflow-hidden transition-all duration-300">
                        <h2 class="font-black text-sm leading-tight tracking-wider text-white uppercase whitespace-nowrap">RUANG<br>MANAJEMEN</h2>
                        <span class="text-[9px] font-semibold text-amber-400/90 tracking-wider uppercase mt-1 flex items-center gap-1 whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse flex-shrink-0"></span>
                            Admin Portal
                        </span>
                    </div>
                </div>
                <!-- Toggle Button -->
                <button id="sidebar-toggle-btn"
                        title="Minimize/Maximize Sidebar"
                        class="flex-shrink-0 w-7 h-7 rounded-lg bg-slate-800 hover:bg-slate-700 border border-slate-700/60 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-200 ml-2">
                    <svg id="sidebar-toggle-icon" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>
            </div>
            
            <!-- Sidebar Navigation -->
            <nav class="flex-1 p-3 space-y-1 overflow-y-auto overflow-x-hidden relative z-10">
                <div id="sidebar-menu-label" class="px-3 pb-2 text-[10px] font-bold uppercase tracking-widest text-slate-500 whitespace-nowrap overflow-hidden transition-all duration-300">
                    Menu Utama
                </div>

                <a href="{{ route('admin.dashboard') }}" 
                   title="Dashboard"
                   class="sidebar-nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="sidebar-link-text whitespace-nowrap overflow-hidden transition-all duration-300">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.produk.index') }}" 
                   title="Kelola Produk"
                   class="sidebar-nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.produk.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.produk.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span class="sidebar-link-text whitespace-nowrap overflow-hidden transition-all duration-300">Kelola Produk</span>
                </a>

                <a href="{{ route('admin.kategori.index') }}" 
                   title="Kelola Kategori"
                   class="sidebar-nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.kategori.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.kategori.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span class="sidebar-link-text whitespace-nowrap overflow-hidden transition-all duration-300">Kelola Kategori</span>
                </a>

                <a href="{{ route('admin.foto-tentang.index') }}" 
                   title="Foto Tentang Kami"
                   class="sidebar-nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.foto-tentang.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.foto-tentang.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="sidebar-link-text whitespace-nowrap overflow-hidden transition-all duration-300">Foto Tentang Kami</span>
                </a>

                <a href="{{ route('admin.dokumentasi.index') }}" 
                   title="Dokumentasi Proyek"
                   class="sidebar-nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.dokumentasi.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.dokumentasi.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="sidebar-link-text whitespace-nowrap overflow-hidden transition-all duration-300">Dokumentasi Proyek</span>
                </a>

                <a href="{{ route('admin.klien.index') }}" 
                   title="Kelola Klien"
                   class="sidebar-nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.klien.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.klien.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span class="sidebar-link-text whitespace-nowrap overflow-hidden transition-all duration-300">Kelola Klien</span>
                </a>

                @if(Auth::user() && Auth::user()->isSuperAdmin())
                <div id="sidebar-superadmin-label" class="pt-4 px-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-amber-400 whitespace-nowrap overflow-hidden transition-all duration-300 flex items-center gap-1.5">
                    <svg class="w-3 h-3 text-amber-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"/></svg>
                    <span>Super Admin</span>
                </div>

                <a href="{{ route('admin.kelola-admin.index') }}" 
                   title="Kelola Admin"
                   class="sidebar-nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.kelola-admin.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.kelola-admin.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span class="sidebar-link-text whitespace-nowrap overflow-hidden transition-all duration-300 flex items-center justify-between flex-1">
                        <span>Kelola Admin</span>
                        <span class="text-[9px] font-extrabold bg-amber-400/25 text-amber-300 px-1.5 py-0.5 rounded border border-amber-400/30">SUPER</span>
                    </span>
                </a>
                @endif

                <div id="sidebar-account-label" class="pt-4 px-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-slate-500 whitespace-nowrap overflow-hidden transition-all duration-300">
                    Pengaturan
                </div>

                <a href="{{ route('admin.password.edit') }}" 
                   title="Ganti Password"
                   class="sidebar-nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 {{ request()->routeIs('admin.password.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/20 font-semibold' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.password.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                    <span class="sidebar-link-text whitespace-nowrap overflow-hidden transition-all duration-300">Ganti Password</span>
                </a>
            </nav>

            <!-- Sidebar Bottom Status & Quick Link -->
            <div class="p-3 border-t border-slate-800/80 bg-slate-950/40 relative z-10 overflow-hidden">
                <div id="sidebar-bottom-text" class="flex items-center justify-between text-xs text-slate-400 mb-2.5 px-1 overflow-hidden transition-all duration-300">
                    <span class="flex items-center gap-1.5 font-medium whitespace-nowrap">
                        <span class="relative flex h-2 w-2 flex-shrink-0">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        Sistem Aktif
                    </span>
                    <span class="text-[10px] font-mono text-slate-500 bg-slate-800/80 px-1.5 py-0.5 rounded border border-slate-700/60 whitespace-nowrap">CMS v2.0</span>
                </div>
                <a href="{{ route('home') }}" target="_blank"
                   id="sidebar-bottom-link"
                   title="Lihat Website"
                   class="flex items-center justify-center gap-2 text-xs font-semibold text-amber-400 hover:text-amber-300 py-2 px-3 rounded-lg bg-amber-500/10 hover:bg-amber-500/20 transition-all border border-amber-500/20 shadow-sm overflow-hidden">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span class="sidebar-link-text whitespace-nowrap overflow-hidden transition-all duration-300">Lihat Website</span>
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
                                Halo, {{ Auth::user()->name ?? 'Admin' }}
                            </span>
                            <span class="block text-[10px] {{ Auth::user() && Auth::user()->isSuperAdmin() ? 'text-amber-600 font-bold' : 'text-slate-400 font-medium' }} leading-none mt-0.5">
                                {{ Auth::user() && Auth::user()->isSuperAdmin() ? 'Super Administrator' : 'Administrator' }}
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
                                <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                                <span class="inline-block text-[10px] font-semibold {{ Auth::user() && Auth::user()->isSuperAdmin() ? 'text-amber-800 bg-amber-100 border-amber-300' : 'text-amber-700 bg-amber-50 border-amber-200/80' }} border px-2 py-0.5 rounded-full mt-0.5">
                                    {{ Auth::user() && Auth::user()->isSuperAdmin() ? 'Super Admin' : 'Administrator' }}
                                </span>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div class="px-2 py-1.5 space-y-0.5">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-slate-600 hover:bg-amber-50/60 hover:text-amber-700 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-amber-50 text-amber-700 font-semibold' : '' }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-amber-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                <span>Dashboard Ruang Manajemen</span>
                            </a>
                            @if(Auth::user() && Auth::user()->isSuperAdmin())
                            <a href="{{ route('admin.kelola-admin.index') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-slate-600 hover:bg-amber-50/60 hover:text-amber-700 rounded-xl transition-colors {{ request()->routeIs('admin.kelola-admin.*') ? 'bg-amber-50 text-amber-700 font-semibold' : '' }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('admin.kelola-admin.*') ? 'text-amber-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Kelola Admin (Super Admin)</span>
                            </a>
                            @endif
                            <a href="{{ route('admin.password.edit') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-slate-600 hover:bg-amber-50/60 hover:text-amber-700 rounded-xl transition-colors {{ request()->routeIs('admin.password.*') ? 'bg-amber-50 text-amber-700 font-semibold' : '' }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('admin.password.*') ? 'text-amber-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                <span>Ganti Password</span>
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

                @if(session('error'))
                    <div class="bg-red-50 text-red-800 border border-red-200 p-4 rounded-xl mb-6 flex items-start gap-3 shadow-sm animate-fade-in">
                        <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <p class="font-semibold text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif
                
                @if(isset($errors) && $errors->any())
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

    <!-- Sidebar Toggle Script -->
    <style>
        #admin-sidebar {
            transition: width 0.3s cubic-bezier(.4,0,.2,1);
        }
        #admin-sidebar.sidebar-collapsed {
            width: 72px !important;
        }
        #admin-sidebar.sidebar-expanded {
            width: 256px !important;
        }

        /* === Collapsed: sembunyikan semua teks === */
        #admin-sidebar.sidebar-collapsed .sidebar-link-text,
        #admin-sidebar.sidebar-collapsed #sidebar-brand-text,
        #admin-sidebar.sidebar-collapsed #sidebar-menu-label,
        #admin-sidebar.sidebar-collapsed #sidebar-account-label,
        #admin-sidebar.sidebar-collapsed #sidebar-bottom-text {
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            pointer-events: none;
            margin: 0;
            padding: 0;
        }

        /* === Collapsed: header jadi centered (logo + tombol toggle) === */
        #admin-sidebar.sidebar-collapsed #sidebar-header {
            justify-content: center;
            flex-direction: column;
            gap: 8px;
            padding-top: 14px;
            padding-bottom: 14px;
        }
        #admin-sidebar.sidebar-collapsed #sidebar-header > div {
            justify-content: center;
        }
        #admin-sidebar.sidebar-collapsed #sidebar-toggle-btn {
            margin-left: 0;
        }

        /* === Collapsed: nav items centered === */
        #admin-sidebar.sidebar-collapsed .sidebar-nav-link {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
            gap: 0;
        }
        #admin-sidebar.sidebar-collapsed nav {
            padding-left: 8px;
            padding-right: 8px;
        }

        /* === Collapsed: bottom link centered === */
        #admin-sidebar.sidebar-collapsed #sidebar-bottom-link {
            padding-left: 0;
            padding-right: 0;
            gap: 0;
        }

        /* === Transisi teks === */
        .sidebar-link-text,
        #sidebar-brand-text,
        #sidebar-menu-label,
        #sidebar-account-label,
        #sidebar-bottom-text {
            transition: max-width 0.25s ease, opacity 0.2s ease;
            max-width: 200px;
            opacity: 1;
        }
        .sidebar-nav-link,
        #sidebar-bottom-link {
            transition: justify-content 0.3s ease, padding 0.3s ease, gap 0.3s ease, background 0.15s ease;
        }

        @media (max-width: 767px) {
            #admin-sidebar.sidebar-collapsed,
            #admin-sidebar.sidebar-expanded {
                width: 100% !important;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar    = document.getElementById('admin-sidebar');
            const toggleBtn  = document.getElementById('sidebar-toggle-btn');
            const toggleIcon = document.getElementById('sidebar-toggle-icon');
            const STORAGE_KEY = 'admin_sidebar_collapsed';

            function applyState(collapsed, animate) {
                if (!animate) sidebar.style.transition = 'none';
                if (collapsed) {
                    sidebar.classList.remove('sidebar-expanded');
                    sidebar.classList.add('sidebar-collapsed');
                    toggleIcon.style.transform = 'rotate(180deg)';
                } else {
                    sidebar.classList.remove('sidebar-collapsed');
                    sidebar.classList.add('sidebar-expanded');
                    toggleIcon.style.transform = 'rotate(0deg)';
                }
                if (!animate) {
                    // Force reflow then re-enable transition
                    sidebar.offsetHeight;
                    sidebar.style.transition = '';
                }
            }

            // Load saved state (no animation on initial load)
            const isCollapsed = localStorage.getItem(STORAGE_KEY) === 'true';
            applyState(isCollapsed, false);

            // Toggle on button click
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    const nowCollapsed = sidebar.classList.contains('sidebar-expanded');
                    applyState(nowCollapsed, true);
                    localStorage.setItem(STORAGE_KEY, nowCollapsed ? 'true' : 'false');
                });
            }
        });
    </script>

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
