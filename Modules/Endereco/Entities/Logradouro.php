<?php

namespace Modules\Endereco\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Empresa\Entities\Empresa;

class Logradouro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_bairro',
        'descricao',
        'cep'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    public function bairro()
    {
        return $this->belongsTo(Bairro::class, 'id_bairro');
    }

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'endereco_empresas', 'id_logradouro', 'id_empresa')
        ->whereNull('endereco_empresas.deleted_at')
        ->withTimestamps()
        ->withPivot('complemento','numero');
    }

    public function cadastros()
    {
        return $this->belongsToMany(Empresa::class, 'cadastros', 'id_cliente', 'id_empresa')
            ->whereNull('cadastros.deleted_at')
            ->withTimestamps()
            ->withPivot('status');
    }
}
