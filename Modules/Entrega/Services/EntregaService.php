<?php

namespace Modules\Entrega\Services;

use Modules\Entrega\Entities\Entrega;
use Modules\Entrega\Transformers\EntregaResource;
use Spatie\QueryBuilder\QueryBuilder;

class EntregaService
{
    public static function findEntregas()
    {
        $fillables = (new Entrega)->getFillable();
        $entregas = QueryBuilder::for(Entrega::class)
            ->allowedFields($fillables)
            // ->orderBy
            ->paginate(request()->query('paginate'))
            ->appends(request()->query());
        $entregas->toArray()['data'] = EntregaResource::collection($entregas);
        return $entregas;
    }
}
