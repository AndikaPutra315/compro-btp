@extends('layouts.admin')

@section('title', 'Buat Akun Admin Baru (Super Admin)')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.kelola-admin.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-amber-500 transition-colors font-medium text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Admin
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
        <div class="flex items-center gap-3 mb-6">
            <span class="w-2.5 h-6 bg-amber-500 rounded-full inline-block"></span>
            <div>
                <h2 class="text-lg font-bold text-slate-800">Buat Akun Admin Baru</h2>
                <p class="text-xs text-slate-500">Berikan akses manajemen sistem kepada staf atau administrator baru</p>
            </div>
        </div>

        <form action="{{ route('admin.kelola-admin.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Admin -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Lengkap Admin <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white"
                    placeholder="Contoh: Muhammad Rian">
                @error('name')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email / Username -->
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                    Email / Username Login <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white font-mono text-sm"
                    placeholder="Contoh: rian@borneotandayu.com">
                <p class="text-xs text-slate-400 mt-1.5">Email ini akan digunakan untuk login ke portal admin.</p>
                @error('email')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role Akses -->
            <div>
                <label for="role" class="block text-sm font-semibold text-slate-700 mb-2">
                    Tingkat Hak Akses / Role <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <label class="relative flex items-start gap-3 p-4 rounded-xl border border-slate-200 cursor-pointer hover:border-amber-400 transition-all has-checked:border-amber-500 has-checked:bg-amber-50/30">
                        <input type="radio" name="role" value="admin" class="mt-1 text-amber-500 focus:ring-amber-500" {{ old('role', 'admin') === 'admin' ? 'checked' : '' }}>
                        <div>
                            <span class="block text-sm font-bold text-slate-800">Admin Biasa</span>
                            <span class="block text-xs text-slate-500 mt-0.5">Dapat mengelola produk, kategori, dokumentasi, foto, dan klien.</span>
                        </div>
                    </label>
                    <label class="relative flex items-start gap-3 p-4 rounded-xl border border-slate-200 cursor-pointer hover:border-amber-400 transition-all has-checked:border-amber-500 has-checked:bg-amber-50/30">
                        <input type="radio" name="role" value="superadmin" class="mt-1 text-amber-500 focus:ring-amber-500" {{ old('role') === 'superadmin' ? 'checked' : '' }}>
                        <div>
                            <span class="block text-sm font-bold text-slate-800 flex items-center gap-1.5">
                                <span>Super Admin</span>
                                <span class="text-[9px] bg-amber-400/30 text-amber-800 px-1.5 py-0.2 rounded font-black">FULL</span>
                            </span>
                            <span class="block text-xs text-slate-500 mt-0.5">Akses penuh termasuk mengelola admin dan reset password pengguna lain.</span>
                        </div>
                    </label>
                </div>
                @error('role')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Fields -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" id="password" required minlength="6"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white"
                        placeholder="Minimal 6 karakter">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required minlength="6"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white"
                        placeholder="Ulangi password">
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.kelola-admin.index') }}" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md hover:shadow-amber-500/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Buat Akun Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
