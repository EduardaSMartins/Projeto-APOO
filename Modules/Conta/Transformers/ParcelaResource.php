<?php

namespace Modules\Conta\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ParcelaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
