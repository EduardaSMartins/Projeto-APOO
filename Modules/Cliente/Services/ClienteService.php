<?php

namespace Modules\Cliente\Services;

use Modules\Cliente\Entities\Cliente;
use Modules\Cliente\Transformers\ClienteResource;
use Spatie\QueryBuilder\QueryBuilder;

class ClienteService
{

    public static function findClientes()
    {
        $fillables = (new Cliente)->getFillable();
        $clientes = QueryBuilder::for(Cliente::class)
            ->allowedFields($fillables)
            ->paginate(request()->query('paginate'))
            ->appends(request()->query());
        $clientes->toArray()['data'] = ClienteResource::collection($clientes);
        return $clientes;
    }
}
