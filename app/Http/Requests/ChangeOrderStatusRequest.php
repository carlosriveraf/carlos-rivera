<?php

namespace App\Http\Requests;

use App\DataTransferObjects\ChangeOrderStatusData;
use Illuminate\Foundation\Http\FormRequest;

class ChangeOrderStatusRequest extends FormRequest
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
            'nroPedido' => 'required|string|exists:orders,nro_pedido',
            'estado' => 'required|string|exists:status,codigo',
        ];
    }

    public function validatedData(): ChangeOrderStatusData
    {
        $validated = $this->validated();

        return new ChangeOrderStatusData(
            $validated['nroPedido'],
            $validated['estado']
        );
    }
}
