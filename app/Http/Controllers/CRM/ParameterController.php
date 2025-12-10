<?php

namespace App\Http\Controllers\CRM;

use App\Models\Cut;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Material;
use App\Models\Color;

class ParameterController extends Controller
{
    protected function getModelClass($type)
    {
        $map = [
            'materials' => Material::class,
            'colors'    => Color::class,
            'cuts'      => Cut::class,
            'types'     => Type::class,
        ];

        return $map[$type];
    }
    public function index(){
        $title = 'Редактор';
        $materials = Material::all();
        $colors = Color::all();
        $cuts = Cut::all();
        $types = Type::all();
        return view('admin.parameter', compact('title', 'materials', 'colors', 'cuts', 'types'));
    }
    public function store(Request $request, $type)
    {
        $modelClass = $this->getModelClass($type);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data = $request->all();
        if ($request->has('name')) {
            $data['slug'] = Str::slug($request->name);
        }
        $modelClass::create($data);

        return back()->with('success', 'Запись добавлена!');
    }
    public function update(Request $request, $type, $id)
    {
        $modelClass = $this->getModelClass($type);
        $item = $modelClass::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data = $request->all();
        if ($request->has('name')) {
            $data['slug'] = Str::slug($request->name);
        }
        $item->update($data);
        return back()->with('success', 'Запись обновлена!');
    }
    public function destroy($type, $id)
    {
        $modelClass = $this->getModelClass($type);
        $modelClass::findOrFail($id)->delete();

        return back()->with('success', 'Удалено');
    }
}
