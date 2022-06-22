<?php

namespace Modules\Empresa\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Modules\Cliente\Entities\Cliente;
use Modules\Cliente\Transformers\ClienteResource;
use Modules\Empresa\Entities\Empresa;

class CadastroResource extends JsonResource
{

    public function toArray($request)
    {
        $cliente = Cliente::findOrFail($this->id);
        $empresa = Empresa::where('id_cliente', $cliente->id)->first();

        $cadastro = DB::table('cadastros')
            ->where('id_cliente', $cliente->id)
            ->where('id_empresa', $empresa->id)
            ->first();

        return [
            'id' => $cadastro->id,
            'cliente' => new ClienteResource($cliente),
            'empresa' => new EmpresaResource($empresa),
            'status' => $cadastro->status
        ];
    }
}
