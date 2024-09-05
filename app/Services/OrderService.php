<?php

namespace App\Services;

use App\DataTransferObjects\ChangeOrderStatusData;
use App\Models\Order;
use App\Models\OrderDetail;
use App\DataTransferObjects\OrderData;
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
    }

    public function changeOrderStatus(ChangeOrderStatusData $body): bool
    {
        $order = Order::where('nro_pedido', $body->getNroPedido())->first();
        switch ($body->getEstado()) {
            case '01':
                if (in_array($order->status->codigo, ['01', '02', '03', '04'])) {
                    return false;
                }
                break;

            case '02':
                if (in_array($order->status->codigo, ['02', '03', '04'])) {
                    return false;
                }
                $order->fecha_recepcion = now();
                break;

            case '03':
                if (in_array($order->status->codigo, ['03', '04'])) {
                    return false;
                }
                $order->fecha_despacho = now();
                break;

            case '04':
                if (in_array($order->status->codigo, ['04'])) {
                    return false;
                }
                $order->fecha_entrega = now();
                break;
        }

        $order->estado = Status::where('codigo', $body->getEstado())->first()->status_id;
        return $order->save();
    }
}
