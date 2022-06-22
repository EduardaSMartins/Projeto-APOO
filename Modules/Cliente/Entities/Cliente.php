<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Empresa\Entities\Empresa;
use Modules\Telefone\Entities\Telefone;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_telefone',
        'cpf',
        'rg',
        'rg_orgao',
        'rg_uf',
        'nome',
        'sobrenome',
        'email',
        'data_nascimento'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    protected $table = 'clientes';

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }

    public function telefone()
    {
        return $this->hasOne(Telefone::class);
    }

    public function cadastros()
    {
        return $this->belongsToMany(Empresa::class, 'cadastros', 'id_cliente', 'id_empresa')
            ->whereNull('cadastros.deleted_at')
            ->withTimestamps()
            ->withPivot('status');
    }
}
