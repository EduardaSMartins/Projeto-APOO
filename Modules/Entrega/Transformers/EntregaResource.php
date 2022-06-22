<?php

namespace Modules\Entrega\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Pedido\Entities\Pedido;
use Modules\Pedido\Transformers\PedidoResource;

class EntregaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $pedido = Pedido::findOrFail($this->id_pedido);
        $pedido = new PedidoResource($pedido);

        return [
            'id' => $this->id,
            'id_pedido' => $this->id_pedido,
            'data_efetuacao' => $this->data_efetuacao,
            'data_entrega_estimada' => $this->data_entrega_estimada,
            'status' => $this->status
        ];
    }
}
