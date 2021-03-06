<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Deputado;
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
        //Criação de novo cliente HTTP
        $client = new Client();
        //uri para acesso das projetos
        $uri = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados?itens=100');
        //Parse no conteudo
        $uriJson = (json_decode($uri->getBody()->getContents()));
        //Pegando numeração de paginas de conteudo
        foreach ($uriJson->links as $key => $ref) {
            if ($ref->rel == 'last') {
                $page = explode('=', $ref->href);
                $a = substr($page[1], 0, 1);
            }
        }
        //For para percorrer todas as paginas
        for ($i = 1; $i <= $a; ++$i) {
            $this->info('Carregando pagina '.$i.' de Deputados');

            //uri para acesso de deputados por pagina
            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/deputados?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));
            
            //foreach para salvar o deputado no banco
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
