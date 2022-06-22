<?php

namespace Modules\Conta\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Pedido\Entities\Pedido;

class Conta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pedido',
        'data_vencimento',
        'data_efetivacao',
        'valor',
        'descricao',
        'numero_parcelas',
        'periodicidade',
        'observacao'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function pedido()
    {
        return $this->hasOne(Pedido::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }
}
