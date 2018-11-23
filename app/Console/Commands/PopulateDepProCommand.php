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
        //Criação de novo cliente HTTP
        $client = new Client();
        //uri para acesso dos projetos
        $uri = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?itens=100');
        //Parse no conteudo
        $uriJson = (json_decode($uri->getBody()->getContents()));
        //Pegando numeração de paginas de conteudo
        foreach ($uriJson->links as $key => $ref) {
            if ($ref->rel == 'last') {
                $page = explode('=', $ref->href);
                $a = substr($page[1], 0, 2);
            }
        }
        //For para percorrer todas as paginas
        for ($i = 1; $i <= $a; ++$i) {
            $this->info('Carregando pagina '.$i.' de '.$a.' tabelas Pivot');

            //uri para acesso de projetos por pagina
            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));

            //foreach para pegar os dados dos autores de cada projeto
            foreach ($resJson->dados as $key => $prop) {
                $resAutores = $client->get($prop->uri.'/autores');
                $propAutores = (json_decode($resAutores->getBody()->getContents()));

                //foreach para pegar o id do deputado relacionado a proposta
                foreach ($propAutores->links as $key => $link) {
                    $deputadoid = explode('/', $link->href);
                }

                //foreach para salvar o deputado no banco
                foreach ($propAutores->dados as $key => $autores) {
                    //if para salvar informações apenas deputados
                    if ($autores->uri != null) {
                        $proposicaoid = explode('/', $autores->uri);
                        //salvando dados da tabela pivot
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
