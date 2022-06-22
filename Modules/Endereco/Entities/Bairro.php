<?php

namespace Modules\Endereco\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bairro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_municipio',
        'nome'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

    public function logradouros()
    {
        return $this->hasMany(Logradouro::class);
    }

}