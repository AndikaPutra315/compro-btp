@extends('layouts.admin')

@section('title', 'Edit Klien')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.klien.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-amber-500 transition-colors font-medium text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Klien
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
        <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
            <span class="w-2.5 h-6 bg-amber-500 rounded-full inline-block"></span>
            Edit Klien: {{ $client->nama_perusahaan }}
        </h2>

        <form action="{{ route('admin.klien.update', $client->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Perusahaan -->
            <div>
                <label for="nama_perusahaan" class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Perusahaan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan', $client->nama_perusahaan) }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white">
                @error('nama_perusahaan')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Urutan -->
            <div>
                <label for="urutan" class="block text-sm font-semibold text-slate-700 mb-2">
                    Urutan Tampil <span class="text-red-500">*</span>
                </label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $client->urutan) }}" min="0" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white">
                <p class="text-xs text-slate-400 mt-1.5">Angka urutan tampilan klien pada animasi marquee halaman depan.</p>
                @error('urutan')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Logo Saat Ini & Upload Baru -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Logo Perusahaan</label>

                <!-- Current Logo Display -->
                <div class="mb-4 p-4 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-xl bg-white border border-slate-200 p-2 shadow-xs flex items-center justify-center overflow-hidden">
                            <img src="{{ $client->logo_url }}" alt="Logo {{ $client->nama_perusahaan }}" class="max-h-full max-w-full object-contain">
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-700">Logo Saat Ini:</p>
                            @if($client->logo)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mt-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Logo Kustom Tersimpan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-slate-200/80 text-slate-600 border border-slate-300 mt-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    Menggunakan Placeholder Bawaan
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($client->logo)
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-2 rounded-lg border border-red-200 transition-colors">
                            <input type="checkbox" name="hapus_logo" value="1" id="hapus_logo" class="rounded text-red-600 focus:ring-red-500">
                            <span>Hapus &amp; Reset ke Placeholder</span>
                        </label>
                    @endif
                </div>

                <!-- Dropzone for New Logo -->
                <div id="drop-zone"
                     class="relative border-2 border-slate-300 border-dashed rounded-xl bg-slate-50 transition-all duration-200 cursor-pointer hover:border-amber-400 hover:bg-amber-50/30"
                     style="min-height: 160px;"
                     onclick="document.getElementById('logo').click()">

                    <input id="logo" name="logo" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/svg+xml">

                    <div id="upload-placeholder" class="flex flex-col items-center justify-center py-8 px-6 pointer-events-none">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 flex items-center justify-center mb-2">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-amber-600 mb-0.5">Klik untuk mengganti logo</p>
                        <p class="text-xs text-slate-400">atau drag &amp; drop file logo baru ke sini</p>
                        <p class="text-[11px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah logo</p>
                    </div>

                    <div id="upload-preview" class="hidden relative w-full h-full p-4 flex flex-col items-center justify-center pointer-events-none">
                        <div class="p-3 bg-white rounded-xl shadow-xs border border-slate-200 max-h-32 max-w-xs flex items-center justify-center mb-2">
                            <img id="preview-img" src="" alt="Preview Logo Baru" class="max-h-24 max-w-full object-contain">
                        </div>
                        <div class="flex items-center gap-2">
                            <span id="preview-name" class="text-xs text-slate-700 font-semibold truncate max-w-[200px]"></span>
                            <span class="text-[11px] text-amber-600 bg-amber-100 rounded-full px-2.5 py-0.5 font-medium">Klik untuk ganti</span>
                        </div>
                    </div>

                    <div id="drag-overlay" class="hidden absolute inset-0 rounded-xl bg-amber-500/10 border-2 border-amber-500 flex items-center justify-center pointer-events-none">
                        <p class="text-amber-600 font-bold text-sm">Lepaskan logo ke sini!</p>
                    </div>
                </div>
                @error('logo')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex gap-4">
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-md transform hover:-translate-y-0.5 flex-1 sm:flex-none">
                    Perbarui Klien
                </button>
                <a href="{{ route('admin.klien.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-8 py-3 rounded-xl font-bold transition-all text-center flex-1 sm:flex-none">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
(function() {
    const dropZone      = document.getElementById('drop-zone');
    const fileInput     = document.getElementById('logo');
    const placeholder   = document.getElementById('upload-placeholder');
    const preview       = document.getElementById('upload-preview');
    const previewImg    = document.getElementById('preview-img');
    const previewName   = document.getElementById('preview-name');
    const dragOverlay   = document.getElementById('drag-overlay');
    const hapusLogoCb   = document.getElementById('hapus_logo');

    // Image preview helper
    function showPreview(file) {
        if (!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewName.textContent = file.name;
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            if (hapusLogoCb) hapusLogoCb.checked = false;
            showPreview(e.target.files[0]);
        } else {
            placeholder.classList.remove('hidden');
            preview.classList.add('hidden');
        }
    });

    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault(); e.stopPropagation();
        dragOverlay.classList.remove('hidden');
        dropZone.classList.add('border-amber-500', 'bg-amber-50');
    });
    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault(); e.stopPropagation();
        dragOverlay.classList.add('hidden');
        dropZone.classList.remove('border-amber-500', 'bg-amber-50');
    });
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault(); e.stopPropagation();
        dragOverlay.classList.add('hidden');
        dropZone.classList.remove('border-amber-500', 'bg-amber-50');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            if (hapusLogoCb) hapusLogoCb.checked = false;
            const dt = new DataTransfer();
            dt.items.add(files[0]);
            fileInput.files = dt.files;
            showPreview(files[0]);
        }
    });
})();
</script>
@endsection
