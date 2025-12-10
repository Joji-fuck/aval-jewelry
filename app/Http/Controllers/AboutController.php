<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $title = "О нас";
        return view('about.index', compact('title'));
    }
}
