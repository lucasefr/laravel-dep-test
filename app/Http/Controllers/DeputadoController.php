<?php

namespace App\Http\Controllers;

use App\Models\Deputado;
use Illuminate\Http\Request;

use GuzzleHttp\Client;

class DeputadoController extends Controller
{
    public function getData(){

        $client = new Client();
        $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados?itens=100');
        $resJson = (json_decode($response->getBody()->getContents()));
        // dd(($resJson));
        foreach ($resJson->dados as $key => $dep) {
            $deputado = Deputado::firstOrCreate(array(
                'id'              => $dep->id,
                'nome'            => $dep->nome,
                'siglaPartido'    => $dep->siglaPartido,
                'siglaUf'         => $dep->siglaUf,
                'idLegislatura'   => $dep->idLegislatura
            ));
        }

        $client2 = new Client();
        $response2 = $client2->get('https://dadosabertos.camara.leg.br/api/v2/deputados?&pagina=2&itens=100');
        $resJson2 = (json_decode($response2->getBody()->getContents()));
        // dd(($resJson2));
        foreach ($resJson2->dados as $key => $dep) {
            $deputado2 = Deputado::firstOrCreate(array(
                'id'              => $dep->id,
                'nome'            => $dep->nome,
                'siglaPartido'    => $dep->siglaPartido,
                'siglaUf'         => $dep->siglaUf,
                'idLegislatura'   => $dep->idLegislatura
            ));
        }

        $client3 = new Client();
        $response3 = $client3->get('https://dadosabertos.camara.leg.br/api/v2/deputados?&pagina=3&itens=100');
        $resJson3 = (json_decode($response3->getBody()->getContents()));
        // dd(($resJson2));
        foreach ($resJson3->dados as $key => $dep) {
            $deputado3 = Deputado::firstOrCreate(array(
                'id'              => $dep->id,
                'nome'            => $dep->nome,
                'siglaPartido'    => $dep->siglaPartido,
                'siglaUf'         => $dep->siglaUf,
                'idLegislatura'   => $dep->idLegislatura
            ));
        }

        $client4 = new Client();
        $response4 = $client4->get('https://dadosabertos.camara.leg.br/api/v2/deputados?&pagina=4&itens=100');
        $resJson4 = (json_decode($response4->getBody()->getContents()));
        // dd(($resJson2));
        foreach ($resJson4->dados as $key => $dep) {
            $deputado4 = Deputado::firstOrCreate(array(
                'id'              => $dep->id,
                'nome'            => $dep->nome,
                'siglaPartido'    => $dep->siglaPartido,
                'siglaUf'         => $dep->siglaUf,
                'idLegislatura'   => $dep->idLegislatura
            ));
        }

        $client5 = new Client();
        $response5 = $client5->get('https://dadosabertos.camara.leg.br/api/v2/deputados?&pagina=5&itens=100');
        $resJson5 = (json_decode($response5->getBody()->getContents()));
        // dd(($resJson2));
        foreach ($resJson5->dados as $key => $dep) {
            $deputado5 = Deputado::firstOrCreate(array(
                'id'              => $dep->id,
                'nome'            => $dep->nome,
                'siglaPartido'    => $dep->siglaPartido,
                'siglaUf'         => $dep->siglaUf,
                'idLegislatura'   => $dep->idLegislatura
            ));
        }

        $client6 = new Client();
        $response6 = $client6->get('https://dadosabertos.camara.leg.br/api/v2/deputados?&pagina=6&itens=100');
        $resJson6 = (json_decode($response6->getBody()->getContents()));
        // dd(($resJson2));
        foreach ($resJson6->dados as $key => $dep) {
            $deputado6 = Deputado::firstOrCreate(array(
                'id'              => $dep->id,
                'nome'            => $dep->nome,
                'siglaPartido'    => $dep->siglaPartido,
                'siglaUf'         => $dep->siglaUf,
                'idLegislatura'   => $dep->idLegislatura
            ));
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
     * @param  \App\Models\Deputado  $deputado
     * @return \Illuminate\Http\Response
     */
    public function show(Deputado $deputado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deputado  $deputado
     * @return \Illuminate\Http\Response
     */
    public function edit(Deputado $deputado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deputado  $deputado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deputado $deputado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deputado  $deputado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deputado $deputado)
    {
        //
    }
}
