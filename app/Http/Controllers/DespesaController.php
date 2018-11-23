<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Despesa;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $despesa = Despesa::all();

        return $despesa;
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
     * @param \App\Models\Despesa $despesa
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Despesa $despesa)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Despesa $despesa
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Despesa $despesa)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Despesa      $despesa
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Despesa $despesa)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Despesa $despesa
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despesa $despesa)
    {
    }

    public function gastos()
    {
        $sql = 'SELECT SUM(valorDocumento) AS soma, dep.nome AS nome,  mes
        FROM despesas desp INNER JOIN deputados dep ON deputado_id = dep.id
        GROUP BY nome, mes ORDER BY mes, soma DESC';

        return DB::select($sql);
    }
}
