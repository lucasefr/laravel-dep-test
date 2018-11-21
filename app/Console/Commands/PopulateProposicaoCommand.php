<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Proposicao;

use GuzzleHttp\Client;

class PopulateProposicaoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:proposicao';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making the database populate with Proposicao';

    /**
     * Create a new command instance.
     *
     * @return void
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
        for ($i = 1; $i < 32; ++$i) {
            $this->info('Carregando pagina '.$i.' de Proposições');

            $client = new Client();
            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));
            
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
}
