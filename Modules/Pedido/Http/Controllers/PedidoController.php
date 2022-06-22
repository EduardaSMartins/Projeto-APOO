<?php

namespace Modules\Pedido\Http\Controllers;

use App\Http\Traits\softDeleteTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Pedido\Entities\Pedido;
use Modules\Pedido\Http\Requests\PedidoRequest;
use Modules\Pedido\Http\Traits\PedidoTrait;
use Modules\Pedido\Services\PedidoService;
use Modules\Pedido\Transformers\PedidoResource;

class PedidoController extends Controller
{
    use PedidoTrait;
    use softDeleteTrait;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = $request->query('filter');
        $pedidos = (new PedidoService)->findPedidos($data);
        $pedidos = PedidoResource::collection($pedidos);
        return response()->json($pedidos, 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PedidoRequest $request)
    {
        $dados_pedido = $request->input('pedido');
        DB::beginTransaction();

        $pedido = $this->saveUpdatePedido($dados_pedido);

        DB::commit();
        return response()->json(new PedidoResource($pedido), 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        return response()->json(new PedidoResource($pedido), 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PedidoRequest $request, $id)
    {
        $dados_pedido = $request->input('pedido');
        DB::beginTransaction();

        $pedido = $this->saveUpdatePedido($dados_pedido, $id);

        DB::commit();
        return response()->json(new PedidoResource($pedido), 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $pedido = Pedido::findOrFail($id);
        if ($pedido->status == 'aguardando') {
            $this->softDeleteMany('items', $pedido);
            
            //Excluir items - da tabela Item
            // foreach($)
            $pedido->delete();
            DB::commit();

            $success = [
                'status' => 200,
                'title' => 'O pedido foi excluído!',
                'detail' => 'O pedido foi removido da base do cliente',
                'data' => null
            ];
            return response()->json($success, 200);
        } elseif ($pedido->status == 'aprovado') {
            DB::rollBack();
            $error = [
                'status' => 400,
                'title' => 'O pedido não pode ser excluído!',
                'detail' => 'O pedido já foi aprovado, entre em contato com a empresa',
                'data' => null
            ];
            return response()->json($error, 400);
        } else {
            DB::rollBack();
            $error = [
                'status' => 400,
                'title' => 'O pedido não pode ser excluído!',
                'detail' => 'O pedido foi cancelado',
                'data' => null
            ];
            return response()->json($error, 400);
        }
    }
}
