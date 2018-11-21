<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Despesa;
use GuzzleHttp\Client;

class PopulateDespesaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:despesas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making the database populate with Despesas';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        for ($i = 1; $i < 7; ++$i) {
            $this->info('Carregando pagina '.$i.' de Deputados');

            $client = new Client();
            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));
            // dd(($resJson));
            $count = 1;
            foreach ($resJson->dados as $key => $dep) {
                // $deputado = Deputado::firstOrCreate(array(
                //     'id' => $dep->id,
                //     'nome' => $dep->nome,
                //     'siglaPartido' => $dep->siglaPartido,
                //     'siglaUf' => $dep->siglaUf,
                //     'idLegislatura' => $dep->idLegislatura,
                // ));
                for ($j = 1; $j < 50; ++$j) {
                    $this->info('Carregando pagina '.$count.'.'.$j.' de Despesas do deputado '.$dep->nome);
                    $depResponse = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados/'.$dep->id.'/despesas?&pagina='.$j.'&itens=100');
                    $depJson = (json_decode($depResponse->getBody()->getContents()));
                    $count = $count++;
                    foreach ($depJson->dados as $key => $depDespesa) {
                        if ($depDespesa->ano == 2018) {
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
    }
}
