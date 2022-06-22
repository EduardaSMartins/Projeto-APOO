<?php

namespace Modules\Produto\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Produto\Entities\Produto;

class ItemResource extends JsonResource
{

    public function toArray($request)
    {
        $produto = Produto::findOrFail($this->id_produto);
        $produto = new ProdutoResource($produto);
        
        return [
            'id' => $this->id,
            'id_produto' => $this->id_produto,
            'produto' => $produto,
            'quantidade' => $this->quantidade,
            'valor' => $this->valor,
            'valor_total' => $this->valor_total
        ];
    }
}
