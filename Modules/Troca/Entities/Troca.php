<?php

namespace Modules\Troca\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Produto\Entities\Item;

class Troca extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_empresa',
        'data_solicitacao',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    protected function items()
    {
        return $this->belongsToMany(Item::class, 'item_trocas', 'id_troca', 'id_item')
            ->whereNull('item_trocas.deleted_at')
            ->withTimeStamps();
    }
}
