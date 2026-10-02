@extends('layouts.admin')

@section('title', 'Foto Tentang Kami')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-xl font-bold text-slate-800">Foto Tentang Kami</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola foto slideshow pada section "Tentang Kami" di halaman utama.</p>
    </div>
    <a href="{{ route('admin.foto-tentang.create') }}"
       class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md hover:shadow-amber-500/30 transform hover:-translate-y-0.5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Foto
    </a>
</div>


@if($photos->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-16 text-center">
        <div class="w-20 h-20 bg-amber-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-amber-100">
            <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="text-lg font-semibold text-slate-600 mb-1">Belum ada foto</h3>
        <p class="text-slate-400 text-sm mb-5">Tambahkan foto untuk ditampilkan sebagai slideshow di halaman Tentang Kami.</p>
        <a href="{{ route('admin.foto-tentang.create') }}" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Foto Pertama
        </a>
    </div>
@else
    <!-- Info Banner -->
    <div class="mb-5 flex items-start gap-3 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl text-sm">
        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p>Foto diurutkan berdasarkan kolom <strong>Urutan</strong> (angka terkecil tampil pertama). Slideshow berganti otomatis setiap <strong>3 detik</strong>.</p>
    </div>

    <!-- Photo Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach($photos as $photo)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden group hover:shadow-md hover:border-amber-200 transition-all duration-200">
            <!-- Thumbnail -->
            <div class="relative h-52 overflow-hidden bg-slate-100">
                <img src="{{ asset('storage/' . $photo->gambar) }}"
                     alt="{{ $photo->judul ?? 'Foto #'.$photo->id }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <!-- Urutan Badge -->
                <div class="absolute top-2.5 left-2.5">
                    <span class="bg-amber-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">
                        #{{ $photo->urutan }}
                    </span>
                </div>
            </div>
            <!-- Info & Actions -->
            <div class="p-4">
                <p class="text-sm font-semibold text-slate-800 truncate mb-3">
                    {{ $photo->judul ?: '(Tanpa judul)' }}
                </p>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.foto-tentang.edit', $photo->id) }}"
                       class="flex-1 flex items-center justify-center gap-1.5 bg-slate-100 hover:bg-amber-50 hover:text-amber-600 text-slate-600 px-3 py-2 rounded-lg text-xs font-semibold transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.foto-tentang.destroy', $photo->id) }}" method="POST"
                          onsubmit="return confirm('Hapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="flex items-center justify-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-500 px-3 py-2 rounded-lg text-xs font-semibold transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
