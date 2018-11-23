<?php

namespace App\Http\Controllers;

use App\Models\Deputado;
use Illuminate\Http\Request;

class DeputadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deputado = Deputado::with('despesas')->get();

        // foreach ($deputado as $key => $dep) {
        //     if ($dep->proposicaos != null) {
        //         echo $dep->proposicao;
        //     }
        // }

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
