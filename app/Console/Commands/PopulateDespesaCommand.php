<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PopulateDespesaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $client = new Client();

        $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados?itens=100');
        $resJson = (json_decode($response->getBody()->getContents()));

        foreach ($resJson->dados as $key => $dep) {
            $depResponse = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados/'.$dep->id.'/despesas?itens=100');
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
