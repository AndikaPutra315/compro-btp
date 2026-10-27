<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where('nama_produk', 'like', "%{$search}%");
        }

        if ($request->filled('kategori') && $request->input('kategori') !== 'all') {
            $query->where('kategori', $request->input('kategori'));
        }

        $products = $query->latest()->get();
        $categories = Product::getCategories();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Product::getCategories();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => ['required', 'string', Rule::in(Product::getCategories())],
            'gambar'      => ['required', 'file', 'max:20480', $this->validateImageFile('Foto Utama')],
            'gambar_2'    => ['nullable', 'file', 'max:20480', $this->validateImageFile('Foto Kedua')],
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'kategori.required'    => 'Kategori produk wajib dipilih.',
            'kategori.in'          => 'Kategori produk tidak valid.',
            'gambar.required'      => 'Foto utama produk wajib diunggah.',
            'gambar.file'          => 'Foto utama harus berupa file yang valid.',
            'gambar.max'           => 'Ukuran foto utama maksimal 20MB.',
            'gambar_2.file'        => 'Foto kedua harus berupa file yang valid.',
            'gambar_2.max'         => 'Ukuran foto kedua maksimal 20MB.',
        ]);

        $imagePath = $request->file('gambar')->store('produk', 'public');
        $imagePath2 = $request->hasFile('gambar_2') 
            ? $request->file('gambar_2')->store('produk', 'public') 
            : null;

        Product::create([
            'nama_produk' => $request->nama_produk,
            'kategori'    => $request->kategori,
            'gambar'      => $imagePath,
            'gambar_2'    => $imagePath2,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        // Not used
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Product::getCategories();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => ['required', 'string', Rule::in(Product::getCategories())],
            'gambar'      => ['nullable', 'file', 'max:20480', $this->validateImageFile('Foto Utama')],
            'gambar_2'    => ['nullable', 'file', 'max:20480', $this->validateImageFile('Foto Kedua')],
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'kategori.required'    => 'Kategori produk wajib dipilih.',
            'kategori.in'          => 'Kategori produk tidak valid.',
            'gambar.file'          => 'Foto utama harus berupa file yang valid.',
            'gambar.max'           => 'Ukuran foto utama maksimal 20MB.',
            'gambar_2.file'        => 'Foto kedua harus berupa file yang valid.',
            'gambar_2.max'         => 'Ukuran foto kedua maksimal 20MB.',
        ]);

        $data = [
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
        ];

        // Foto Utama
        if ($request->hasFile('gambar')) {
            if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
                Storage::disk('public')->delete($product->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        // Foto Kedua
        if ($request->boolean('hapus_gambar_2')) {
            if ($product->gambar_2 && Storage::disk('public')->exists($product->gambar_2)) {
                Storage::disk('public')->delete($product->gambar_2);
            }
            $data['gambar_2'] = null;
        } elseif ($request->hasFile('gambar_2')) {
            if ($product->gambar_2 && Storage::disk('public')->exists($product->gambar_2)) {
                Storage::disk('public')->delete($product->gambar_2);
            }
            $data['gambar_2'] = $request->file('gambar_2')->store('produk', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
            Storage::disk('public')->delete($product->gambar);
        }

        if ($product->gambar_2 && Storage::disk('public')->exists($product->gambar_2)) {
            Storage::disk('public')->delete($product->gambar_2);
        }
        
        $product->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Helper validation rule to reliably validate images across Windows/Linux/Browsers.
     * Supports standard JPEG/JPG, PNG, WEBP, GIF, BMP, JFIF regardless of how MIME was reported.
     */
    private function validateImageFile(string $label): \Closure
    {
        return function ($attribute, $value, $fail) use ($label) {
            if (!$value instanceof \Illuminate\Http\UploadedFile) {
                return;
            }

            if (!$value->isValid()) {
                $fail("Berkas {$label} gagal diunggah (error code: " . $value->getError() . ").");
                return;
            }

            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'jfif', 'pjpeg', 'pjp'];
            $ext = strtolower($value->getClientOriginalExtension());
            $mime = strtolower($value->getMimeType() ?? '');

            $isImageExt = in_array($ext, $allowed);
            $isImageMime = str_starts_with($mime, 'image/');

            if (!$isImageExt && !$isImageMime) {
                $fail("Berkas {$label} harus berformat gambar yang valid (JPG, JPEG, PNG, WEBP, GIF).");
            }
        };
    }
}
