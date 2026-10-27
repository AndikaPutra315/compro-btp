@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-xl font-bold text-slate-800">Kelola Kategori Produk</h1>
        <p class="text-sm text-slate-500 mt-0.5">Tambah, ubah, dan kelola kategori untuk pengelompokan produk pada katalog website.</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" 
       class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md hover:shadow-amber-500/30 transform hover:-translate-y-0.5 whitespace-nowrap">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Kategori
    </a>
</div>

<!-- Category Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Kategori</p>
            <h3 class="text-2xl font-extrabold text-slate-800 mt-1">{{ $categories->count() }}</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kategori aktif dalam katalog</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        </div>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Produk</p>
            <h3 class="text-2xl font-extrabold text-slate-800 mt-1">{{ $totalProducts }}</h3>
            <p class="text-xs text-slate-500 mt-0.5">Produk tersebar di berbagai kategori</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Filter / Search Header -->
    <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-3 bg-slate-50/50">
        <form action="{{ route('admin.kategori.index') }}" method="GET" class="w-full sm:w-80 relative">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama kategori..."
                   class="w-full pl-10 pr-12 py-2 text-sm rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all bg-white text-slate-800">
            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            @if(request('q'))
                <a href="{{ route('admin.kategori.index') }}" class="absolute right-3 top-2.5 text-xs text-slate-400 hover:text-slate-600 bg-slate-100 hover:bg-slate-200 rounded px-1.5 py-0.5">Reset</a>
            @endif
        </form>
        <div class="text-xs text-slate-500 self-end sm:self-center">
            Menampilkan: <span class="font-bold text-slate-800">{{ $categories->count() }}</span> Kategori
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <th class="py-3.5 px-6 w-20">Urutan</th>
                    <th class="py-3.5 px-6">Nama Kategori</th>
                    <th class="py-3.5 px-6">Slug URL</th>
                    <th class="py-3.5 px-6">Jumlah Produk</th>
                    <th class="py-3.5 px-6">Deskripsi</th>
                    <th class="py-3.5 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($categories as $category)
                <tr class="hover:bg-slate-50/70 transition-colors">
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-700 font-bold text-xs border border-amber-200">
                            #{{ $category->urutan }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="font-bold text-slate-800 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            {{ $category->nama }}
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-block font-mono text-xs text-slate-500 bg-slate-100 px-2 py-0.5 rounded border border-slate-200/80">
                            {{ $category->slug }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <a href="{{ route('admin.produk.index', ['kategori' => $category->nama]) }}"
                           title="Lihat produk kategori ini"
                           class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $category->products_count > 0 ? 'bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100' : 'bg-slate-100 text-slate-500 border border-slate-200 hover:bg-slate-200' }} transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            <span>{{ $category->products_count }} Produk</span>
                        </a>
                    </td>
                    <td class="py-4 px-6 text-slate-500 text-xs max-w-xs truncate">
                        {{ $category->deskripsi ?: '-' }}
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="inline-flex items-center gap-1.5">
                            <a href="{{ route('admin.kategori.edit', $category->id) }}" 
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 transition-colors"
                               title="Edit Kategori">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            
                            @if($category->products_count > 0)
                                <button type="button" 
                                        onclick="alert('Kategori \'{{ addslashes($category->nama) }}\' tidak dapat dihapus karena masih digunakan oleh {{ $category->products_count }} produk. Silakan ubah atau hapus produk terkait terlebih dahulu.')"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed opacity-60"
                                        title="Kategori sedang digunakan oleh {{ $category->products_count }} produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            @else
                                <form action="{{ route('admin.kategori.destroy', $category->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori \'{{ addslashes($category->nama) }}\'?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors"
                                            title="Hapus Kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500 mb-3 border border-amber-100">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </div>
                            <p class="font-semibold text-slate-700">Tidak ada kategori ditemukan</p>
                            <p class="text-xs text-slate-400 mt-1">
                                @if(request('q'))
                                    Tidak ada hasil untuk pencarian "{{ request('q') }}".
                                @else
                                    Belum ada kategori yang ditambahkan. Silakan klik tombol di atas.
                                @endif
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
