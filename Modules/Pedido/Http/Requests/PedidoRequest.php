<?php

namespace Modules\Pedido\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pedido' => 'sometimes',
            'pedido.id_cliente' => 'request',
            'pedido.observacao' => 'sometimes',
            'pedido.items' => 'present|array',
            'pedido.items.id_produto' => 'sometimes',
            'pedido.items.quantidade' => 'sometimes',
            'pedido.items.valor' => 'sometimes'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
