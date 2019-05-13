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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rotas de ADM
//Fornecedor
Route::get('/fornecedor/cadastrar', function(Request $request) {
    return view('CadastrarFornecedor');
})->name('/fornecedor/cadastrar')->middleware('auth');
Route::post('/fornecedor/cadastrar', 'FornecedorController@cadastrar')->name('/fornecedor/cadastrar')->middleware('auth');
Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('/fornecedor/listar')->middleware('auth');
Route::get('/fornecedor/editar/{id}', 'FornecedorController@editar')->name('/fornecedor/editar')->middleware('auth');
Route::post('/fornecedor/salvar', 'FornecedorController@salvar')->name('/fornecedor/salvar')->middleware('auth');
Route::get('/fornecedor/remover/{id}', 'FornecedorController@remover')->name('/fornecedor/remover')->middleware('auth');
