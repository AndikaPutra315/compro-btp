<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectDocument;
use Illuminate\Support\Facades\Storage;

class ProjectDocumentController extends Controller
{
    public function index()
    {
        $documents = ProjectDocument::latest()->get();
        return view('admin.dokumentasi.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.dokumentasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'gambar' => 'required|image|max:5120',
        ]);

        $imagePath = $request->file('gambar')->store('dokumentasi', 'public');

        ProjectDocument::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'gambar' => $imagePath,
        ]);

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Dokumentasi proyek berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        // Not used
    }

    public function edit(string $id)
    {
        $document = ProjectDocument::findOrFail($id);
        return view('admin.dokumentasi.edit', compact('document'));
    }

    public function update(Request $request, string $id)
    {
        $document = ProjectDocument::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|max:5120',
        ]);

        $data = [
            'judul' => $request->judul,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('gambar')) {
            if (Storage::disk('public')->exists($document->gambar)) {
                Storage::disk('public')->delete($document->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('dokumentasi', 'public');
        }

        $document->update($data);

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Dokumentasi proyek berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $document = ProjectDocument::findOrFail($id);
        
        if (Storage::disk('public')->exists($document->gambar)) {
            Storage::disk('public')->delete($document->gambar);
        }
        
        $document->delete();

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Dokumentasi proyek berhasil dihapus.');
    }
}
