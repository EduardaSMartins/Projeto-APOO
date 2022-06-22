<?php

namespace Modules\Telefone\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TelefoneResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'numero' => $this->numero,
            'tipo' => $this->tipo,
            'observacao' => $this->observacao
        ];
    }
}
