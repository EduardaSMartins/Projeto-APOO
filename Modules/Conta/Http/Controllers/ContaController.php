<?php

namespace Modules\Conta\Http\Controllers;

use App\Http\Traits\softDeleteTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Conta\Entities\Conta;
use Modules\Conta\Entities\Parcela;
use Modules\Conta\Http\Requests\ContaRequest;
use Modules\Conta\Http\Requests\ParcelaRequest;
use Modules\Conta\Http\Traits\ContaTrait;
use Modules\Conta\Http\Traits\ParcelaTrait;
use Modules\Conta\Transformers\ContaResource;
use Modules\Conta\Transformers\ParcelaResource;

class ContaController extends Controller
{
    use ContaTrait;
    use ParcelaTrait;
    use softDeleteTrait;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('conta::index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ContaRequest $request, $id)
    {
        $dados_conta = $request->input('conta');
        DB::beginTransaction();
        $situacaoFinanceira = $this->situacaoFinanceira($dados_conta['id_pedido']);
        if(!is_null($situacaoFinanceira))
            $dados_conta['quantidade_parcelas'] = 1;
        $conta = $this->saveUpdateConta($dados_conta);
        DB::commit();
        return response()->json(new ContaResource($conta), 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showConta($id)
    {
        $conta = Conta::findOrFail($id);
        return response()->json(new ContaResource($conta), 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showParcela($id)
    {
        $parcela = Parcela::findOrFail($id);
        return response()->json(new ParcelaResource($parcela), 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateConta(ContaRequest $request, $id)
    {
        $dados_conta = $request->input('conta');
        DB::beginTransaction();
        $conta = $this->saveUpdateConta($dados_conta, $id);
        DB::commit();
        return response()->json(new ContaResource($conta), 200);
    }

    public function updateParcela(ParcelaRequest $request, $id)
    {
        $dados_parcela = $request->input('parcela');
        DB::beginTransaction();
        $parcela = $this->saveUpdateParcela($dados_parcela, $id);
        DB::commit();
        return response()->json(new ParcelaResource($parcela), 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $conta = Conta::findOrFail($id);

        DB::beginTransaction();
        $this->softDeleteMany('parcelas', $conta);
        $conta->delete();
        DB::commit();

        return response()->json(new ContaResource($conta), 200);
    }
}
