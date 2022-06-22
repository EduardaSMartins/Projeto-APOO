<?php

namespace Modules\Telefone\Http\Traits;

use Modules\Telefone\Entities\Telefone;

trait TelefoneTrait
{

    // Cria ou atualiza telefone
    public function saveUpdateTelefone($dados, $id = null)
    {
        if(is_null($id)){
            $telefone = Telefone::create($dados);            
        }else{
            $telefone = Telefone::findOrFail($id);
            $telefone->update($dados);
        }
        return $telefone;
    }
}
