<?php

namespace Modules\Entrega\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Pedido\Entities\Pedido;

class Entrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pedido',
        'data_efetuacao',
        'data_entrega_estimada',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
