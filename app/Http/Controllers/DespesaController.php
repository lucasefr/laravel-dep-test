<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Despesa;
use App\Models\Deputado;
use App\Models\Proposicao;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DespesaController extends Controller
{
    public function getData()
    {
        $client = new Client();
        $uri = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?itens=100');
        $uriJson = (json_decode($uri->getBody()->getContents()));
        $b = 0;
        $c = 1;
        foreach ($uriJson->links as $key => $ref) {
            if ($ref->rel == 'last') {
                $page = explode('=', $ref->href);
                $a = substr($page[1], 0, 2);
            }
        }
        for ($i = 1; $i <= 2; ++$i) {
            // $this->info('Carregando pagina '.$i.' de Proposições');

            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));
            // print_r($i.' -a-');

            foreach ($resJson->dados as $key => $prop) {
                $b = $b + 1;
                $resProposicao = $client->get($prop->uri);
                $propJson = (json_decode($resProposicao->getBody()->getContents()));

                $resAutores = $client->get($prop->uri.'/autores');
                $propAutores = (json_decode($resAutores->getBody()->getContents()));
                // print_r($b.' b');
                foreach ($propAutores->dados as $key => $autores) {
                    // dd($autores);
                    if ($autores->uri != null) {
                        // dd($autores->nome);
                        $proposicao = Proposicao::firstOrCreate(array(
                            'id' => $prop->id,
                            'siglaTipo' => $prop->siglaTipo,
                            'idTipo' => $prop->idTipo,
                            'ano' => $prop->ano,
                            'ementa' => $prop->ementa,
                            'dataHora' => $propJson->dados->statusProposicao->dataHora,
                            'idSituacao' => $propJson->dados->statusProposicao->idSituacao,
                            'nomeDeputado' => $autores->nome,
                        ));
                        // print_r($c++.' c');
                    }
                }
                // dd($proposicao);
            }
        }
        // die();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $despesa = Despesa::with('deputado')->get();

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

    public function gastadores()
    {
        $sql = 'SELECT SUM(valorDocumento), dep.nome as nome,  mes from despesas desp INNER JOIN deputados dep on deputado_id = dep.id  group by nome, mes order by mes, SUM(valorDocumento) desc';

        // return DB::select($sql);

        // $despesa = DB::table('despesas')->select('id','deputado_id','ano','mes','valorDocumento')->get()->chunk(100, function ($despesa) {
        //     foreach ($despesa as $key => $des) {
        //         print_r($des->deputado_id);

        //         // foreach ($des->deputado_id as $key => $dep) {

        //         //     dd($dep);
        //         // }
        //     }
        //     die();
        // });

        // $despesa = DB::table('despesas')->select('id','deputado_id','ano','mes','valorDocumento')->distinct('deputado_id')->get();

        // $sqlString = DB::select($sql);
        // $sqlJson = json_decode($sqlString->getBody()->getContents());

        return DB::select($sql);
    }
}
