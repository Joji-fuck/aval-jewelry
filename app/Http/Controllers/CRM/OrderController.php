<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $title = 'Заказы';
        $orders = Order::with('products')->latest()->paginate(20);
        return view('admin.order', compact('title', 'orders'));
    }
    public function store(Request $request)
    {
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
            'status'       => 'Ожидает оплаты',
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
            'total_price'  => $total,
            'comment'      => $request->comment,
        ]);

        foreach($cart as $id => $item) {
            OrderProduct::create([
                'order_id'     => $order->id,
                'product_id'   => $id,
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
            ]);
        }

        // 5. Очищаем корзину
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Заказ успешно оформлен!');
    }
    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Статус обновлен');
    }

}
