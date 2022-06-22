<?php

namespace Modules\Produto\Http\Traits;

use Modules\Cliente\Entities\Cliente;
use Modules\Empresa\Http\Traits\EmpresaTrait;
use Modules\Produto\Entities\Categoria;
use Modules\Telefone\Http\Traits\TelefoneTrait;

trait CategoriaTrait
{

    //Cria cadastro de novo cliente
    public function saveCategoria($dados, $id = null)
    {
        $categoria = Categoria::create($dados);
        return $categoria;
    }
}
