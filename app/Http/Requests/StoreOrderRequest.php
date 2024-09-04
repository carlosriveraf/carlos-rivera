<?php

namespace App\Http\Requests;

use App\DataTransferObjects\OrderData;
use App\DataTransferObjects\OrderDetailData;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'vendedor' => 'required|string|exists:users,codigo_trabajador',
            'repartidor' => 'required|string|exists:users,codigo_trabajador',
            'products' => 'required|array',
            'products.*.sku' => 'required|string|exists:products,sku',
            'products.*.nombre' => 'required|string',
            'products.*.precio' => 'required|numeric|min:0',
            'products.*.cantidad' => 'required|numeric|min:1',
            'products.*.unidadMedida' => 'required|string',
        ];
    }

    public function validatedData(): OrderData
    {
        $validated = $this->validated();

        return new OrderData(
            $validated['vendedor'],
            $validated['repartidor'],
            array_map(function ($product) {
                return new OrderDetailData(
                    $product['sku'],
                    $product['nombre'],
                    $product['precio'],
                    $product['cantidad'],
                    $product['unidadMedida']
                );
            }, $validated['products'])
        );
    }
}
