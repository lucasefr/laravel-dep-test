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
        //uri para acesso das projetos
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
            $this->info('Carregando pagina '.$i.' de '.$a.' Proposições');
            //uri para acesso de projetos por pagina
            $response = $client->get('https://dadosabertos.camara.leg.br/api/v2/proposicoes?&pagina='.$i.'&itens=100');
            $resJson = (json_decode($response->getBody()->getContents()));

            //foreach para pegar os dados dos autores de cada projeto
            foreach ($resJson->dados as $key => $prop) {
                $resProposicao = $client->get($prop->uri);
                $propJson = (json_decode($resProposicao->getBody()->getContents()));

                //foreach para pegar o id do deputado relacionado a proposta
                $resAutores = $client->get($prop->uri.'/autores');
                $propAutores = (json_decode($resAutores->getBody()->getContents()));

                //foreach para salvar o projeto no banco
                foreach ($propAutores->dados as $key => $autores) {
                    //if para salvar informações apenas deputados
                    if ($autores->uri != null) {
                        //salvando dados da tabela projetos
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
                    }
                }
            }
        }
    }
}
