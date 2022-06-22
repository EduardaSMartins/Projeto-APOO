<?php

namespace Modules\Conta\Http\Traits;

use App\Http\Traits\softDeleteTrait;
use Carbon\Carbon;
use Modules\Conta\Entities\Parcela;

trait ParcelaTrait
{

    public function saveUpdateParcela($dados, $id = null)
    {
        if (is_null($id)) {
            $parcelas = $this->criaParcelas($dados);
            return $parcelas;
        } else {
            $parcela = Parcela::findOrFail($id);
            if (($parcela['valor'] != $dados['valor']) ||
                ($parcela['data_vencimento'] != $dados['data_vencimento'])($parcela['numero_parcela'] != $dados['numero_parcela'])
            ) {
                $error = [
                    'status' => 400,
                    'title' => 'Os campos de valor e quantidade de parcelas não podem ser modificados!',
                    'detail' => null,
                    'data' => null
                ];
                return response()->json($error, 400);
            }else{
                $parcela->update($dados);
            }
            return $parcela;
        }
    }

    public function criaParcelas($dados)
    {
        $valorParcelas = $dados['valor'] / $dados['qtde_parcelas'];
        $vencimento = $dados->data_vencimento;
        $parcelas = [];
        for($parcela = 1; $parcela <= $dados['qtde_parcelas']; $parcela++){
            $novaParcela['id_conta'] = $dados->id_conta;
            $novaParcela['valor'] = $valorParcelas;
            $vencimento = $vencimento->addDays(7);

            if ($vencimento->isSaturday()) {
                $vencimento->addDays(2);
            } elseif ($vencimento->isSunday()) {
                $vencimento->addDay();
            }

            $vencimento = Carbon::parse($vencimento)->format("Y-m-d");
            $novaParcela['data_vencimento'] = $vencimento;
            $novaParcela['numero_parcela'] = $parcela;
            $novaParcela['parcela_paga'] = 0;
            $parcelas[] = Parcela::create($novaParcela); 
        }
        return $parcelas;
    }
}
