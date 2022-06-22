<?php

namespace Modules\Pedido\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Empresa\Entities\Empresa;
use Modules\Empresa\Transformers\EmpresaIndexResource;
use Modules\Empresa\Transformers\EmpresaResource;
use Modules\Produto\Transformers\ItemResource;

class PedidoIndexResource extends JsonResource
{

    public function toArray($request)
    {
        $empresa = Empresa::findOrFail($this->id_empresa);
        $empresa = new EmpresaIndexResource($empresa);

        return [
            'id' => $this->id,
            // 'id_empresa' => $this->id_empresa,
            // 'empresa' => $empresa,
            'data_pedido' => $this->data_pedido,
            'valor_final' => $this->valor_final,
            'status' => $this->status,
            'observacao' => $this->observacao,
            'items' => ItemResource::collection($this->items)
        ];
    }
}
