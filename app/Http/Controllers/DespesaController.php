<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Despesa;
use App\Models\Deputado;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DespesaController extends Controller
{
    // public function getData()
    // {
    //     $client = new Client();
    //     $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?itens=100');
    //     // $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados/4930/despesas?itens=100');
    //     $resJson = (json_decode($response->getBody()->getContents()));
    //     dd(($resJson->links));
    //     foreach ($resJson->dados as $key => $dep) {
    //         $depResponse = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados/'.$dep->id.'/despesas?itens=100');
    //         $depJson = (json_decode($depResponse->getBody()->getContents()));
    //         dd(($depJson));
    //         foreach ($depJson->dados as $key => $depDespesa) {
    //             // code...
    //             // echo $dep->id."<br>";
    //             // echo $depDespesa->valorDocumento."<br>"."<br>";
    //             $despesa = Despesa::firstOrCreate(array(
    //                 'deputado_id' => $dep->id,
    //                 'ano' => $depDespesa->ano,
    //                 'mes' => $depDespesa->mes,
    //                 'tipoDespesa' => $depDespesa->tipoDespesa,
    //                 'dataDocumento' => $depDespesa->dataDocumento,
    //                 'valorDocumento' => $depDespesa->valorDocumento,
    //                 'idDocumento' => $depDespesa->idDocumento,
    //             ));
    //         }
    //     }
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $despesa = Despesa::with('deputados')->get()->paginate(100);

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

    public function gastadores($mes)
    {


        $sql = 'SELECT SUM(valorDocumento), dep.nome as nome,  mes from despesas des INNER JOIN deputados dep on deputado_id = dep.id  group by nome, mes order by mes, SUM(valorDocumento) desc';
        

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
        
        $sqlJson = DB::select($sql);

        return DB::select($sql);


        

        
    }
}

$sql = 'SELECT * from despesas ds INNER JOIN deputados du on ds.deputado_id = ds.id';
