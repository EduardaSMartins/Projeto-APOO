<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'categoria'], function () {
    Route::get('/', 'CategoriaController@index')->name('categoria.index');
    Route::get('/mixin','CategoriaController@mixin')->name('categoria.mixin');
    Route::post('/adicionar', 'CategoriaController@store')->name('categoria.post');
});

Route::group(['prefix' => 'produto'], function () {
    Route::get('/', 'ProdutoController@index')->name('produto.index');
    Route::post('/adicionar', 'ProdutoController@store')->name('produto.post');
    Route::get('/buscar/{id}','ProdutoController@show')->name('produto.find');
    Route::put('/atualizar/{id}', 'ProdutoController@update')->name('produto.update');
});