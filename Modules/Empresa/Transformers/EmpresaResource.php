<?php

namespace Modules\Empresa\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Cliente\Transformers\ClienteResource;
use Modules\Empresa\Entities\Empresa;
use Modules\Endereco\Transformers\EnderecoResource;
use Modules\Pedido\Transformers\PedidoIndexResource;
use Modules\Telefone\Entities\Telefone;
use Modules\Telefone\Transformers\TelefoneResource;

class EmpresaResource extends JsonResource
{

    public function toArray($request)
    {
        if (isset($this->id_telefone)) {
            $telefone = Telefone::findOrFail($this->id_telefone);
            $telefone = new TelefoneResource($telefone);
        } else
            $telefone = [];

        return [
            'id' => $this->id,
            'cnpj' => $this->cnpj,
            'razao_social' => $this->razao_social,
            'nome_fantasia' => $this->nome_fantasia,
            'ramo_atividade' => $this->ramo_atividade,
            'email' => $this->email,
            'porte' => $this->porte,
            'telefone' => $telefone,
            'enderecos' => EnderecoResource::collection($this->enderecos)
        ];
    }
}
