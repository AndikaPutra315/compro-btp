@extends('layouts.admin')

@section('title', 'Kelola Klien')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-xl font-bold text-slate-800">Kelola Klien &amp; Mitra</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola logo dan nama perusahaan klien yang tampil pada running marquee website.</p>
    </div>
    <a href="{{ route('admin.klien.create') }}"
       class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md hover:shadow-amber-500/30 transform hover:-translate-y-0.5 whitespace-nowrap">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Klien
    </a>
</div>


<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Filter / Search Header -->
    <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-3 bg-slate-50/50">
        <form action="{{ route('admin.klien.index') }}" method="GET" class="w-full sm:w-80 relative">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama perusahaan..."
                   class="w-full pl-10 pr-4 py-2 text-sm rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all bg-white text-slate-800">
            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            @if(request('q'))
                <a href="{{ route('admin.klien.index') }}" class="absolute right-3 top-2.5 text-xs text-slate-400 hover:text-slate-600 bg-slate-100 hover:bg-slate-200 rounded px-1.5 py-0.5">Reset</a>
            @endif
        </form>
        <div class="text-xs text-slate-500 self-end sm:self-center">
            Total: <span class="font-bold text-slate-800">{{ $clients->count() }}</span> Klien
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <th class="py-3.5 px-6">Urutan</th>
                    <th class="py-3.5 px-6">Logo</th>
                    <th class="py-3.5 px-6">Nama Perusahaan</th>
                    <th class="py-3.5 px-6">Status Logo</th>
                    <th class="py-3.5 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($clients as $client)
                <tr class="hover:bg-slate-50/70 transition-colors">
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-700 font-bold text-xs border border-amber-200">
                            #{{ $client->urutan }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="w-16 h-12 rounded-xl bg-white border border-slate-200 p-1 flex items-center justify-center shadow-xs overflow-hidden">
                            <img src="{{ $client->logo_url }}" alt="{{ $client->nama_perusahaan }}" style="max-height: 40px; max-width: 56px; width: auto; height: auto; object-fit: contain;">
                        </div>
                    </td>
                    <td class="py-4 px-6 font-semibold text-slate-800">
                        {{ $client->nama_perusahaan }}
                    </td>
                    <td class="py-4 px-6">
                        @if($client->logo)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Logo Khusus
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                Placeholder
                            </span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="inline-flex items-center gap-1.5">
                            <a href="{{ route('admin.klien.edit', $client->id) }}"
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 transition-colors"
                               title="Edit Klien">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.klien.destroy', $client->id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus klien {{ $client->nama_perusahaan }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors"
                                        title="Hapus Klien">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500 mb-3 border border-amber-100">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <p class="text-base font-bold text-slate-700">Belum ada data klien</p>
                            <p class="text-xs text-slate-400 mt-1 mb-4">Tambahkan nama dan logo klien perusahaan Anda.</p>
                            <a href="{{ route('admin.klien.create') }}" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-xl text-xs font-semibold">
                                Tambah Klien Pertama
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
