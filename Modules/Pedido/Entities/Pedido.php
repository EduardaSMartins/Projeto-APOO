<?php

namespace Modules\Pedido\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Empresa\Entities\Empresa;
use Modules\Entrega\Entities\Entrega;
use Modules\Produto\Entities\Item;

class Pedido extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_empresa',
        'data_pedido',
        'valor_final',
        'status',
        'observacao'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    // protected function entrega()
    // {
    //     return $this->belongsTo(Entrega::class);
    // }

    public function entrega()
    {
        return $this->hasOne(Entrega::class);
    }

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'itens_pedidos', 'id_pedido', 'id_item')
            ->whereNull('itens_pedidos.deleted_at')
            ->withTimeStamps();
    }
}
