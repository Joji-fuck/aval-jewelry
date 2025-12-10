<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Product;

class CatalogProductController extends Controller
{
    public function index(){
        $title = "Каталог изделий";
        $products = Product::with('productable')->paginate(20);
        return view('admin.catalog-product', compact('title', 'products'));
    }
}
