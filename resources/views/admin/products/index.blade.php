@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 md:p-8 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 mb-1">Daftar Produk</h2>
            <p class="text-sm text-slate-500">Etalase produk yang tampil pada halaman utama website.</p>
        </div>
        <a href="{{ route('admin.produk.create') }}" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-md transform hover:-translate-y-0.5 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Produk
        </a>
    </div>

    <!-- Search & Filter Section -->
    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
        <form action="{{ route('admin.produk.index') }}" method="GET">
            <div class="flex items-center bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden focus-within:ring-2 focus-within:ring-amber-500/20 focus-within:border-amber-400">

                {{-- Search Icon + Input --}}
                <div class="flex items-center flex-1 min-w-0 px-4 py-1">
                    <svg class="w-4 h-4 text-slate-400 flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari nama produk..."
                        class="flex-1 min-w-0 py-2.5 text-sm text-slate-800 placeholder-slate-400 bg-transparent outline-none border-none"
                    >
                    @if(request('q') || request('kategori'))
                        <a href="{{ route('admin.produk.index') }}" class="flex-shrink-0 ml-2 w-6 h-6 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-colors" title="Hapus filter">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    @endif
                </div>

                {{-- Divider --}}
                <div class="w-px h-8 bg-slate-200 flex-shrink-0"></div>

                {{-- Category Dropdown --}}
                <div class="flex-shrink-0">
                    <select
                        name="kategori"
                        class="h-full px-4 py-3 text-sm text-slate-700 bg-transparent border-none outline-none cursor-pointer appearance-none pr-8"
                        style="background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1rem;"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach($categories ?? \App\Models\Product::getCategories() as $cat)
                            <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Search Button --}}
                <button
                    type="submit"
                    class="flex-shrink-0 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-6 py-3.5 flex items-center gap-2 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Cari</span>
                </button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider">No</th>
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider">Gambar</th>
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider">Nama Produk</th>
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider">Kategori</th>
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($products as $product)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-6 text-slate-500">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6">
                        <div class="w-16 h-16 rounded-lg overflow-hidden border border-slate-200 bg-slate-100">
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="py-4 px-6 font-medium text-slate-900">{{ $product->nama_produk }}</td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                            {{ $product->kategori }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right space-x-2">
                        <a href="{{ route('admin.produk.edit', $product->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('admin.produk.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            <p class="text-lg font-medium text-slate-600">Belum ada data produk</p>
                            <p class="text-sm mt-1">Mulai tambahkan produk ke etalase Anda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
