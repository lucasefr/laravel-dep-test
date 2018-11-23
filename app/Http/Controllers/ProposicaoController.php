<?php

namespace App\Http\Controllers;

use App\Models\Proposicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProposicaoController extends Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Projeto Gastadores",
     *      description="Projeto Gastadores",
     *      @OA\Contact(
     *          email="lucasefr@gmail.com"
     *      ),
     *     @OA\License(
     *         name="Lucas Emanuel  ",
     *         url=""
     *     )
     * )
     */

    /**
     * @OA\Get(
     *      path="/api/proposicaos",
     *      tags={"projetos"},
     *      summary="Retorna lista de todo os projetos da Camara",
     *      description="Retorna lista de todo os projetos da Camara",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      
     *
     *     )
     *
     * Returns list of projects
     */
    public function index()
    {
        $proposicao = Proposicao::with('deputados')->get();

        return Proposicao::all();
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
     * @param \App\Models\Proposicao $proposicao
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Proposicao $proposicao)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Proposicao $proposicao
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposicao $proposicao)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Proposicao   $proposicao
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposicao $proposicao)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Proposicao $proposicao
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposicao $proposicao)
    {
    }
     /**
     * @OA\Get(
     *      path="/api/proposicaos/projetos",
     *      tags={"projetos"},
     *      summary="Retorna lista com a soma de projetos dos 10 deputados",
     *      description="Retorna lista com os 10 deputado que mais enviaram projetos para analise",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      
     *
     *     )
     *
     * Top Ten Projects
     */
    public function projetos()
    {
        $sql = 'SELECT COUNT(nomeDeputado) as total , nomeDeputado
        FROM proposicaos GROUP BY nomeDeputado ORDER BY total DESC limit 10';

        return DB::select($sql);
    }
}
