<?php

namespace Modules\Endereco\Http\Traits;

use Modules\Endereco\Entities\Municipio;

trait MunicipioTrait
{
    //Cria novo município ou atualiza o existente
    public function saveUpdateMunicipio($dados, $id = null)
    {
        if (is_null($id)) {
            $municipio = Municipio::where('cod_ibge', $dados['cod_ibge'])->first();
            if (blank($municipio))
                $municipio = Municipio::create($dados);
            else
                $municipio->update($dados);
        } else {
            $municipio = Municipio::findOrFail($id);
            $municipio->update($dados);
        }
        return $municipio;
    }
}
