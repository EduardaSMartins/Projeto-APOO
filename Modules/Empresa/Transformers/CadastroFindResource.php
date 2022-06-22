<?php

namespace Modules\Empresa\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Modules\Cliente\Entities\Cliente;
use Modules\Cliente\Transformers\ClienteResource;
use Modules\Conta\Http\Traits\ContaTrait;
use Modules\Empresa\Entities\Empresa;
use Modules\Pedido\Entities\Pedido;
use Modules\Pedido\Transformers\PedidoIndexResource;

class CadastroFindResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

    use ContaTrait;
 
    public function toArray($request)
    {
        $cliente = Cliente::findOrFail($this->id_cliente);
        $empresa = Empresa::findOrFail($this->id_empresa);
        $pedidos = Pedido::where('id_empresa', $this->id_empresa)->get();
        $pendencias = $this->situacaoFinanceira($empresa->id);

        return [
            'id' => $this->id,
            'cliente' => new ClienteResource($cliente),
            'empresa' => new EmpresaResource($empresa),
            'status' => $this->status,
            'pedidos' => PedidoIndexResource::collection($pedidos),
            'pendencias' => $pendencias
        ];
    }
}
