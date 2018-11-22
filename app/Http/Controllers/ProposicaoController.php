<?php

namespace App\Http\Controllers;

use App\Models\Proposicao;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProposicaoController extends Controller
{
    public function getData()
    {
        $count = 0;
        $client = new Client();
        $uri = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados?itens=100');
        $uriJson = (json_decode($uri->getBody()->getContents()));
        foreach ($uriJson->links as $key => $refa) {
            if ($refa->rel == 'last') {
                $page = explode('=', $refa->href);
                $a = substr($page[1], 0, 1);
            }
        }
        for ($i = 1; $i <= $a; ++$i) {
            // $this->info('Carregando pagina '.$i.' de Deputados');

            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));

            foreach ($resJson->dados as $key => $dep) {
                $count = $count + 1;
                $uri2 = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados/'.$dep->id.'/despesas?&ano=2017&itens=100');
                $uri2Jason = (json_decode($uri2->getBody()->getContents()));
                foreach ($uri2Jason->links as $key => $refb) {
                    if ($refb->rel == 'last') {
                        $pageDesp = explode('=', $refb->href);
                        $b = substr($pageDesp[2], 0, 1);
                    }
                }

                for ($j = 1; $j <= $b; ++$j) {
                    // $this->info('Carregando pagina '.$count.'.'.$i.'.'.$j.' de Despesas do deputado '.$dep->nome);
                    $depResponse = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados/'.$dep->id.'/despesas?&pagina='.$j.'&ano=2017&itens=100');
                    $depJson = (json_decode($depResponse->getBody()->getContents()));

                    foreach ($depJson->dados as $key => $depDespesa) {
                        $despesa = Despesa::firstOrCreate(array(
                                'deputado_id' => $dep->id,
                                'ano' => $depDespesa->ano,
                                'mes' => $depDespesa->mes,
                                'tipoDespesa' => $depDespesa->tipoDespesa,
                                'dataDocumento' => $depDespesa->dataDocumento,
                                'valorDocumento' => $depDespesa->valorDocumento,
                                'idDocumento' => $depDespesa->idDocumento,
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
        return 'hello';
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
}
