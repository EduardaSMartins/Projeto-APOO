<?php

namespace Modules\Produto\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Produto\Entities\Categoria;
use Modules\Produto\Http\Requests\CategoriaRequest;
use Modules\Produto\Http\Traits\CategoriaTrait;
use Modules\Produto\Transformers\CategoriaResource;

class CategoriaController extends Controller
{
    use CategoriaTrait;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('produto::index');
    }

    public function mixin()
    {
        $categorias = Categoria::all();
        $mixin = ['categorias' => $categorias];
        return response()->json($mixin, 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CategoriaRequest $request)
    {
        $dados_categoria = $request->input('categoria');
        DB::beginTransaction();

        $categoria = $this->saveCategoria($dados_categoria);

        DB::commit();
        return response()->json(new CategoriaResource($categoria), 200);
    }
}
