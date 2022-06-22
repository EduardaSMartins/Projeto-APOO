<?php

namespace Modules\Conta\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcelaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parcela' => 'sometimes',
            'parcela.id_conta' => 'required|exists:contas',
            'parcela.valor' => 'required',
            'parcela.data_vencimento' => 'required',
            'parcela.numero_parcela' => 'required',
            'parcela.data_pagamento' => 'sometimes',
            'parcela.parcela_paga' => 'sometimes',
            'parcela.observacao' => 'sometimes'
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
