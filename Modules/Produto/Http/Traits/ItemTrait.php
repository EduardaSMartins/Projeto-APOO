<?php

namespace Modules\Produto\Http\Traits;

use Modules\Produto\Entities\Item;
use Modules\Produto\Entities\Produto;

trait ItemTrait
{

    public function saveItem($dados)
    {
        $dados['valor_total'] = $dados['quantidade'] * $dados['valor'];
        $item = Item::create($dados);
        
        return $item;
    }

    public function removeEstoque($id_produto, $dados_item)
    {
        $produto = Produto::findOrFail($id_produto);
        $produto->quantidade_estoque -= $dados_item->quantidade;
        $produto->save();
    }

    public function adicionaEstoque($id_produto, $dados_item)
    {
        $produto = Produto::findOrFail($id_produto);
        $produto->quantidade_estoque += $dados_item->quantidade;
        $produto->save();   
    }
}
