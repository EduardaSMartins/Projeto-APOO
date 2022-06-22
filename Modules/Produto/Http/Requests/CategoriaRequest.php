<?php

namespace Modules\Produto\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categoria' => 'required',
            'categoria.nome' => 'required',
            'categoria.descricao' => 'sometimes',
            'categoria.sigla' => 'sometimes',
            'categoria.cor' => 'sometimes'
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

    public function messages()
    {
        return [
            'required' => 'O :attribute deve ser informado'
        ];
    }
}
