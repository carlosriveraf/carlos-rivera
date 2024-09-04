<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeOrderStatusRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrderRequest $request)
    {
        $orderData = $request->validatedData();

        $order = $this->orderService->createOrder($orderData);

        return $order;
    }

    public function changeStatus(ChangeOrderStatusRequest $request)
    {
        $orderData = $request->validatedData();

        if ($this->orderService->changeOrderStatus($orderData)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Estado del pedido actualizado.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo cambiar el estado del pedido.',
            ]);
        }
    }
}
