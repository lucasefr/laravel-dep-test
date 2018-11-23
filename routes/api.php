<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/deputados', 'DeputadoController@index');

Route::get('/despesas', 'DespesaController@index');
Route::get('/despesas/gastos', 'DespesaController@gastos');

Route::get('/proposicaos', 'ProposicaoController@index');
Route::get('/proposicaos/projetos', 'ProposicaoController@projetos');
