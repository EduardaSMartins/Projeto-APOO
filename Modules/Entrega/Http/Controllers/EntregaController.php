<?php

namespace Modules\Entrega\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Entrega\Entities\Entrega;
use Modules\Entrega\Http\Requests\EntregaRequest;
use Modules\Entrega\Http\Traits\EntregaTrait;
use Modules\Entrega\Services\EntregaService;
use Modules\Entrega\Transformers\EntregaResource;

class EntregaController extends Controller
{
    use EntregaTrait;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $entregas = EntregaService::findEntregas();
        return response()->json($entregas, 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $entrega = Entrega::findOrFail($id);
        return response()->json(new EntregaResource($entrega),200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(EntregaRequest $request, $id)
    {
        $dados_entrega = $request->input();
        
        DB::beginTransaction();
        $entrega = $this->updateEntrega($dados_entrega, $id);
        DB::commit();
        
        return response()->json(new EntregaResource($entrega), 200);
    }
}
