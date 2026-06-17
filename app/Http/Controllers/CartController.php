<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $title = "Корзина";
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total', 'title'));
    }
    public function add(Request $request, $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $imagePath = $product->images->first() ? $product->images->first()->path : null;
            $cart[$id] = [
                "name" => $product->title,
                "quantity" => 1, // Или $request->quantity, если передаешь с формы
                "price" => $product->price,
                "image" => $imagePath
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
        return redirect()->back();
    }
}
