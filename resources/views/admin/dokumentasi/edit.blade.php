@extends('layouts.admin')

@section('title', 'Edit Dokumentasi Proyek')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.dokumentasi.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-amber-500 transition-colors font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8 max-w-3xl">
    <form action="{{ route('admin.dokumentasi.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">Judul Pekerjaan / Proyek <span class="text-red-500">*</span></label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $document->judul) }}" required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white" 
                placeholder="Masukkan judul pekerjaan">
        </div>
        
        <div>
            <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">Kategori (Opsional)</label>
            <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $document->kategori) }}"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white" 
                placeholder="Contoh: Overhaul, Maintenance, Replacement">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Saat Ini</label>
            <div class="mb-4">
                <img src="{{ Str::startsWith($document->gambar, 'http') ? $document->gambar : asset('storage/' . $document->gambar) }}" alt="{{ $document->judul }}" class="h-44 w-auto rounded-lg border border-slate-200 shadow-sm object-cover">
            </div>

            <label for="gambar" class="block text-sm font-semibold text-slate-700 mb-2">Ganti Foto Dokumentasi (Opsional)</label>
            <!-- Drop Zone -->
            <div id="drop-zone"
                 class="mt-1 relative border-2 border-slate-300 border-dashed rounded-xl bg-slate-50 transition-all duration-200 cursor-pointer"
                 style="min-height: 180px;"
                 onclick="document.getElementById('gambar').click()">

                <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">

                <div id="upload-placeholder" class="flex flex-col items-center justify-center py-10 px-6 pointer-events-none">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-amber-600 mb-1">Klik untuk pilih foto baru</p>
                    <p class="text-xs text-slate-400">atau <span class="font-medium text-slate-500">drag &amp; drop</span> foto ke sini</p>
                    <p class="text-xs text-slate-400 mt-2">PNG, JPG, WEBP &bull; Maks. 5MB</p>
                </div>

                <div id="upload-preview" class="hidden relative w-full h-full pointer-events-none">
                    <img id="preview-img" src="" alt="Preview" class="w-full rounded-xl object-contain" style="max-height: 280px;">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900/70 to-transparent rounded-b-xl px-4 py-3 flex items-center justify-between">
                        <span id="preview-name" class="text-white text-xs font-semibold truncate max-w-[70%]"></span>
                        <span class="text-white text-xs bg-amber-500 rounded-full px-2 py-0.5">Klik untuk ganti</span>
                    </div>
                </div>

                <div id="drag-overlay" class="hidden absolute inset-0 rounded-xl bg-amber-500/10 border-2 border-amber-500 flex items-center justify-center pointer-events-none">
                    <div class="text-center">
                        <svg class="mx-auto w-10 h-10 text-amber-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="text-amber-600 font-bold text-sm">Lepaskan untuk upload!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex gap-4">
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-md transform hover:-translate-y-0.5 flex-1 md:flex-none">
                Update Dokumentasi
            </button>
            <a href="{{ route('admin.dokumentasi.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-8 py-3 rounded-xl font-bold transition-all text-center flex-1 md:flex-none">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
(function() {
    const dropZone    = document.getElementById('drop-zone');
    const fileInput   = document.getElementById('gambar');
    const placeholder = document.getElementById('upload-placeholder');
    const preview     = document.getElementById('upload-preview');
    const previewImg  = document.getElementById('preview-img');
    const previewName = document.getElementById('preview-name');
    const dragOverlay = document.getElementById('drag-overlay');

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
        if (e.target.files.length > 0) showPreview(e.target.files[0]);
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
            const dt = new DataTransfer();
            dt.items.add(files[0]);
            fileInput.files = dt.files;
            showPreview(files[0]);
        }
    });
})();
</script>
@endsection
