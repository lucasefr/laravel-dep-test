<?php

namespace App\Http\Controllers;

use App\Models\Proposicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProposicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

    public function projetos()
    {
        $sql = 'SELECT COUNT(nomeDeputado) as total , nomeDeputado
        FROM proposicaos GROUP BY nomeDeputado ORDER BY total DESC limit 10';

        return DB::select($sql);
    }
}
