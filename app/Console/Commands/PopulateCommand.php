<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Deputado;
use App\Models\Despesa;
use GuzzleHttp\Client;

class PopulateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:deputados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making the database populate with Deputados';

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
        for ($i = 1; $i < 7; ++$i) {
            $this->info('Carregando pagina '.$i.' de Deputados');

            $client = new Client();
            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));
            // dd(($resJson));

            foreach ($resJson->dados as $key => $dep) {
                $deputado = Deputado::firstOrCreate(array(
                    'id' => $dep->id,
                    'nome' => $dep->nome,
                    'siglaPartido' => $dep->siglaPartido,
                    'siglaUf' => $dep->siglaUf,
                    'idLegislatura' => $dep->idLegislatura,
                ));
                
            }
        }
    }
}
