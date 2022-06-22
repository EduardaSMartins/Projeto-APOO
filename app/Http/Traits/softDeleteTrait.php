<?php

namespace App\Http\Traits;

trait softDeleteTrait {

    // Exclui relações N-N
    //$collection: coleção de dados a serem excluídos (forma utilizada para a função ser genérica)
    public function softDeleteMany($collection,$model){

        foreach($model->$collection as $c){
            $model->$collection()->updateExistingPivot($c->id, ['deleted_at' => now()]);
        }
        return true;
    }
}