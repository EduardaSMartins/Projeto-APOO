<?php

namespace Modules\Produto\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'produto' => 'required',
            'produto.id_categoria' => 'sometimes',
            'produto.nome' => 'required',
            'produto.descricao' => 'sometimes',
            'produto.codigo_barras' => 'sometimes',
            'produto.codigo_interno' => 'required',
            'produto.sabor' => 'sometimes',
            'produto.cor' => 'sometimes',
            'produto.tamanho' => 'sometimes',
            'produto.quantidade_minima' => 'required',
            'produto.quantidade_caixa' => 'sometimes',
            'produto.quantidade_estoque' => 'required',
            'produto.valor_unitario' => 'required'
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
