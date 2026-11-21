@extends('layouts.admin')

@section('title', 'Tambah Anggota Organisasi')

@section('content')
<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('admin.organisasi.index') }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:text-slate-800 hover:border-slate-300 transition-all shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </a>
    <div>
        <h1 class="text-xl font-bold text-slate-800">Tambah Anggota Organisasi</h1>
        <p class="text-sm text-slate-500">Isi jabatan, nama, dan posisi dalam bagan.</p>
    </div>
</div>

<div class="max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
    <form action="{{ route('admin.organisasi.store') }}" method="POST">
        @csrf
        <div class="space-y-5">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan') }}" required maxlength="255"
                       placeholder="contoh: DIREKTUR"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all bg-white text-slate-800 @error('jabatan') border-red-400 @enderror">
                @error('jabatan')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" required maxlength="255"
                       placeholder="contoh: Yudhiani Mirdhatillah"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all bg-white text-slate-800 @error('nama') border-red-400 @enderror">
                @error('nama')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Atasan / Induk</label>
                <select name="parent_id"
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all bg-white text-slate-800 @error('parent_id') border-red-400 @enderror">
                    <option value="">— Tidak ada (posisi paling atas) —</option>
                    @foreach($parents as $p)
                        <option value="{{ $p->id }}" {{ old('parent_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->jabatan }} – {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Urutan Tampil <span class="text-red-500">*</span></label>
                <input type="number" name="urutan" value="{{ old('urutan', $nextUrutan) }}" required min="0"
                       class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all bg-white text-slate-800 @error('urutan') border-red-400 @enderror">
                <p class="mt-1 text-xs text-slate-400">Angka lebih kecil tampil lebih dulu (kiri).</p>
                @error('urutan')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

        </div>

        <div class="mt-8 flex items-center gap-3">
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md hover:shadow-amber-500/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan
            </button>
            <a href="{{ route('admin.organisasi.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-semibold transition-all">Batal</a>
        </div>
    </form>
</div>
@endsection
