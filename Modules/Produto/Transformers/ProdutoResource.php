<?php

namespace Modules\Produto\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_categoria' => $this->id_categoria,
            'categoria' => $this->categoria,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'codigo_barras' => $this->codigo_barras,
            'codigo_interno' => $this->codigo_interno,
            'sabor' => $this->sabor,
            'cor' => $this->cor,
            'tamanho' => $this->tamanho,
            'quantidade_minima' => $this->quantidade_minima,
            'quantidade_caixa' => $this->quantidade_caixa,
            'quantidade_estoque' => $this->quantidade_estoque,
            'valor_unitario' => $this->valor_unitario
        ];
    }
}
