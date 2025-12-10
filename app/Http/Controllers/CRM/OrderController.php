<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $title = 'Заказы';
        return view('admin.order', compact('title'));
    }
}
