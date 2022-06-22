<?php

namespace Modules\Conta\Http\Traits;

use App\Http\Traits\softDeleteTrait;
use Modules\Conta\Entities\Conta;
use Modules\Empresa\Entities\Empresa;
use Modules\Pedido\Entities\Pedido;

trait ContaTrait
{
    use ParcelaTrait;

    public function saveUpdateConta($dados, $id = null)
    {
        if(is_null($id)){
            $conta = Conta::create($dados);
            $dados_parcela['id_conta'] = $conta->id;
            $dados_parcela['valor'] = $conta->valor;
            $dados_parcela['data_vencimento'] = $conta->data_vencimento;
            $dados_parcela['qtde_parcelas'] = $conta->numero_parcelas;
            $parcelas = $this->saveUpdateParcela($dados_parcela);
            $conta->parcelas()->attach($parcelas);
        }else{
            $conta = Conta::findOrFail($id);
            if(($dados['valor'] != $conta['valor']) || ($dados['numero_parcelas'] != $conta['numero_parcelas'])){
                $error = [
                    'status' => 400,
                    'title' => 'Os campos de valor e quantidade de parcelas não podem ser modificados!',
                    'detail' => null,
                    'data' => null
                ];
                return response()->json($error,400);
            }else{
                $conta->update($dados);
            }
        }
        return $conta;
    }

    public function situacaoFinanceira($id)
    {
        $pendencias = [];
        $pedidos = Pedido::where('id_empresa',$id)->get();
        foreach($pedidos as $pedido){
            foreach($pedido->parcelas as $parcela){
                if(($parcela->data_vencimento < now()) && ($parcela->parcela_paga == 0))
                    $pendencias[] = $parcela->data_vencimento;
            }
        }
        return $pendencias;
    }
}
