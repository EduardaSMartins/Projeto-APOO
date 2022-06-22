<?php

namespace Modules\Conta\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parcela extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_conta',
        'data_venc',
        'numero_parcela',
        'data_pagamento',
        'parcela_paga',
        'observacao'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }
}
