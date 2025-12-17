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
    public function store(Request $request)
    {
        // 1. Валидация (проверяем, что обязательные поля заполнены)
        $validated = $request->validate([
            'surname'      => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'patronymic'   => 'nullable|string|max:255',
            'phone'        => 'required|string|max:20',
            'country'      => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'street'       => 'required|string|max:255',
            'house_number' => 'required|string|max:50',
            'zip_code'     => 'required|string|max:20',
            'comment'      => 'nullable|string',
        ]);

        // Проверяем корзину
        $cart = session()->get('cart');
        if(!$cart) {
            return redirect()->back()->with('error', 'Корзина пуста');
        }

        // 2. Считаем сумму
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 3. Создаем заказ
        $order = Order::create([
            'status'       => 'new',
            'user_id'      => Auth::id(), // Если пользователь вошел, запишется его ID, иначе null
            'surname'      => $request->surname,
            'name'         => $request->name,
            'patronymic'   => $request->patronymic,
            'phone'        => $request->phone,
            'country'      => $request->country,
            'city'         => $request->city,
            'street'       => $request->street,
            'house_number' => $request->house_number,
            'zip_code'     => $request->zip_code,
            'total_price'  => $total, // В твоей модели поле называется total_price
            'comment'      => $request->comment,
        ]);

        // 4. Сохраняем товары (таблица order_items должна быть создана, как мы обсуждали ранее)
        foreach($cart as $id => $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $id,
                'product_name' => $item['name'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
            ]);
        }

        // 5. Очищаем корзину
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Заказ успешно оформлен!');
    }
}
