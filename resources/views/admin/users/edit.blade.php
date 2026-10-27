@extends('layouts.admin')

@section('title', 'Edit Data Admin: ' . $admin->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.kelola-admin.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-amber-500 transition-colors font-medium text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Admin
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <span class="w-2.5 h-6 bg-amber-500 rounded-full inline-block"></span>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Edit Profil Admin</h2>
                    <p class="text-xs text-slate-500">Perbarui informasi akun dan hak akses administrator</p>
                </div>
            </div>
            <span class="text-xs font-mono bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg border border-slate-200">
                ID: #{{ $admin->id }}
            </span>
        </div>

        <form action="{{ route('admin.kelola-admin.update', $admin->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Admin -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Lengkap Admin <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white">
                @error('name')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email / Username -->
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                    Email / Username Login <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white font-mono text-sm">
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
                        <input type="radio" name="role" value="admin" class="mt-1 text-amber-500 focus:ring-amber-500" {{ old('role', $admin->role) === 'admin' ? 'checked' : '' }}>
                        <div>
                            <span class="block text-sm font-bold text-slate-800">Admin Biasa</span>
                            <span class="block text-xs text-slate-500 mt-0.5">Kelola produk, dokumentasi, foto, dan klien.</span>
                        </div>
                    </label>
                    <label class="relative flex items-start gap-3 p-4 rounded-xl border border-slate-200 cursor-pointer hover:border-amber-400 transition-all has-checked:border-amber-500 has-checked:bg-amber-50/30">
                        <input type="radio" name="role" value="superadmin" class="mt-1 text-amber-500 focus:ring-amber-500" {{ old('role', $admin->role) === 'superadmin' ? 'checked' : '' }}>
                        <div>
                            <span class="block text-sm font-bold text-slate-800 flex items-center gap-1.5">
                                <span>Super Admin</span>
                                <span class="text-[9px] bg-amber-400/30 text-amber-800 px-1.5 py-0.2 rounded font-black">FULL</span>
                            </span>
                            <span class="block text-xs text-slate-500 mt-0.5">Akses penuh termasuk membuat &amp; reset password admin.</span>
                        </div>
                    </label>
                </div>
                @error('role')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan Password Info -->
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200/80 flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div class="text-xs text-slate-600">
                    <p class="font-bold text-slate-800">Ingin Mengubah Password Admin Ini?</p>
                    <p class="mt-0.5">Gunakan tombol <strong>Reset PW</strong> langsung pada daftar tabel admin di halaman sebelumnya.</p>
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
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
