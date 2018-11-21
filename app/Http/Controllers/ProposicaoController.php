<?php

namespace App\Http\Controllers;

use App\Models\Proposicao;
use Illuminate\Http\Request;

use GuzzleHttp\Client;

class ProposicaoController extends Controller
{
    public function getData(){
        for ($i = 1; $i < 32; ++$i) {
            // $this->info('Carregando pagina '.$i.' de Deputados');

            $client = new Client();
            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?&pagina='.$i.'1&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));
            
            $count = 1;
            foreach ($resJson->dados as $key => $prop) {
                
                $resProposicao = $client->get($prop->uri);
                $propJson = (json_decode($resProposicao->getBody()->getContents()));

                $proposicao = Proposicao::firstOrCreate(array(
                    'id' => $prop->id,
                    'siglaTipo' => $prop->siglaTipo,
                    'idTipo' => $prop->idTipo,
                    'ano' => $prop->ano,
                    'ementa' => $prop->ementa,
                    'dataHora' => $propJson->dados->statusProposicao->dataHora,
                    'idSituacao' => $propJson->dados->statusProposicao->idSituacao,
                ));

                
                
            }
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
        return "hello";
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
     * @param  \App\Models\Proposicao  $proposicao
     * @return \Illuminate\Http\Response
     */
    public function show(Proposicao $proposicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposicao  $proposicao
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposicao $proposicao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposicao  $proposicao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposicao $proposicao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposicao  $proposicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposicao $proposicao)
    {
        //
    }
}
