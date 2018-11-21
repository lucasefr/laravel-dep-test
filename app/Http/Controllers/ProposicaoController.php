<?php

namespace App\Http\Controllers;

use App\Models\Proposicao;
use App\Models\DepProp;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class ProposicaoController extends Controller
{
    public function getData(){
        for ($i = 1; $i < 32; ++$i) {
            // $this->info('Carregando pagina '.$i.' de Proposições');

            $client = new Client();
            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));
            
            foreach ($resJson->dados as $key => $prop) {
                
                $resAutores = $client->get($prop->uri.'/autores');
                $propAutores = (json_decode($resAutores->getBody()->getContents()));

                // dd($propAutores->links);
                foreach ($propAutores->links as $key => $link) {
                    $deputadoid = explode('/', $link->href);
                }
                
                // dd($deputadoid[6]);
                foreach ($propAutores->dados as $key => $autores) {
                    // dd($autores->uri);
                    if ($autores->uri != null) {
                        
                        $proposicaoid =  explode('/',$autores->uri);
                        // $deputadoid = explode('/', $propAutores->links->href);
                        
                        // print_r($deputadoid[6]);
                        // print_r('-');
                        // print_r($proposicaoid[6]);
                        // // die();
                        $depProp = DepProp::firstOrCreate(array(
                            'deputado_id' => $deputadoid[6],
                            'proposicaos_id' => $proposicaoid[6],
                        ));
                    }
                }

                
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
