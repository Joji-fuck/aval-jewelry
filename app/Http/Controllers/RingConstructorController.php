<?php

namespace App\Http\Controllers;

use App\Models\RingModel;
use App\Models\Material;

class RingConstructorController
{
    public function index()
    {
        $title = "Конструктор";
        $ringModels = RingModel::all();
        $materials = Material::all();

        return view('constructor.index', compact('ringModels', 'materials', 'title'));
    }
}
