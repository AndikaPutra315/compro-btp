@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.produk.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-amber-500 transition-colors font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8 max-w-3xl">
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div>
            <label for="nama_produk" class="block text-sm font-semibold text-slate-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
            <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}" required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white" 
                placeholder="Masukkan nama produk">
        </div>
        
        <div>
            <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">Kategori <span class="text-red-500">*</span></label>
            <select name="kategori" id="kategori" required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-slate-800 bg-slate-50 focus:bg-white appearance-none">
                <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih Kategori</option>
                @foreach($categories ?? \App\Models\Product::getCategories() as $cat)
                    <option value="{{ $cat }}" {{ old('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Foto Utama -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Foto Utama Produk <span class="text-red-500">*</span>
                </label>
                <!-- Drop Zone 1 as Native Label -->
                <label for="gambar" id="drop-zone-1"
                       class="relative block border-2 border-slate-300 border-dashed rounded-xl bg-slate-50 hover:border-amber-400 hover:bg-amber-50/20 transition-all duration-200 cursor-pointer overflow-hidden"
                       style="min-height: 180px;">

                    <input id="gambar" name="gambar" type="file" class="sr-only" required accept="image/*,.jpg,.jpeg,.png,.webp,.gif,.bmp,.jfif">

                    <!-- Default state -->
                    <div id="upload-placeholder-1" class="flex flex-col items-center justify-center py-8 px-4 pointer-events-none text-center">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-amber-600 mb-1">Klik untuk Pilih Foto Utama</p>
                        <p class="text-[11px] text-slate-400">JPG, JPEG, PNG, WEBP &bull; Maks. 20MB</p>
                    </div>

                    <!-- Preview state -->
                    <div id="upload-preview-1" class="hidden relative w-full h-full min-h-[180px] pointer-events-none">
                        <img id="preview-img-1" src="" alt="Preview 1" class="w-full h-44 rounded-xl object-contain bg-slate-100">
                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-slate-900/80 to-transparent p-2.5 flex items-center justify-between">
                            <span id="preview-name-1" class="text-white text-xs font-semibold truncate max-w-[70%]"></span>
                            <span class="text-white text-[10px] bg-amber-500 rounded-full px-2 py-0.5">Ganti Foto</span>
                        </div>
                    </div>

                    <!-- Drag overlay -->
                    <div id="drag-overlay-1" class="hidden absolute inset-0 rounded-xl bg-amber-500/10 border-2 border-amber-500 flex items-center justify-center pointer-events-none">
                        <p class="text-amber-600 font-bold text-xs">Lepaskan untuk upload!</p>
                    </div>
                </label>
                @error('gambar')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- Foto Kedua / Tambahan -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-semibold text-slate-700">Foto Kedua / Tambahan</label>
                    <span class="text-[11px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-medium">Opsional</span>
                </div>
                <!-- Drop Zone 2 as Native Label -->
                <label for="gambar_2" id="drop-zone-2"
                       class="relative block border-2 border-slate-300 border-dashed rounded-xl bg-slate-50 hover:border-amber-400 hover:bg-amber-50/20 transition-all duration-200 cursor-pointer overflow-hidden"
                       style="min-height: 180px;">

                    <input id="gambar_2" name="gambar_2" type="file" class="sr-only" accept="image/*,.jpg,.jpeg,.png,.webp,.gif,.bmp,.jfif">

                    <!-- Default state -->
                    <div id="upload-placeholder-2" class="flex flex-col items-center justify-center py-8 px-4 pointer-events-none text-center">
                        <div class="w-12 h-12 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-slate-600 mb-1">Tambah Foto Kedua</p>
                        <p class="text-[11px] text-slate-400">Untuk multi-foto di popup lightbox (Maks. 20MB)</p>
                    </div>

                    <!-- Preview state -->
                    <div id="upload-preview-2" class="hidden relative w-full h-full min-h-[180px] pointer-events-none">
                        <img id="preview-img-2" src="" alt="Preview 2" class="w-full h-44 rounded-xl object-contain bg-slate-100">
                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-slate-900/80 to-transparent p-2.5 flex items-center justify-between">
                            <span id="preview-name-2" class="text-white text-xs font-semibold truncate max-w-[70%]"></span>
                            <span class="text-white text-[10px] bg-slate-700 rounded-full px-2 py-0.5">Ganti Foto</span>
                        </div>
                    </div>

                    <!-- Drag overlay -->
                    <div id="drag-overlay-2" class="hidden absolute inset-0 rounded-xl bg-amber-500/10 border-2 border-amber-500 flex items-center justify-center pointer-events-none">
                        <p class="text-amber-600 font-bold text-xs">Lepaskan untuk upload!</p>
                    </div>
                </label>
                @error('gambar_2')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex gap-4">
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-md transform hover:-translate-y-0.5 flex-1 md:flex-none">
                Simpan Produk
            </button>
            <a href="{{ route('admin.produk.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-8 py-3 rounded-xl font-bold transition-all text-center flex-1 md:flex-none">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
(function() {
    function setupDropzone(zoneId, inputId, placeholderId, previewId, imgId, nameId, overlayId) {
        const dropZone    = document.getElementById(zoneId);
        const fileInput   = document.getElementById(inputId);
        const placeholder = document.getElementById(placeholderId);
        const preview     = document.getElementById(previewId);
        const previewImg  = document.getElementById(imgId);
        const previewName = document.getElementById(nameId);
        const dragOverlay = document.getElementById(overlayId);

        if (!dropZone || !fileInput) return;

        function showPreview(file) {
            if (!file) return;
            const isImage = (file.type && file.type.startsWith('image/')) || /\.(jpe?g|png|webp|gif|bmp|jfif)$/i.test(file.name);
            if (!isImage) return;

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
            if (e.target.files && e.target.files.length > 0) {
                showPreview(e.target.files[0]);
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
            if (files && files.length > 0) {
                try {
                    const dt = new DataTransfer();
                    dt.items.add(files[0]);
                    fileInput.files = dt.files;
                } catch (err) {
                    fileInput.files = files;
                }
                showPreview(files[0]);
            }
        });
    }

    setupDropzone('drop-zone-1', 'gambar', 'upload-placeholder-1', 'upload-preview-1', 'preview-img-1', 'preview-name-1', 'drag-overlay-1');
    setupDropzone('drop-zone-2', 'gambar_2', 'upload-placeholder-2', 'upload-preview-2', 'preview-img-2', 'preview-name-2', 'drag-overlay-2');
})();
</script>
@endsection
