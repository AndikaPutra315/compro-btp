@extends('layouts.admin')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-xl font-bold text-slate-800">Struktur Organisasi</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola jabatan dan nama anggota yang tampil pada halaman Struktur Organisasi.</p>
    </div>
    <a href="{{ route('admin.organisasi.create') }}"
       class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md hover:shadow-amber-500/30 transform hover:-translate-y-0.5 whitespace-nowrap">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Anggota
    </a>
</div>

{{-- Tree Preview --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6 overflow-x-auto">
    <h2 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-5">Pratinjau Bagan</h2>
    @if($roots->isEmpty())
        <p class="text-slate-400 text-sm text-center py-6">Belum ada data. Tambah anggota pertama.</p>
    @else
        <div class="org-tree-wrap">
            @include('admin.organization._tree', ['nodes' => $roots])
        </div>
    @endif
</div>

{{-- Flat Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
        <span class="text-sm font-semibold text-slate-700">Daftar Semua Anggota</span>
        <span class="text-xs text-slate-500">Total: <span class="font-bold text-slate-800">{{ $members->count() }}</span></span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <th class="py-3.5 px-6">Urutan</th>
                    <th class="py-3.5 px-6">Jabatan</th>
                    <th class="py-3.5 px-6">Nama</th>
                    <th class="py-3.5 px-6">Atasan</th>
                    <th class="py-3.5 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($members as $m)
                <tr class="hover:bg-slate-50/70 transition-colors">
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-700 font-bold text-xs border border-amber-200">#{{ $m->urutan }}</span>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-900 text-white text-xs font-bold tracking-wide">{{ $m->jabatan }}</span>
                    </td>
                    <td class="py-4 px-6 font-semibold text-slate-800">{{ $m->nama }}</td>
                    <td class="py-4 px-6 text-slate-500 text-xs">
                        @if($m->parent)
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                {{ $m->parent->jabatan }} – {{ $m->parent->nama }}
                            </span>
                        @else
                            <span class="text-slate-300">—</span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="inline-flex items-center gap-1.5">
                            <a href="{{ route('admin.organisasi.edit', $m->id) }}"
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.organisasi.destroy', $m->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus {{ $m->nama }}? Anak-anaknya akan dipindah ke atasan mereka.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors" title="Hapus">
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
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <p class="text-base font-bold text-slate-700">Belum ada data</p>
                            <p class="text-xs text-slate-400 mt-1 mb-4">Tambahkan anggota pertama pada struktur organisasi.</p>
                            <a href="{{ route('admin.organisasi.create') }}" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-xl text-xs font-semibold">
                                Tambah Sekarang
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
/* ---- Org tree bagan ---- */
.org-tree-wrap { text-align: center; }
.org-tree ul {
    display: flex;
    justify-content: center;
    gap: 12px;
    padding-top: 20px;
    position: relative;
    flex-wrap: wrap;
}
.org-tree ul::before {
    content: '';
    position: absolute;
    top: 0; left: 50%;
    border-left: 2px solid #CBD5E1;
    height: 20px;
    transform: translateX(-50%);
}
.org-tree li {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    padding-top: 20px;
    list-style: none;
}
.org-tree li::before {
    content: '';
    position: absolute;
    top: 0; left: 50%;
    border-left: 2px solid #CBD5E1;
    height: 20px;
    transform: translateX(-50%);
}
/* horizontal connector across siblings */
.org-tree li:not(:only-child)::after {
    content: '';
    position: absolute;
    top: 0;
    border-top: 2px solid #CBD5E1;
    width: 50%;
}
.org-tree li:not(:only-child):first-child::after { left: 50%; }
.org-tree li:not(:only-child):last-child::after  { left: 0; width: 50%; }
.org-tree li:not(:only-child):not(:first-child):not(:last-child)::after { left: 0; width: 100%; }

.org-node {
    background: #1E293B;
    color: #fff;
    border-radius: 10px;
    padding: 8px 14px;
    min-width: 110px;
    max-width: 160px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
}
.org-node .node-title { font-size: 10px; font-weight: 800; letter-spacing: .05em; text-transform: uppercase; color: #94A3B8; }
.org-node .node-name  { font-size: 11px; font-weight: 600; color: #fff; margin-top: 2px; }
</style>
@endsection
