<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProjectDocument;
use App\Models\CompanyPhoto;
use App\Models\Client;
use App\Models\OrganizationMember;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        $projectDocs = ProjectDocument::latest()->get();
        $companyPhotos = CompanyPhoto::orderBy('urutan')->get();
        $clients = Client::orderBy('urutan')->get();
        $orgRoots = OrganizationMember::whereNull('parent_id')
            ->with('children.children.children')
            ->orderBy('urutan')->orderBy('id')->get();
        return view('landing', compact('products', 'projectDocs', 'companyPhotos', 'clients', 'orgRoots'));
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
        $categories = Product::getCategories();
        $categoryCounts = Product::selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();

        return view('products.index', compact('products', 'categories', 'categoryCounts'));
    }
}
