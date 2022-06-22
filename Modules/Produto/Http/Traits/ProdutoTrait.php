<?php

namespace Modules\Produto\Http\Traits;

use Modules\Produto\Entities\Produto;

trait ProdutoTrait
{

    public function saveProduto($dados)
    {
        $produto = Produto::where('codigo_interno',$dados['codigo_interno'])->first();
        
        is_null($produto)
            ? $produto = Produto::create($dados)
            : $produto = $this->updateProduto($produto,$produto->id);
        return $produto;
    }

    public function updateProduto($dados, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->update(array($dados));
        return $produto;
    }
}
