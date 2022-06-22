<?php

namespace Modules\Cliente\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente' => 'required',
            'cliente.cpf' => 'required',
            'cliente.rg' => 'sometimes',
            'cliente.rg_orgao' => 'sometimes',
            'cliente.rg_uf' => 'sometimes',
            'cliente.nome' => 'required',
            'cliente.sobrenome' => 'required',
            'cliente.email' => 'sometimes',
            'cliente.data_nascimento' => 'sometimes',
            
            'cliente.telefone' => 'present',
            'cliente.telefone.numero' => 'required',
            'cliente.telefone.tipo' => ['sometimes', 'in:celular,fixo'],
            'cliente.telefone.observacao' => 'sometimes',

            'empresa' => 'present',
            'empresa.cnpj' => 'required',
            'empresa.razao_social' => 'required',
            'empresa.nome_fantasia' => 'sometimes',
            'empresa.ramo_atividade' => 'required',
            'empresa.email' => 'sometimes',
            'empresa.porte' => ['sometimes', 'in:micro,pequena,media,grande'],
            
            'empresa.telefone' => 'present',
            'empresa.telefone.numero' => 'required',
            'empresa.telefone.tipo' => ['sometimes', 'in:celular,fixo'],
            'empresa.telefone.observacao' => 'sometimes',

            'empresa.enderecos' => 'sometimes|array',
            'empresa.enderecos.*.endereco' => 'sometimes',
            'empresa.enderecos.*.endereco.complemento' => 'sometimes',
            'empresa.enderecos.*.endereco.numero' => 'sometimes',
            
            'empresa.enderecos.*.logradouro' => 'sometimes',
            'empresa.enderecos.*.logradouro.descricao' => 'sometimes',
            'empresa.enderecos.*.logradouro.cep' => 'sometimes',
            
            'empresa.enderecos.*.bairro' => 'sometimes',
            'empresa.enderecos.*.bairro.nome' => 'sometimes',
            
            'empresa.enderecos.*.municipio' => 'sometimes',
            'empresa.enderecos.*.municipio.nome' => 'sometimes',
            'empresa.enderecos.*.municipio.uf' => 'sometimes',
            'empresa.enderecos.*.municipio.cod_ibge' => 'sometimes'
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
 