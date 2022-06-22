<?php

namespace Modules\Cliente\Http\Traits;

use Modules\Cliente\Entities\Cliente;
use Modules\Empresa\Http\Traits\EmpresaTrait;
use Modules\Telefone\Http\Traits\TelefoneTrait;

trait ClienteTrait
{
    use EmpresaTrait;
    use TelefoneTrait;

    //Cria cadastro de novo cliente
    public function saveUpdateCliente($dados, $id = null)
    {
        $dados_cliente = $dados['cliente'];
        $dados_empresa = $dados['empresa'];
        $dados_telefone = $dados_cliente['telefone'];

        $telefone = $this->saveUpdateTelefone($dados_telefone);
        $dados_cliente['id_telefone'] = $telefone->id;

        if (is_null($id)) {
            $cliente = Cliente::where('cpf', $dados->cpf)->first();
            if (is_null($cliente)) {
                $cliente = Cliente::create($dados_cliente);
                $dados_empresa['id_cliente'] = $cliente->id;
                $empresa = $this->saveUpdateEmpresa($dados_empresa);
                $cadastro[$empresa->id] = ['status' => 'pendente'];
                $cliente->cadastros()->attach($cadastro);
            } else {
                $cliente = Cliente::findOrFail($id);
                $cliente->update($dados_cliente);
                $empresa = $this->saveUpdateEmpresa($dados_empresa, $dados_empresa['id']);
            }
        } else {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($dados_cliente);
            $empresa = $this->saveUpdateEmpresa($dados_empresa, $dados_empresa['id']);
        }

        return $cliente;
    }
}
