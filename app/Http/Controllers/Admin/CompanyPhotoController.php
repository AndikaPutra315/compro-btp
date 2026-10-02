<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyPhoto;
use Illuminate\Support\Facades\Storage;

class CompanyPhotoController extends Controller
{
    public function index()
    {
        $photos = CompanyPhoto::withoutGlobalScopes()->orderBy('urutan')->get();
        return view('admin.company-photos.index', compact('photos'));
    }

    public function create()
    {
        $nextUrutan = CompanyPhoto::max('urutan') + 1;
        return view('admin.company-photos.create', compact('nextUrutan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'nullable|string|max:255',
            'gambar' => 'required|image|max:5120',
            'urutan' => 'required|integer|min:0',
        ]);

        $imagePath = $request->file('gambar')->store('company-photos', 'public');

        CompanyPhoto::create([
            'judul'  => $request->judul,
            'gambar' => $imagePath,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('admin.foto-tentang.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    public function show(string $id) {}

    public function edit(string $id)
    {
        $photo = CompanyPhoto::withoutGlobalScopes()->findOrFail($id);
        return view('admin.company-photos.edit', compact('photo'));
    }

    public function update(Request $request, string $id)
    {
        $photo = CompanyPhoto::withoutGlobalScopes()->findOrFail($id);

        $request->validate([
            'judul'  => 'nullable|string|max:255',
            'gambar' => 'nullable|image|max:5120',
            'urutan' => 'required|integer|min:0',
        ]);

        $data = [
            'judul'  => $request->judul,
            'urutan' => $request->urutan,
        ];

        if ($request->hasFile('gambar')) {
            if (Storage::disk('public')->exists($photo->gambar)) {
                Storage::disk('public')->delete($photo->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('company-photos', 'public');
        }

        $photo->update($data);

        return redirect()->route('admin.foto-tentang.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $photo = CompanyPhoto::withoutGlobalScopes()->findOrFail($id);

        if (Storage::disk('public')->exists($photo->gambar)) {
            Storage::disk('public')->delete($photo->gambar);
        }

        $photo->delete();

        return redirect()->route('admin.foto-tentang.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}
