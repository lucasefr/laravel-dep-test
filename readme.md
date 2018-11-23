## Projeto Gastadores

Projeto feito para identificar os deputados que mais gastam da sua renda parlamentar por mes no ano de 2017 e os deputados que mais tem projetos em analise.

## API usada

Para fazer o projeto foi criada uma api com o framework php Laravel usando a api externa de dados abertos do site https://dadosabertos.camara.leg.br
com todas as informações necessarias para sua construção.

A documentação da api da camera se encontra no link: https://dadosabertos.camara.leg.br/swagger/api.html

## Bibliotecas Externas

Guzzle - HTTP CLient usada para fazer requisições em api externa - http://docs.guzzlephp.org/en/stable/
Swagger - PAcote para fazer a documentação da api - https://github.com/DarkaOnLine/L5-Swagger

## Instalação

- clonar o projeto (link:https://github.com/lucasefr/laravel-dep-test)
- Criar um banco de dados de sua preferencia (para fazer o projeto foi usado o Mysql) para população de dados da Api
- Fazer o comando "composer update" para atualizar as dependencias
- Fazer o comando "php artisan key:generate"
- Configurar o .ENV com as informações do banco de dados
- Fazer o comando "php artisan migrate" para criar as tabelas do banco de dados
- Fazer o comando "php artisan populate:deputados" para popular a tabela de deputados
- Fazer o comando "php artisan populate:proposicao" para popular a tabela de deputados*
- Fazer o comando "php artisan populate:depProp" para popular a tabela de deputados*
- Fazer o comando "php artisan populate:despesas" para popular a tabela de deputados* 
- Fazer o comando "php artisan serve" para rodar o projeto
- Testar os endpoint da documentação

* Devido a quantidade enorme de dados pode ser que o processo de população das tabelas demore, principalmente a de despesas.
Os testes com os endpoints podem ser feitos com o processo em andamento ou incompleto, desde que todas as tabelas tenham uma pequena 
quantidade de dados. 

## Documentação da API

A documentação pode ser acessada pelo localhost no endpoint api/documentation, 
http://127.0.0.1:8000/api/documentation

## Contato
lucasefr@gmail.com
Enjoy!


