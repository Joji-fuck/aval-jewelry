<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\RingOrder;
use Illuminate\Http\Request;

class RingOrderAdminController extends Controller
{
    /**
     * Список всех заказов.
     */
    public function index(Request $request)
    {
        $statuses = ['Ожидает оплаты', 'Оплачен', 'В работе', 'Завершён', 'Отменён'];

        $query = RingOrder::with(['ringModel', 'material', 'user'])
            ->latest();

        // фильтр по статусу
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // поиск
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('surname', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(20)->withQueryString();

        $title = 'Заказы — Конструктор';

        return view('admin.ring-orders.index', compact('orders', 'statuses', 'title'));
    }

    /**
     * Карточка заказа.
     */
    public function show(RingOrder $ringOrder)
    {
        $ringOrder->load(['ringModel', 'material', 'user']);
        $statuses = ['Ожидает оплаты', 'Оплачен', 'В работе', 'Завершён', 'Отменён'];

        $title = "Заказ №{$ringOrder->id}";

        return view('admin.ring-orders.show', compact('ringOrder', 'statuses', 'title'));
    }

    /**
     * Смена статуса.
     */
    public function updateStatus(Request $request, RingOrder $ringOrder)
    {
        $data = $request->validate([
            'status' => ['required', 'in:Ожидает оплаты,Оплачен,В работе,Завершён,Отменён'],
        ]);

        $ringOrder->update(['status' => $data['status']]);

        return back()->with('success', 'Статус обновлён');
    }
}
