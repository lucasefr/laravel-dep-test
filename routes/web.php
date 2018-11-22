<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('deputados', 'DeputadoController');

Route::get('/deputados', 'DeputadoController@index');

Route::get('/despesas/data', 'DespesaController@getData');
Route::get('/despesas', 'DespesaController@index');
Route::get('/despesas/gastadores', 'DespesaController@gastadores');

Route::get('/proposicaos', 'ProposicaoController@index');
Route::get('/proposicaos/data', 'ProposicaoController@getData');
