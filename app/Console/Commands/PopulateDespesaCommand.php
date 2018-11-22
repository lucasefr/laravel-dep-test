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
            $this->info('Carregando pagina '.$i.' de Deputados');

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
                    $this->info('Carregando pagina '.$count.'.'.$i.'.'.$j.' de Despesas do deputado '.$dep->nome);
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
}
