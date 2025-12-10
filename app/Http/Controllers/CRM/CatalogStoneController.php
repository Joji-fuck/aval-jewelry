<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatalogStoneController extends Controller
{
    public function index(){
        $title = 'Каталог камней';
        return view('admin.catalog-stone', compact('title'));
    }
}
