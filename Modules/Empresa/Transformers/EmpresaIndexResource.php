<?php

namespace Modules\Empresa\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Endereco\Transformers\EnderecoResource;
use Modules\Telefone\Entities\Telefone;
use Modules\Telefone\Transformers\TelefoneResource;

class EmpresaIndexResource extends JsonResource
{

    public function toArray($request)
    {
            return [
            'id' => $this->id,
            'cnpj' => $this->cnpj,
            'razao_social' => $this->razao_social,
            'nome_fantasia' => $this->nome_fantasia
        ];
    }
}
