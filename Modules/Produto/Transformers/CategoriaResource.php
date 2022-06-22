<?php

namespace Modules\Produto\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
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
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'sigla' => $this->sigla,
            'cor' => $this->cor
        ];
    }
}
