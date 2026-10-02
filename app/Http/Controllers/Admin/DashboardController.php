<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProjectDocument;
use App\Models\CompanyPhoto;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $dokumentasiCount = ProjectDocument::count();
        $photoCount = CompanyPhoto::count();
        $clientCount = Client::count();
        return view('admin.dashboard', compact('productCount', 'dokumentasiCount', 'photoCount', 'clientCount'));
    }
}
