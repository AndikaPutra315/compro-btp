<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index(Request $request)
    {
        $query = Client::withoutGlobalScopes();

        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where('nama_perusahaan', 'like', "%{$search}%");
        }

        $clients = $query->orderBy('urutan')->orderBy('id')->get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        $nextUrutan = (Client::withoutGlobalScopes()->max('urutan') ?? 0) + 1;
        return view('admin.clients.create', compact('nextUrutan'));
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'urutan'          => 'required|integer|min:0',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('clients', 'public');
        }

        Client::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'logo'            => $logoPath,
            'urutan'          => $request->urutan,
        ]);

        return redirect()->route('admin.klien.index')
            ->with('success', 'Klien baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource (optional).
     */
    public function show(string $id)
    {
        return redirect()->route('admin.klien.edit', $id);
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(string $id)
    {
        $client = Client::withoutGlobalScopes()->findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::withoutGlobalScopes()->findOrFail($id);

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'urutan'          => 'required|integer|min:0',
        ]);

        $data = [
            'nama_perusahaan' => $request->nama_perusahaan,
            'urutan'          => $request->urutan,
        ];

        // Handle logo replacement or removal
        if ($request->hasFile('logo')) {
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }
            $data['logo'] = $request->file('logo')->store('clients', 'public');
        } elseif ($request->boolean('hapus_logo')) {
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }
            $data['logo'] = null;
        }

        $client->update($data);

        return redirect()->route('admin.klien.index')
            ->with('success', 'Data klien berhasil diperbarui.');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::withoutGlobalScopes()->findOrFail($id);

        if ($client->logo && Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }

        $client->delete();

        return redirect()->route('admin.klien.index')
            ->with('success', 'Klien berhasil dihapus.');
    }
}
