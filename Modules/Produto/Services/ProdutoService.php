<?php

namespace Modules\Produto\Services;

use Modules\Produto\Entities\Produto;
use Modules\Produto\Transformers\ProdutoResource;
use Spatie\QueryBuilder\QueryBuilder;

class ProdutoService
{
    public static function findProduto()
    {
        $fillables = (new Produto)->getFillable();
        $produtos = QueryBuilder::for(Produto::class)
            ->allowedFields($fillables)
            ->where('quantidade_estoque','>',0)
            ->paginate(request()->query('paginate'))
            ->appends(request()->query());
            
        $produtos->toArray()['data'] = ProdutoResource::collection($produtos);
        return $produtos;
    }
}
