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

Route::group(['prefix' => 'pedido'], function () {
    Route::get('/', 'PedidoController@index')->name('pedido.index');
    Route::post('/adicionar', 'PedidoController@store')->name('pedido.post');
    Route::get('/busca/{id}','PedidoController@show')->name('pedido.find');
    Route::put('/atualizar/{id}', 'PedidoController@update')->name('pedido.update');
    Route::delete('/remover/{id}', 'PedidoController@destroy')->name('pedido.delete');
});