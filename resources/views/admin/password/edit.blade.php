@extends('layouts.admin')

@section('title', 'Ganti Password')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Top Breadcrumb & Quick Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-amber-600 transition-colors flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-600">Pengaturan</span>
            <span class="text-slate-300">/</span>
            <span class="text-amber-600 font-bold">Keamanan & Password</span>
        </div>

        <a href="{{ route('admin.dashboard') }}" 
           class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-50 border border-slate-200/90 px-3.5 py-2 rounded-xl transition-all shadow-sm hover:shadow w-fit">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>

    <!-- Modern Account Identity Header -->
    <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-sm relative overflow-hidden">
        <div class="absolute top-0 right-0 w-80 h-full bg-gradient-to-l from-amber-500/5 via-amber-500/0 to-transparent pointer-events-none"></div>
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5 relative z-10">
            <!-- Left: Avatar & Identity -->
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-amber-500 to-amber-600 p-0.5 shadow-md shadow-amber-500/20 flex-shrink-0 flex items-center justify-center">
                    <div class="w-full h-full bg-white rounded-[14px] flex items-center justify-center text-amber-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-2.5 flex-wrap">
                        <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">{{ Auth::user()->name }}</h2>
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-amber-700 bg-amber-50 border border-amber-200/80 px-2.5 py-0.5 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Administrator
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2.5 py-0.5 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Sesi Aktif
                        </span>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-slate-500 mt-1 flex-wrap font-medium">
                        <span class="text-slate-600">{{ Auth::user()->email }}</span>
                        <span class="text-slate-300">&bull;</span>
                        <span class="text-slate-500">Akses Penuh Ruang Manajemen</span>
                    </div>
                </div>
            </div>

            <!-- Right: Last Updated Status Info -->
            <div class="flex items-center gap-3 bg-slate-50 border border-slate-200/70 px-4 py-2.5 rounded-xl text-xs text-slate-600 w-fit">
                <div class="w-7 h-7 rounded-lg bg-amber-100/80 text-amber-700 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <div>
                    <span class="block text-[10px] uppercase font-bold text-slate-400 leading-tight">Terakhir Diperbarui</span>
                    <span class="font-semibold text-slate-800">{{ Auth::user()->updated_at ? Auth::user()->updated_at->diffForHumans() : 'Belum pernah diubah' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Layout (2-Column Grid with balanced md: breakpoint) -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Change Password Form (7 Cols on desktop/tablet) -->
        <div class="md:col-span-7 bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
            <!-- Header Card -->
            <div class="p-6 border-b border-slate-100 flex items-center gap-3.5 bg-gradient-to-r from-slate-50/80 to-white">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-600 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-base text-slate-900 tracking-tight">Formulir Ganti Password</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Masukkan password saat ini untuk verifikasi, lalu tentukan password baru yang aman.</p>
                </div>
            </div>

            <!-- Form Body -->
            <form action="{{ route('admin.password.update') }}" method="POST" class="p-6 sm:p-7 space-y-5" id="passwordForm">
                @csrf
                @method('PUT')

                <!-- Field 1: Current Password -->
                <div>
                    <label for="current_password" class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center justify-between">
                        <span>Password Saat Ini <span class="text-red-500">*</span></span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="current_password" 
                               id="current_password" 
                               required
                               autocomplete="current-password"
                               placeholder="Masukkan password saat ini"
                               class="w-full h-11 pl-4 pr-12 rounded-xl border {{ $errors->has('current_password') ? 'border-red-400 bg-red-50/20 ring-4 ring-red-400/10' : 'border-slate-200 bg-slate-50/40 hover:bg-white focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10' }} outline-none transition-all text-sm font-medium text-slate-800 placeholder:text-slate-400">
                        
                        <button type="button" 
                                onclick="togglePasswordVisibility('current_password', 'current_password_icon')" 
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 p-1.5 rounded-lg hover:bg-slate-100 transition-colors focus:outline-none"
                                title="Tampilkan / Sembunyikan Password">
                            <svg id="current_password_icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="text-xs text-red-600 font-semibold mt-1.5 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Subtle Section Separator -->
                <div class="relative py-1">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                    <div class="relative flex justify-start">
                        <span class="bg-white pr-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Password Baru
                        </span>
                    </div>
                </div>

                <!-- Field 2: New Password -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               required
                               autocomplete="new-password"
                               placeholder="Minimal 8 karakter unik"
                               class="w-full h-11 pl-4 pr-12 rounded-xl border {{ $errors->has('password') ? 'border-red-400 bg-red-50/20 ring-4 ring-red-400/10' : 'border-slate-200 bg-slate-50/40 hover:bg-white focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10' }} outline-none transition-all text-sm font-medium text-slate-800 placeholder:text-slate-400">
                        
                        <button type="button" 
                                onclick="togglePasswordVisibility('password', 'password_icon')" 
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 p-1.5 rounded-lg hover:bg-slate-100 transition-colors focus:outline-none"
                                title="Tampilkan / Sembunyikan Password">
                            <svg id="password_icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    @error('password')
                        <p class="text-xs text-red-600 font-semibold mt-1.5 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror

                    <!-- Interactive Password Strength Meter & Real-time Checklist -->
                    <div class="mt-3 p-3.5 bg-slate-50/80 rounded-xl border border-slate-200/60 space-y-2.5">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-500 font-medium">Kekuatan Password:</span>
                            <span id="strength-label" class="font-bold text-slate-400">Belum diisi</span>
                        </div>
                        <!-- 4-Segment Strength Bar -->
                        <div class="grid grid-cols-4 gap-1.5">
                            <div id="bar-1" class="h-1.5 rounded-full bg-slate-200 transition-all duration-300"></div>
                            <div id="bar-2" class="h-1.5 rounded-full bg-slate-200 transition-all duration-300"></div>
                            <div id="bar-3" class="h-1.5 rounded-full bg-slate-200 transition-all duration-300"></div>
                            <div id="bar-4" class="h-1.5 rounded-full bg-slate-200 transition-all duration-300"></div>
                        </div>

                        <!-- Real-time Verification Criteria -->
                        <div class="pt-1.5 grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px]">
                            <div id="rule-length" class="flex items-center gap-1.5 text-slate-400 transition-colors">
                                <span class="rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-[9px] font-bold">✕</span>
                                <span>Minimal 8 karakter</span>
                            </div>
                            <div id="rule-different" class="flex items-center gap-1.5 text-slate-400 transition-colors">
                                <span class="rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-[9px] font-bold">✕</span>
                                <span>Beda dari password lama</span>
                            </div>
                            <div id="rule-complex" class="flex items-center gap-1.5 text-slate-400 transition-colors">
                                <span class="rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-[9px] font-bold">✕</span>
                                <span>Huruf besar & angka</span>
                            </div>
                            <div id="rule-symbol" class="flex items-center gap-1.5 text-slate-400 transition-colors">
                                <span class="rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-[9px] font-bold">✕</span>
                                <span>Simbol khusus (opsional)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Field 3: Confirm New Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700 mb-1.5">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               required
                               autocomplete="new-password"
                               placeholder="Ulangi password baru Anda"
                               class="w-full h-11 pl-4 pr-12 rounded-xl border border-slate-200 bg-slate-50/40 hover:bg-white focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-sm font-medium text-slate-800 placeholder:text-slate-400">
                        
                        <button type="button" 
                                onclick="togglePasswordVisibility('password_confirmation', 'password_confirmation_icon')" 
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 p-1.5 rounded-lg hover:bg-slate-100 transition-colors focus:outline-none"
                                title="Tampilkan / Sembunyikan Password">
                            <svg id="password_confirmation_icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Match indicator pill -->
                    <div id="match-status" class="mt-2 text-xs font-semibold hidden items-center gap-1.5 transition-all">
                        <span id="match-icon" class="w-4 h-4 rounded-full flex items-center justify-center text-[10px] text-white"></span>
                        <span id="match-text"></span>
                    </div>
                </div>

                <!-- Action Button Row -->
                <div class="pt-3 flex flex-col-reverse sm:flex-row items-center gap-3">
                    <button type="reset" 
                            onclick="resetFormUI()"
                            class="w-full sm:w-auto px-5 py-3 rounded-xl border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-semibold text-xs transition-colors cursor-pointer text-center">
                        Reset Formulir
                    </button>

                    <button type="submit" 
                            id="submitBtn"
                            class="w-full sm:flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold text-sm px-6 py-3 rounded-xl shadow-md shadow-amber-500/20 hover:shadow-lg transition-all transform hover:-translate-y-0.5 cursor-pointer">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Simpan Password Baru</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Column: Security Insights & Standards (5 Cols on desktop/tablet) -->
        <div class="md:col-span-5 space-y-5">
            
            <!-- Standard Security Checklist Card -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
                <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-sm text-slate-800">Panduan Keamanan Akun</h4>
                        <p class="text-[11px] text-slate-400">Standar proteksi portal manajemen</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-slate-800">Kombinasi Karakter Kuat</h5>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">
                                Gabungkan huruf kapital, huruf kecil, angka, dan simbol (seperti <code class="bg-slate-100 text-slate-700 px-1 py-0.5 rounded font-mono text-[10px]"># $ ! @</code>) untuk meminimalisir risiko tebakan.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-slate-800">Privasi & Kerahasiaan</h5>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">
                                Hindari menggunakan tanggal lahir, nama pribadi, atau kata umum yang mudah ditebak dari informasi sosial media.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-slate-800">Jangan Bagikan Kredensial</h5>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">
                                Hak akses admin memberikan wewenang penuh atas konten dan dokumentasi website. Jaga kerahasiaannya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Policy Card with Solid High-Contrast Dark Slate Background -->
            <div class="rounded-2xl p-6 text-white border border-slate-800 shadow-sm relative overflow-hidden" style="background-color: #0f172a;">
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-8 h-8 rounded-xl bg-amber-500/20 text-amber-400 border border-amber-500/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <h5 class="text-sm font-bold tracking-tight text-white">Informasi Sesi Login</h5>
                </div>

                <p class="text-xs text-slate-300 leading-relaxed">
                    Setelah berhasil menyimpan password baru, sesi Anda saat ini akan tetap aktif. Namun pada saat Anda login ulang atau membuka dari browser lain, Anda wajib menggunakan password baru tersebut.
                </p>

                <div class="mt-4 pt-3.5 border-t border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
                    <span class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        Enkripsi Bcrypt Aktif
                    </span>
                    <span class="font-mono text-[10px] text-slate-400">SHA-256 / Hash</span>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Interactive Client-side Scripting -->
<script>
    // Toggle show / hide password
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            // Show eye-off icon
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
            `;
        } else {
            input.type = 'password';
            // Show standard eye icon
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            `;
        }
    }

    // Dynamic real-time password strength meter and verification rules
    const curPass = document.getElementById('current_password');
    const newPass = document.getElementById('password');
    const confPass = document.getElementById('password_confirmation');

    const strengthLabel = document.getElementById('strength-label');
    const bar1 = document.getElementById('bar-1');
    const bar2 = document.getElementById('bar-2');
    const bar3 = document.getElementById('bar-3');
    const bar4 = document.getElementById('bar-4');

    const ruleLength = document.getElementById('rule-length');
    const ruleDiff = document.getElementById('rule-different');
    const ruleComplex = document.getElementById('rule-complex');
    const ruleSymbol = document.getElementById('rule-symbol');

    const matchStatus = document.getElementById('match-status');
    const matchIcon = document.getElementById('match-icon');
    const matchText = document.getElementById('match-text');

    function updateRule(element, isValid) {
        const icon = element.querySelector('.rule-icon');
        if (isValid) {
            element.classList.remove('text-slate-400');
            element.classList.add('text-emerald-700', 'font-semibold');
            if (icon) {
                icon.textContent = '✓';
                icon.className = 'rule-icon w-3.5 h-3.5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[9px] font-bold';
            }
        } else {
            element.classList.remove('text-emerald-700', 'font-semibold');
            element.classList.add('text-slate-400');
            if (icon) {
                icon.textContent = '✕';
                icon.className = 'rule-icon w-3.5 h-3.5 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-[9px] font-bold';
            }
        }
    }

    function evaluatePassword() {
        const curVal = curPass.value;
        const val = newPass.value;

        // Reset bars
        const bars = [bar1, bar2, bar3, bar4];
        bars.forEach(b => {
            b.className = 'h-1.5 rounded-full bg-slate-200 transition-all duration-300';
        });

        if (!val) {
            strengthLabel.textContent = 'Belum diisi';
            strengthLabel.className = 'font-bold text-slate-400';
            updateRule(ruleLength, false);
            updateRule(ruleDiff, false);
            updateRule(ruleComplex, false);
            updateRule(ruleSymbol, false);
            evaluateMatch();
            return;
        }

        // Rules check
        const hasLength = val.length >= 8;
        const isDifferent = (curVal.length > 0 && val !== curVal);
        const hasUpperAndNum = /[A-Z]/.test(val) && /[0-9]/.test(val);
        const hasSymbol = /[^A-Za-z0-9]/.test(val);

        updateRule(ruleLength, hasLength);
        updateRule(ruleDiff, isDifferent);
        updateRule(ruleComplex, hasUpperAndNum);
        updateRule(ruleSymbol, hasSymbol);

        // Calculate score (0 to 4)
        let score = 0;
        if (hasLength) score++;
        if (val.length >= 10) score += 0.5;
        if (hasUpperAndNum) score++;
        if (hasSymbol) score++;
        if (isDifferent) score += 0.5;

        const finalScore = Math.min(4, Math.floor(score));

        if (finalScore <= 1) {
            strengthLabel.textContent = 'Lemah';
            strengthLabel.className = 'font-bold text-rose-500';
            bar1.className = 'h-1.5 rounded-full bg-rose-500 transition-all duration-300';
        } else if (finalScore === 2) {
            strengthLabel.textContent = 'Cukup';
            strengthLabel.className = 'font-bold text-amber-500';
            bar1.className = 'h-1.5 rounded-full bg-amber-500 transition-all duration-300';
            bar2.className = 'h-1.5 rounded-full bg-amber-500 transition-all duration-300';
        } else if (finalScore === 3) {
            strengthLabel.textContent = 'Kuat';
            strengthLabel.className = 'font-bold text-blue-500';
            bar1.className = 'h-1.5 rounded-full bg-blue-500 transition-all duration-300';
            bar2.className = 'h-1.5 rounded-full bg-blue-500 transition-all duration-300';
            bar3.className = 'h-1.5 rounded-full bg-blue-500 transition-all duration-300';
        } else {
            strengthLabel.textContent = 'Sangat Kuat';
            strengthLabel.className = 'font-bold text-emerald-600';
            bars.forEach(b => b.className = 'h-1.5 rounded-full bg-emerald-500 transition-all duration-300');
        }

        evaluateMatch();
    }

    function evaluateMatch() {
        const val = newPass.value;
        const confVal = confPass.value;

        if (!confVal) {
            matchStatus.classList.add('hidden');
            matchStatus.classList.remove('flex');
            return;
        }

        matchStatus.classList.remove('hidden');
        matchStatus.classList.add('flex');

        if (val === confVal && val.length > 0) {
            matchIcon.textContent = '✓';
            matchIcon.className = 'w-4 h-4 rounded-full flex items-center justify-center text-[10px] text-emerald-700 bg-emerald-100 font-bold';
            matchText.textContent = 'Konfirmasi password cocok';
            matchStatus.className = 'mt-2 text-xs font-semibold flex items-center gap-1.5 text-emerald-700';
        } else {
            matchIcon.textContent = '✕';
            matchIcon.className = 'w-4 h-4 rounded-full flex items-center justify-center text-[10px] text-rose-700 bg-rose-100 font-bold';
            matchText.textContent = 'Konfirmasi belum cocok dengan password baru';
            matchStatus.className = 'mt-2 text-xs font-semibold flex items-center gap-1.5 text-rose-600';
        }
    }

    function resetFormUI() {
        setTimeout(() => {
            evaluatePassword();
            matchStatus.classList.add('hidden');
            matchStatus.classList.remove('flex');
        }, 50);
    }

    newPass.addEventListener('input', evaluatePassword);
    curPass.addEventListener('input', evaluatePassword);
    confPass.addEventListener('input', evaluateMatch);
</script>
@endsection
