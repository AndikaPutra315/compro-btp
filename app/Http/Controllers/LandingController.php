<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProjectDocument;
use App\Models\CompanyPhoto;
use App\Models\Client;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        $projectDocs = ProjectDocument::latest()->get();
        $companyPhotos = CompanyPhoto::orderBy('urutan')->get();
        $clients = Client::orderBy('urutan')->get();
        return view('landing', compact('products', 'projectDocs', 'companyPhotos', 'clients'));
    }

    public function allProducts(Request $request)
    {
        $query = Product::query();

        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori') && $request->input('kategori') !== 'all') {
            $query->where('kategori', $request->input('kategori'));
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $categories = Product::select('kategori')
            ->distinct()
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->pluck('kategori');

        return view('products.index', compact('products', 'categories'));
    }
}
