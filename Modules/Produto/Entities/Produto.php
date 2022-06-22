<?php

namespace Modules\Produto\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_categoria',
        'nome',
        'descricao',
        'codigo_barras',
        'codigo_interno',
        'sabor',
        'cor',
        'tamanho',
        'quantidade_minima',
        'quantidade_caixa',
        'quantidade_estoque',
        'valor_unitario'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
