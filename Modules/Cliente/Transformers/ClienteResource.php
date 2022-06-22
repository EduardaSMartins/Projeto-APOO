<?php

namespace Modules\Cliente\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Modules\Empresa\Entities\Empresa;
use Modules\Empresa\Transformers\CadastroResource;
use Modules\Empresa\Transformers\EmpresaResource;
use Modules\Telefone\Entities\Telefone;
use Modules\Telefone\Transformers\TelefoneResource;

class ClienteResource extends JsonResource
{

    public function toArray($request)
    {
        $telefone = Telefone::findOrFail($this->id_telefone);
        // $empresa = Empresa::where('id_cliente',$this->id)->first();
        // dd($empresa);
        // $cadastro = DB::table('cadastros')
        // ->where('id_cliente',$this->id)
        // ->where('id_empresa',$empresa->id)
        // ->first();
        
        return [
            'id' => $this->id,
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'rg_orgao' => $this->rg_orgao,
            'rg_uf' => $this->rg_uf,
            'nome' => $this->nome,
            'sobrenome' => $this->sobrenome,
            'email' => $this->email,
            'data_nascimento' => $this->data_nascimento,
            'telefone' => new TelefoneResource($telefone),
            // 'status_cadastro' => $cadastro->status
        ];
    }
}
