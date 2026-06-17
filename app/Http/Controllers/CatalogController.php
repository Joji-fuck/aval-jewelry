<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Material;
use App\Models\Stone;
use App\Models\JewelryItem;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $title = "Каталог";
        // 1. Начинаем запрос
        $query = Product::query()->with(['images', 'productable']);

        // 2. Фильтр по Цене (мин/макс)
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // 3. Фильтр по Категории (Кольца, Серьги и т.д.)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. ГЛАВНЫЙ ФИЛЬТР: Тип изделия (Камень или Украшение)
        if ($request->filled('type')) {

            if ($request->type === 'stone') {
                // Оставляем только камни
                $query->whereHasMorph('productable', [Stone::class], function (Builder $q) use ($request) {
                    // Внутри этой функции мы фильтруем таблицу STONES

                    // Фильтр по весу камня
                    if ($request->filled('stone_weight_min')) {
                        $q->where('weight', '>=', $request->stone_weight_min);
                    }
                });
            }
            elseif ($request->type === 'jewelry') {
                // Оставляем только украшения
                $query->whereHasMorph('productable', [JewelryItem::class], function (Builder $q) use ($request) {
                    // Внутри этой функции мы фильтруем таблицу JEWELRY_ITEMS

                    // Фильтр по материалу (Золото, Серебро)
                    if ($request->filled('material_id')) {
                        $q->where('material_id', $request->material_id);
                    }
                });
            }
        }

        // 5. Сортировка и Пагинация
        $products = $query->where('is_published', true) // Только опубликованные
        ->latest()
            ->paginate(12)
            ->withQueryString(); // Сохраняет фильтры при переходе по страницам

        // Данные для сайдбара
        $categories = Category::all();
        $materials = Material::all();

        return view('catalog.index', compact('products', 'categories', 'materials', 'title'));
    }

    public function show($slug){
        $product = Product::with('images')->where('slug', $slug)->firstOrFail();
        $title = $product->name;

        return view('catalog.show', compact('product', 'title'));
    }

    public function add($id){
        $product = Product::with('images')->findOrFail($id);
        if (!$product->is_published) {
            return redirect()->back()->with('error', 'Товар снят с продажи.');
        }
        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Товара нет в наличии.');
        }
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            if ($cart[$id]['quantity'] + 1 > $product->stock) {
                return redirect()->back()->with('error', 'Недостаточно товара на складе.');
            }
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "sku" => $product->sku,
                "slug" => $product->slug,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->images->first() ? $product->images->first()->path : null,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Товар удален из корзины');
    }

    public function cartModal(){
        $cart = session()->get('cart', []);

    }
}
