<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;

use GuzzleHttp\Client;

class DespesaController extends Controller
{
    public function getData(){
        $client = new Client();
        $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados?itens=100');
        // $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados/4930/despesas?itens=100');
        $resJson = (json_decode($response->getBody()->getContents()));
        // dd(($resJson));
        foreach ($resJson->dados as $key => $dep) {
            $depResponse = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados/'.$dep->id.'/despesas?itens=100');
            $depJson = (json_decode($depResponse->getBody()->getContents()));
            // dd(($depJson));
            foreach ($depJson->dados as $key => $depDespesa) {
                # code...
                // echo $dep->id."<br>";
                // echo $depDespesa->valorDocumento."<br>"."<br>";
                $despesa = Despesa::firstOrCreate(array(
                    'deputado_id'      => $dep->id,
                    'ano'              => $depDespesa->ano,
                    'mes'              => $depDespesa->mes,
                    'tipoDespesa'      => $depDespesa->tipoDespesa,
                    'dataDocumento'    => $depDespesa->dataDocumento,
                    'valorDocumento'   => $depDespesa->valorDocumento,
                    'idDocumento'      => $depDespesa->idDocumento
                ));
            }
            
            // $deputado = Deputado::firstOrCreate(array(
            //     'id'              => $dep->id,
            //     'nome'            => $dep->nome,
            //     'siglaPartido'    => $dep->siglaPartido,
            //     'siglaUf'         => $dep->siglaUf,
            //     'idLegislatura'   => $dep->idLegislatura
            // ));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "Funcionando";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function show(Despesa $despesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function edit(Despesa $despesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Despesa $despesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despesa $despesa)
    {
        //
    }
}
