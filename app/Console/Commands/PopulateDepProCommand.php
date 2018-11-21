<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DepProp;
use GuzzleHttp\Client;

class PopulateDepProCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:depProp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the pivot table of Deputado and Proposicao';

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
        //
        for ($i = 1; $i < 32; ++$i) {
            $this->info('Carregando pagina '.$i.' de Proposições');

            $client = new Client();
            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));
            
            foreach ($resJson->dados as $key => $prop) {
                
                $resAutores = $client->get($prop->uri.'/autores');
                $propAutores = (json_decode($resAutores->getBody()->getContents()));

                foreach ($propAutores->links as $key => $link) {
                    $deputadoid = explode('/', $link->href);
                }
                
                foreach ($propAutores->dados as $key => $autores) {
                
                    if ($autores->uri != null) {
                        
                        $proposicaoid =  explode('/',$autores->uri);
                        $depProp = DepProp::firstOrCreate(array(
                            'deputado_id' => $deputadoid[6],
                            'proposicao_id' => $proposicaoid[6],
                        ));
                    }
                }

                
            }
        }
    }
}