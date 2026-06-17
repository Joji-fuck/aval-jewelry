<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRingOrderRequest;
use App\Models\Material;
use App\Models\RingModel;
use App\Models\RingOrder;
use Illuminate\Http\Request;

class RingOrderController extends Controller
{
    public function create(Request $request)
    {
        $type       = $request->query('type', 'Обручальное');
        $materialId = $request->query('material_id');
        $ringSize   = $request->query('ring_size', 17);

        $ringModel = RingModel::where('type', $type)->firstOrFail();
        $material  = Material::findOrFail($materialId);

        $title = 'Оформление заказа';

        return view('constructor.checkout', compact(
            'ringModel', 'material', 'ringSize', 'title'
        ));
    }
    public function store(StoreRingOrderRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['status']  = 'Ожидает оплаты';

        $order = RingOrder::create($data);

        return response()->json([
            'success'      => true,
            'order_id'     => $order->id,
            'redirect_url' => route('ring-orders.success', $order),
        ]);
    }
    public function success(RingOrder $ringOrder)
    {
        $ringOrder->load(['ringModel', 'material']);
        $title = 'Заказ оформлен';

        return view('constructor.success', compact('ringOrder', 'title'));
    }
}
