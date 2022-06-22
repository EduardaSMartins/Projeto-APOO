<?php

namespace Modules\Pedido\Services;

use Modules\Pedido\Entities\Pedido;

class PedidoService
{
    public static function findPedidos($data = null)
    {
        if (is_null($data)) {
            // $hoje_inicio = now()->toDateTimeString();
            // dd($hoje_inicio); 
            // // $hoje_fim =
            $hoje = now()->toDateString();
            $pedidos = Pedido::where('data_pedido', $hoje)->get();
        } else {
            $pedidos = Pedido::where('created_at', $data)->get();
        }
        return $pedidos;
    }
}
