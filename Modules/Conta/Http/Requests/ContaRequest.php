<?php

namespace Modules\Conta\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'conta' => 'present',
            'conta.id_pedido' => 'required|exists:pedidos',
            'conta.data_vencimento' => 'sometimes',
            'conta.data_emissao' => 'sometimes',
            'conta.data_efetivacao' => 'sometimes',
            'conta.valor' => 'required',
            'conta.descricao' => 'sometimes',
            'conta.numero_parcelas' => 'required',
            'conta.observacao' => 'sometimes',
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
