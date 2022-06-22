<?php

namespace Modules\Empresa\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Cliente\Entities\Cliente;
use Modules\Endereco\Entities\Logradouro;
use Modules\Pedido\Entities\Pedido;
use Modules\Telefone\Entities\Telefone;

class Empresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_cliente',
        'id_telefone',
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'ramo_atividade',
        'email',
        'porte'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function cadastros()
    {
        return $this->belongsToMany(Cliente::class, 'cadastros', 'id_empresa', 'id_cliente')
            ->whereNull('cadastros.deleted_at')
            ->withTimestamps()
            ->withPivot('status');
    }

    public function telefone()
    {
        return $this->hasOne(Telefone::class);
    }

    public function enderecos()
    {
        return $this->belongsToMany(Logradouro::class, 'endereco_empresas', 'id_empresa', 'id_logradouro')
            ->whereNull('endereco_empresas.deleted_at')
            ->withTimeStamps()
            ->withPivot('complemento','numero');
    }
}