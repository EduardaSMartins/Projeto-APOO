<?php

namespace Modules\Produto\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Pedido\Entities\Pedido;
use Modules\Troca\Entities\Troca;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_produto',
        'quantidade',
        'valor',
        'valor_total'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    protected function produto()
    {
        return $this->hasOne(Produto::class);
    }

    protected function pedido()
    {
        return $this->belongsToMany(Pedido::class, 'itens_pedido', 'id_item', 'id_pedido')
            ->whereNull('itens_pedido.deleted_at')
            ->withTimeStamps();
    }

    protected function troca()
    {
        return $this->belongsToMany(Troca::class, 'item_trocas', 'id_item', 'id_troca')
            ->whereNull('item_trocas.deleted_at')
            ->withTimeStamps();
    }

}
