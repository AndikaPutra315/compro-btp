@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-amber-500 transition-colors font-medium text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Kategori
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
        <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
            <span class="w-2.5 h-6 bg-amber-500 rounded-full inline-block"></span>
            Tambah Kategori Baru
        </h2>

        <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Kategori -->
            <div>
                <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white"
                    placeholder="Contoh: Pipa & Valve, Safety Equipment, dll">
                <p class="text-xs text-slate-400 mt-1.5">Nama kategori produk yang akan tampil pada pilihan admin dan katalog public website.</p>
                @error('nama')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Urutan Tampil -->
            <div>
                <label for="urutan" class="block text-sm font-semibold text-slate-700 mb-2">
                    Urutan Tampil <span class="text-red-500">*</span>
                </label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $nextUrutan) }}" min="0" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white">
                <p class="text-xs text-slate-400 mt-1.5">Nomor urut susunan kategori pada filter katalog produk (1, 2, 3, dst).</p>
                @error('urutan')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-2">
                    Deskripsi / Catatan <span class="text-slate-400 font-normal">(Opsional)</span>
                </label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white resize-y"
                    placeholder="Keterangan singkat tentang lingkup produk dalam kategori ini">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.kategori.index') }}" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md hover:shadow-amber-500/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
