<?php

namespace Modules\Produto\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Produto\Entities\Produto;
use Modules\Produto\Http\Requests\ProdutoRequest;
use Modules\Produto\Http\Traits\ProdutoTrait;
use Modules\Produto\Services\ProdutoService;
use Modules\Produto\Transformers\ProdutoResource;

class ProdutoController extends Controller
{
    use ProdutoTrait;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // Usar o ProdutoService pra fazer paginate - testar a listagem
        
        // $produtos = Produto::where('quantidade_estoque','>', 0)->get();
        // return response()->json(ProdutoResource::collection($produtos));
        $produtos = ProdutoService::findProduto();
        return response()->json($produtos, 200);    
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProdutoRequest $request)
    {
        $dados_produto = $request->input('produto');
        DB::beginTransaction();

        $produto = $this->saveProduto($dados_produto);

        DB::commit();
        return response()->json(new ProdutoResource($produto), 200);        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return response()->json(new ProdutoResource($produto), 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProdutoRequest $request, $id)
    {
        $dados_produto = $request->input('produto');
        DB::beginTransaction();

        $produto = $this->updateProduto($dados_produto, $id);

        DB::commit();
        return response()->json(new ProdutoResource($produto), 200);
    }
}
