<?php

namespace Modules\Empresa\Http\Traits;

use App\Http\Traits\softDeleteTrait;
use Modules\Empresa\Entities\Empresa;
use Modules\Endereco\Http\Traits\LogradouroTrait;
use Modules\Endereco\Http\Traits\MunicipioTrait;
use Modules\Telefone\Http\Traits\TelefoneTrait;
use Modules\Endereco\Http\Traits\BairroTrait;

trait EmpresaTrait
{
    use TelefoneTrait;
    use MunicipioTrait;
    use BairroTrait;
    use LogradouroTrait;
    use softDeleteTrait;

    //Cria nova empresa
    public function saveUpdateEmpresa($dados, $id = null)
    {
        $dados_telefone = $dados['telefone'];
        $dados_endereco = $dados['enderecos'];

        if (is_null($id)) {
            $empresa = Empresa::create($dados);
        } else {
            $empresa = Empresa::findOrFail($id);
            $this->saveUpdateTelefone($dados_telefone,$dados_telefone['id']);
            $this->softDeleteMany('enderecos', $empresa);
        }

        $telefone = $this->saveUpdateTelefone($dados_telefone);
        $dados['id_telefone'] = $telefone->id;

        //Criar e atribuir endereço à empresa
        $enderecos = $this->createEndereco($dados_endereco, $empresa);
        $empresa->enderecos()->attach($enderecos);

        $empresa->update($dados);
        return $empresa;
    }

    public function createEndereco($enderecos, $empresa)
    {
        foreach ($enderecos as $endereco) {
            $dados_endereco = $endereco['endereco'];
            $dados_logradouro = $endereco['logradouro'];
            $dados_bairro = $endereco['bairro'];
            $dados_municipio = $endereco['municipio'];

            $municipio = $this->saveUpdateMunicipio($dados_municipio);
            $dados_bairro['id_municipio'] = $municipio->id;
            $bairro = $this->saveUpdateBairro($dados_bairro);
            $dados_logradouro['id_bairro'] = $bairro->id;
            $logradouro = $this->saveUpdateLogradouro($dados_logradouro);

            $ends[$logradouro->id] = ['complemento' => $dados_endereco['complemento'], 'numero' => $dados_endereco['numero']];
        }
        return $ends;
    }
}
