<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\DataTransferObjects\OrderData;
use App\DataTransferObjects\OrderDetailData;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;

class OrderService
{
    public function createOrder(OrderData $orderData): Order
    {
        /** @var Order $order */
        $order = Order::create([
            'id_vendedor' => User::where('codigo_trabajador', $orderData->getVendedor())->first()->id,
            'id_repartidor' => User::where('codigo_trabajador', $orderData->getRepartidor())->first()->id,
            'estado' => Status::where('codigo', '01')->first()->status_id,
        ]);

        foreach ($orderData->getProducts() as $product) {
            $order->details()->create([
                'product_id' => Product::where('sku', $product->getSku())->first()->product_id,
                'sku' => $product->getSku(),
                'nombre' => $product->getNombre(),
                'precio' => $product->getPrecio(),
                'cantidad' => $product->getCantidad(),
                'unidad_medida' => $product->getUnidadMedida(),
            ]);
        }

        return Order::where('order_id', $order->order_id)->first();
        return $order;
    }
}
