<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(Request $request)
    {
        $query = Category::query()->withCount('products');

        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $categories = $query->orderBy('urutan')->orderBy('nama')->get();
        $totalProducts = Product::count();

        return view('admin.categories.index', compact('categories', 'totalProducts'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $nextUrutan = (Category::max('urutan') ?? 0) + 1;
        return view('admin.categories.create', compact('nextUrutan'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:100|unique:categories,nama',
            'deskripsi' => 'nullable|string|max:500',
            'urutan'    => 'required|integer|min:0',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique'   => 'Nama kategori sudah terdaftar.',
            'nama.max'      => 'Nama kategori maksimal 100 karakter.',
            'urutan.required' => 'Urutan tampil wajib diisi.',
            'urutan.integer'  => 'Urutan harus berupa angka.',
            'urutan.min'      => 'Urutan minimal 0.',
        ]);

        Category::create([
            'nama'      => trim($request->nama),
            'deskripsi' => $request->deskripsi ? trim($request->deskripsi) : null,
            'urutan'    => $request->urutan,
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.kategori.edit', $id);
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(string $id)
    {
        $category = Category::withCount('products')->findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nama'      => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories', 'nama')->ignore($category->id),
            ],
            'deskripsi' => 'nullable|string|max:500',
            'urutan'    => 'required|integer|min:0',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique'   => 'Nama kategori sudah digunakan oleh kategori lain.',
            'nama.max'      => 'Nama kategori maksimal 100 karakter.',
            'urutan.required' => 'Urutan tampil wajib diisi.',
            'urutan.integer'  => 'Urutan harus berupa angka.',
            'urutan.min'      => 'Urutan minimal 0.',
        ]);

        $oldName = $category->nama;
        $newName = trim($request->nama);

        $category->update([
            'nama'      => $newName,
            'deskripsi' => $request->deskripsi ? trim($request->deskripsi) : null,
            'urutan'    => $request->urutan,
        ]);

        // If category name changed, synchronize existing products associated with the old name
        $updatedProductsCount = 0;
        if ($oldName !== $newName) {
            $updatedProductsCount = Product::where('kategori', $oldName)->update([
                'kategori' => $newName,
            ]);
        }

        $message = "Kategori '{$newName}' berhasil diperbarui.";
        if ($updatedProductsCount > 0) {
            $message .= " {$updatedProductsCount} produk terkait otomatis disinkronkan ke nama kategori baru.";
        }

        return redirect()->route('admin.kategori.index')
            ->with('success', $message);
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $productCount = Product::where('kategori', $category->nama)->count();

        if ($productCount > 0) {
            return redirect()->route('admin.kategori.index')
                ->with('error', "Kategori '{$category->nama}' tidak dapat dihapus karena masih digunakan oleh {$productCount} produk. Harap pindahkan kategori produk terkait terlebih dahulu.");
        }

        $categoryName = $category->nama;
        $category->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', "Kategori '{$categoryName}' berhasil dihapus.");
    }
}
