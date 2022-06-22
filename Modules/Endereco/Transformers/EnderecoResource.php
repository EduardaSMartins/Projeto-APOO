<?php

namespace Modules\Endereco\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Modules\Endereco\Entities\Bairro;
use Modules\Endereco\Entities\Municipio;

class EnderecoResource extends JsonResource
{

    public function toArray($request)
    {
        $bairro = Bairro::findOrFail($this->id_bairro);
        $municipio = Municipio::findOrFail($bairro->id_municipio);

        return [
            'endereco' => [
                'complemento' => $this->whenPivotLoaded('endereco_empresas', function () {
                    return $this->pivot->complemento;
                }),
                'numero' => $this->whenPivotLoaded('endereco_empresas', function () {
                    return $this->pivot->numero;
                }),
            ],
            'logradouro' => [
                'descricao' => $this->descricao,
                'cep' => $this->cep
            ],
            'bairro' => [
                'nome' => $bairro->nome
            ],
            'municipio' => [
                'nome' => $municipio->nome,
                'uf' => $municipio->uf,
                'cod_ibge' => $municipio->cod_ibge,
            ]
        ];
    }
}