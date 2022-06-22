<?php

namespace Modules\Entrega\Http\Traits;

use Modules\Entrega\Entities\Entrega;

trait EntregaTrait
{
    public function updateEntrega($dados, $id)
    {
        $entrega = Entrega::findOrFail($id);
        $entrega->update($dados);
        return $entrega;
    }
}