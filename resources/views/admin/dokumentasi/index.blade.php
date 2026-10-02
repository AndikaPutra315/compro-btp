@extends('layouts.admin')

@section('title', 'Dokumentasi Proyek')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 md:p-8 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 mb-1">Daftar Dokumentasi Proyek</h2>
            <p class="text-sm text-slate-500">Kelola foto dan judul dokumentasi pekerjaan proyek yang tampil pada website.</p>
        </div>
        <a href="{{ route('admin.dokumentasi.create') }}" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-md transform hover:-translate-y-0.5 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Dokumentasi
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider">No</th>
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider">Foto Proyek</th>
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider">Judul Pekerjaan</th>
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider">Kategori</th>
                    <th class="py-4 px-6 font-semibold text-slate-600 text-sm uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($documents as $doc)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-6 text-slate-500">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6">
                        <div class="w-20 h-14 rounded-lg overflow-hidden border border-slate-200 bg-slate-100">
                            <img src="{{ Str::startsWith($doc->gambar, 'http') ? $doc->gambar : asset('storage/' . $doc->gambar) }}" alt="{{ $doc->judul }}" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="py-4 px-6 font-medium text-slate-900 max-w-xs uppercase tracking-wide text-sm">{{ $doc->judul }}</td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                            {{ $doc->kategori ?? 'Dokumentasi' }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right space-x-2">
                        <a href="{{ route('admin.dokumentasi.edit', $doc->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('admin.dokumentasi.destroy', $doc->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumentasi ini?');">
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
                            <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-lg font-medium text-slate-600">Belum ada dokumentasi proyek</p>
                            <p class="text-sm mt-1">Mulai tambahkan foto kegiatan proyek perusahaan Anda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
