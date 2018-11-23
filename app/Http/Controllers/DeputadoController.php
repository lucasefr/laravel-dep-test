<?php

namespace App\Http\Controllers;

use App\Models\Deputado;
use Illuminate\Http\Request;

class DeputadoController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/deputados",
     *      tags={"deputados"},
     *      summary="Retorna lista de todos os deputados",
     *      description="Retorna lista de todos os deputados em exercicio",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      
     *
     *     )
     *
     * Lista de deputados
     */
    public function index()
    {
        $deputado = Deputado::with('despesas')->get();

        return $deputado;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Deputado $deputado
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Deputado $deputado)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Deputado $deputado
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Deputado $deputado)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Deputado     $deputado
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deputado $deputado)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Deputado $deputado
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deputado $deputado)
    {
    }
}
