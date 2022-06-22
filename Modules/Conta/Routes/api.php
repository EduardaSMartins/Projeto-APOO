<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'conta'], function () {
    Route::get('/', 'ContaController@index')->name('conta.index');
    Route::post('/adicionar/{id}', 'ContaController@store')->name('conta.post'); // o id é da empresa
    Route::get('/buscaConta/{id}','ContaController@showConta')->name('conta.find');
    Route::get('/buscaParcela/{id}','ContaController@showParcela')->name('parcela.find');
    Route::put('/atualizarConta/{id}', 'ContaController@updateConta')->name('conta.update');
    Route::put('/atualizarParcela/{id}', 'ContaController@updateParcela')->name('parcela.update');
    Route::delete('/remover/{id}', 'ContaController@destroy')->name('conta.delete');
});