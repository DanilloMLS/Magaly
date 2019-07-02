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

//Escola
Route::get('/escola/cadastrar', function(Request $request) {
    return view('CadastrarEscola');
})->name('/escola/cadastrar')->middleware('auth');
Route::post('/escola/cadastrar', 'EscolaController@cadastrar')->name('/escola/cadastrar')->middleware('auth');
Route::get('/escola/listar', 'EscolaController@listar')->name('/escola/listar')->middleware('auth');
Route::get('/escola/editar/{id}', 'EscolaController@editar')->name('/escola/editar')->middleware('auth');
Route::post('/escola/salvar', 'EscolaController@salvar')->name('/escola/salvar')->middleware('auth');
Route::get('/escola/remover/{id}', 'EscolaController@remover')->name('/escola/remover')->middleware('auth');
//Distribuição
Route::get('/distribuicao/telaCadastrar', 'DistribuicaoController@telaCadastrar')->name('/distribuicao/telaCadastrar')->middleware('auth');
Route::get('/distribuicao/cadastrar', function(Request $request) {
    return view('CadastrarDistribuicao');
})->name('/distribuicao/cadastrar')->middleware('auth');
Route::post('/distribuicao/cadastrar', 'DistribuicaoController@cadastrar')->name('/distribuicao/cadastrar')->middleware('auth');
Route::get('/distribuicao/listar', 'DistribuicaoController@listar')->name('/distribuicao/listar')->middleware('auth');
Route::get('/distribuicao/editar/{id}', 'DistribuicaoController@editar')->name('/distribuicao/editar')->middleware('auth');
Route::post('/distribuicao/salvar', 'DistribuicaoController@salvar')->name('/distribuicao/salvar')->middleware('auth');
Route::get('/distribuicao/remover/{id}', 'DistribuicaoController@remover')->name('/distribuicao/remover')->middleware('auth');
Route::post('/distribuicao/inserirItem', 'DistribuicaoController@inserirItemDistribuicao')->name('/distribuicao/inserirItem')->middleware('auth');
Route::get('/distribuicao/removerItem/{id}', 'DistribuicaoController@removerItemDistribuicao')->name('/distribuicao/removerItem')->middleware('auth');
Route::get('/distribuicao/finalizarDistribuicao/{id}', 'DistribuicaoController@finalizarDistribuicao')->name('/distribuicao/finalizarContrato')->middleware('auth');
Route::get('/distribuicao/exibirItensDistribuicao/{id}', 'DistribuicaoController@exibirItensDistribuicao')->name('/distribuicao/exibirItensDistribuicao')->middleware('auth');

//Contrato
Route::get('/contrato/telaCadastrar', 'ContratoController@telaCadastrar')->name('/contrato/telaCadastrar')->middleware('auth');
Route::get('/contrato/cadastrar', function(Request $request) {
    return view('CadastrarDistribuicao');
})->name('/contrato/cadastrar')->middleware('auth');
Route::post('/contrato/cadastrar', 'ContratoController@cadastrar')->name('/contrato/cadastrar')->middleware('auth');
Route::get('/contrato/listar', 'ContratoController@listar')->name('/contrato/listar')->middleware('auth');
Route::post('/contrato/inserirItem', 'ContratoController@inserirItemContrato')->name('/contrato/inserirItem')->middleware('auth');
Route::get('/contrato/removerItem/{id}', 'ContratoController@removerItemContrato')->name('/contrato/removerItem')->middleware('auth');
Route::get('/contrato/finalizarContrato/{id}', 'ContratoController@finalizarContrato')->name('/contrato/finalizarContrato')->middleware('auth');
Route::get('/contrato/exibirItensContrato/{id}', 'ContratoController@exibirItensContrato')->name('/contrato/exibirItensContrato')->middleware('auth');

//Item
Route::get('/item/telaCadastrar', 'ItemController@telaCadastrar')->name('/item/telaCadastrar')->middleware('auth');
Route::get('/item/cadastrar', function(Request $request) {
    return view('CadastrarItem');
})->name('/item/cadastrar')->middleware('auth');
Route::post('/item/cadastrar', 'ItemController@cadastrar')->name('/item/cadastrar')->middleware('auth');
Route::get('/item/listar', 'ItemController@listar')->name('/item/listar')->middleware('auth');
Route::get('/item/editar/{id}', 'ItemController@editar')->name('/item/editar')->middleware('auth');
Route::post('/item/salvar', 'ItemController@salvar')->name('/item/salvar')->middleware('auth');
Route::get('/item/remover/{id}', 'ItemController@remover')->name('/item/remover')->middleware('auth');

//Estoque
Route::get('/estoque/cadastrar', function(Request $request) {
    return view('CadastrarEstoque');
})->name('/estoque/cadastrar')->middleware('auth');
Route::post('/estoque/cadastrar', 'EstoqueController@cadastrar')->name('/estoque/cadastrar')->middleware('auth');
Route::get('/estoque/listar', 'EstoqueController@listar')->name('/estoque/listar')->middleware('auth');
Route::get('/estoque/editar/{id}', 'EstoqueController@editar')->name('/estoque/editar')->middleware('auth');
Route::get('/estoque/saida/{id}', 'EstoqueController@saida')->name('/estoque/saida')->middleware('auth');
Route::post('/estoque/salvar', 'EstoqueController@salvar')->name('/estoque/salvar')->middleware('auth');
Route::get('/estoque/remover/{id}', 'EstoqueController@remover')->name('/estoque/remover')->middleware('auth');
Route::post('/estoque/inserirEntrada', 'EstoqueController@inserirItemEstoque')->name('/estoque/inserirEntrada')->middleware('auth');
Route::post('/estoque/inserirSaida', 'EstoqueController@removerItemEstoque')->name('/estoque/inserirSaida')->middleware('auth');
Route::get('/estoque/finalizarEstoque/{id}', 'EstoqueController@finalizarEstoque')->name('/estoque/finalizarEstoque')->middleware('auth');
Route::get('/estoque/exibirItensEstoque/{id}', 'EstoqueController@exibirItensEstoque')->name('/estoque/exibirItensEstoque')->middleware('auth');

//Refeicao
Route::get('/refeicao/cadastrar', function(Request $request) {
    return view('CadastrarRefeicao');
})->name('/refeicao/cadastrar')->middleware('auth');
Route::post('/refeicao/cadastrar', 'RefeicaoController@cadastrar')->name('/refeicao/cadastrar')->middleware('auth');
Route::get('/refeicao/listar', 'RefeicaoController@listar')->name('/refeicao/listar')->middleware('auth');
Route::get('/refeicao/editar/{id}', 'RefeicaoController@editar')->name('/refeicao/editar')->middleware('auth');
Route::post('/refeicao/salvar', 'RefeicaoController@salvar')->name('/refeicao/salvar')->middleware('auth');
Route::get('/refeicao/remover/{id}', 'RefeicaoController@remover')->name('/refeicao/remover')->middleware('auth');
Route::post('/refeicao/inserirItem', 'RefeicaoController@inserirItemRefeicao')->name('/refeicao/inserirItem')->middleware('auth');
Route::get('/refeicao/removerItem/{id}', 'RefeicaoController@removerItemRefeicao')->name('/refeicao/removerItem')->middleware('auth');
Route::get('/refeicao/finalizarRefeicao/{id}', 'RefeicaoController@finalizarRefeicao')->name('/refeicao/finalizarRefeicao')->middleware('auth');
Route::get('/refeicao/exibirItensRefeicao/{id}', 'RefeicaoController@exibirItensRefeicao')->name('/refeicao/exibirItensRefeicao')->middleware('auth');

//Cardapio
Route::get('/cardapio/cadastrar', function(Request $request) {
    return view('CadastrarCardapio');
})->name('/cardapio/cadastrar')->middleware('auth');
Route::post('/cardapio/salvar', 'CardapioController@cadastrar')->name('/cardapio/salvar')->middleware('auth');
Route::get('/cardapio/listar', 'CardapioController@listar')->name('/cardapio/listar')->middleware('auth');
