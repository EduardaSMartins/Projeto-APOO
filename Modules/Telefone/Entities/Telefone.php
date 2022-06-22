<?php

namespace Modules\Telefone\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Cliente\Entities\Cliente;
use Modules\Empresa\Entities\Empresa;

class Telefone extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'numero',
        'tipo',
        'observacao'
    ];
    
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    protected function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    protected function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}
