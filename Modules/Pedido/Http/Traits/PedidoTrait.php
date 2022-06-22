<?php

namespace Modules\Pedido\Http\Traits;

use App\Http\Traits\softDeleteTrait;
use Exception;
use Modules\Pedido\Entities\Pedido;
use Modules\Produto\Entities\Item;
use Modules\Produto\Http\Traits\ItemTrait;

trait PedidoTrait
{
    use ItemTrait;
    use softDeleteTrait;

    //Cria cadastro de novo cliente
    public function saveUpdatePedido($dados, $id = null)
    {
        $dados_itens = $dados['items'];
        if (is_null($id)) {
            $dados['data_pedido'] = now()->format('Y-m-d');
            $dados['status'] = 'aguardando';
            $pedido = Pedido::create($dados);
        } else {
            try {
                $sixOClock = '18:00:00';
                $now = now()->format('H:i:s');

                if (now()->lessThanOrEqualTo($sixOClock)) {
                    $pedido = Pedido::findOrFail($id);
                    foreach($pedido->items as $item){

                        $i = Item::findOrFail($item);
                    }

                    $this->softDeleteMany('items', $pedido);
                }
            } catch (Exception $e) {
                $error = [
                    'status' => 400,
                    'title' => 'O pedido não pode ser editado!',
                    'detail' => 'O horário para editar pedidos foi atingido',
                    'data' => null
                ];
                return response()->json($error, 400);
            }
        }

        $itens = [];
        $valor_final = 0;
        foreach ($dados_itens as $item) {
            $new_item = $this->saveItem($item);
            $itens[] = $new_item->id;
            $valor_final += $new_item->valor_total;
        }

        $pedido->items()->attach($itens);
        $pedido['valor_final'] = $valor_final;
        $pedido->save();
        return $pedido;
    }

    public function softDeleteManyItems($items,$pedido){

        foreach($items as $item){
            $item = Item::findOrFail($item->id);
            
            $pedido->$item()->updateExistingPivot($item->id, ['deleted_at' => now()]);
        }
        return true;
    }
}
