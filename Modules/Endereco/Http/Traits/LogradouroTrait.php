<?php

namespace Modules\Endereco\Http\Traits;

use Modules\Endereco\Entities\Bairro;
use Modules\Endereco\Entities\Logradouro;

trait LogradouroTrait
{
    //Cria ou atualiza o bairro pertencente ao município
    public function saveUpdateLogradouro($dados, $id = null)
    {
        if(is_null($id)){
            // Verifica se o logradouro já existe no bairro
            $logradouro = Logradouro::where('cep', $dados['cep'])->where('id_bairro', $dados['id_bairro'])->first();
            if(blank($logradouro))
                $logradouro = Logradouro::create($dados);
            else
                $logradouro->update($dados);
        }else{
            $logradouro = Bairro::findOrFail($id);
            $logradouro->update($dados);
        }
        return $logradouro;
    }
}