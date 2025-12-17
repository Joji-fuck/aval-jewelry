<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stone;
use App\Models\JewelryItem;
use App\Models\Material;
use App\Models\Cut;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Type;
use App\Models\Category;
class CatalogProductController extends Controller
{
    public function index(){
        $title = "Каталог изделий";
        $products = Product::with('productable')->paginate(20);
        return view('admin.catalog-product', compact('title', 'products'));
    }
    public function create()
    {
        $materials = Material::all();
        $cuts = Cut::all();
        $colors = Color::all();
        $types = Type::all();
        $title = "Создание товара";
        return view('admin.catalog-product-create', compact('materials', 'cuts', 'colors', 'title', 'types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:stone,jewelry',
        ]);
        DB::transaction(function () use ($request) {
            $productable = null;

            // !!! ИСПРАВЛЕНИЕ: Проверяем $request->type
            if ($request->type === 'stone') {
                $productable = Stone::create([
                    'weight'       => $request->stone_weight,
                    'type_id'      => $request->type_id,
                    'cut_id'       => $request->cut_id,
                    'color_id'     => $request->color_id,
                    'name'         => $request->name,
                    'slug'         => Str::slug($request->name),
                    'internal_sku' => $request->sku,
                    'price'        => $request->price,
                    'stock'        => $request->stock,
                    'description'  => $request->description,
                ]);
            } elseif ($request->type === 'jewelry') {

                $request->validate([
                    'jewelry_size' => 'required|numeric',
                    'material_id' => 'required|exists:materials,id',
                    'base_weight'  => 'required|numeric'
                ]);

                $productable = JewelryItem::create([
                    'size' => $request->jewelry_size,
                    'base_weight' => $request->base_weight,
                    'material_id' => $request->material_id,
                ]);
            }


            $product = $productable->product()->create([
                'name'  => $request->name,
                'slug'  => Str::slug($request->name),
                'sku'   => $request->sku,
                'price' => $request->price,
                'stock' => $request->stock,
                'description'  => $request->description,
                'category_id'  => $request->category_id,
                'is_published' => $request->has('is_published'),
            ]);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('products', 'public');
                    $product->images()->create([
                        'path' => $path
                    ]);
                }
            }
        });

        return redirect()->route('crm.catalog-product.index')->with('success', 'Товар успешно создан!');
    }
    public function edit($id)
    {
        $title = "Редактирование";
        $product = Product::with(['productable', 'images'])->findOrFail($id);
        $materials = Material::all();
        $cuts = Cut::all();
        $colors = Color::all();
        $types = Type::all();
        $categories = Category::all();

        return view('admin.catalog-product-edit', compact(
            'product', 'materials', 'cuts', 'colors', 'types', 'categories', 'title'
        ));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        DB::transaction(function () use ($request, $product) {

            // 1. Обновляем специфику (Камень или Украшение)
            // Мы берем привязанную модель через $product->productable

            if ($product->productable_type === 'App\Models\Stone') {
                $product->productable->update([
                    'weight'       => $request->stone_weight,
                    'type_id'      => $request->type_id,
                    'cut_id'       => $request->cut_id,
                    'color_id'     => $request->color_id,
                    // Дублируемые поля
                    'name'         => $request->name,
                    'internal_sku' => $request->sku,
                    'price'        => $request->price,
                    'stock'        => $request->stock,
                    'description'  => $request->description,
                ]);
            }
            elseif ($product->productable_type === 'App\Models\JewelryItem') {
                $product->productable->update([
                    'size'        => $request->jewelry_size,
                    'base_weight' => $request->base_weight,
                    'material_id' => $request->material_id,
                ]);
            }

            // 2. Обновляем саму "Обертку" Product
            $product->update([
                'name'         => $request->name,
                'slug'         => Str::slug($request->name),
                'sku'          => $request->sku,
                'price'        => $request->price,
                'stock'        => $request->stock,
                'description'  => $request->description,
                'category_id'  => $request->category_id,
                'is_published' => $request->has('is_published'),
            ]);

            // 3. УДАЛЕНИЕ выбранных старых картинок
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $image = ProductImage::find($imageId);
                    if ($image) {
                        // Удаляем файл с диска
                        Storage::disk('public')->delete($image->path);
                        // Удаляем запись из БД
                        $image->delete();
                    }
                }
            }

            // 4. ЗАГРУЗКА НОВЫХ картинок
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('products', 'public');
                    $product->images()->create(['path' => $path]);
                }
            }

            // (Опционально) Обновить главное фото, если старое удалили или его нет
            if (!$product->fresh()->images->isEmpty()) {
                // Если вдруг главное фото удалили, ставим первое попавшееся
                // Логику можно усложнить
            }
        });

        return redirect()->route('crm.catalog-product.index')->with('success', 'Товар обновлен');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        if ($product->productable) {
            $product->productable->delete();
        }

        $product->delete();

        return redirect()->route('crm.catalog-product.index')->with('success', 'Товар удален');
    }
}
