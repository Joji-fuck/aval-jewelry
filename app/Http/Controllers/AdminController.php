<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $title = 'Админ панель';
        return view('admin.index', compact('title'));
    }
}
