<?php
use App\Http\Controllers\EstoqueController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    Log::info('A user has arrived at the welcome page.');
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rotas de ADM
//Fornecedor
Route::get('/fornecedor/cadastrar', function(Request $request) {
    $nome = Auth::user()->name;
    Log::info('A user has arrived at the fornecedors reg page.'.$nome);
    return view('CadastrarFornecedor');
})->name('/fornecedor/cadastrar')->middleware('adm');
Route::post('/fornecedor/cadastrar', 'FornecedorController@cadastrar')->name('/fornecedor/cadastrar')->middleware('adm');
Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('/fornecedor/listar')->middleware('auth');
Route::get('/fornecedor/editar/{id}', 'FornecedorController@editar')->name('/fornecedor/editar')->middleware('adm');
Route::post('/fornecedor/salvar', 'FornecedorController@salvar')->name('/fornecedor/salvar')->middleware('adm');
Route::get('/fornecedor/remover/{id}', 'FornecedorController@remover')->name('/fornecedor/remover')->middleware('adm');
Route::get('/fornecedor/Relatorio_Fornecedores', 'FornecedorController@gerarRelatorio')->name('/fornecedor/RelatorioFornecedores')->middleware('auth');

//Escola
Route::get('/escola/cadastrar', function(Request $request) {
    return view('CadastrarEscola');
})->name('/escola/cadastrar')->middleware('adm');
Route::post('/escola/cadastrar', 'EscolaController@cadastrar')->name('/escola/cadastrar')->middleware('adm');
Route::get('/escola/listar', 'EscolaController@listar')->name('/escola/listar')->middleware('auth');
Route::get('/escola/editar/{id}', 'EscolaController@editar')->name('/escola/editar')->middleware('adm');
Route::post('/escola/salvar', 'EscolaController@salvar')->name('/escola/salvar')->middleware('adm');
Route::get('/escola/remover/{id}', 'EscolaController@remover')->name('/escola/remover')->middleware('adm');
Route::get('/escola/Relatorio_Escolas', 'EscolaController@gerarRelatorio')->name('/escola/RelatorioEscolas')->middleware('auth');

//Distribuição
Route::get('/distribuicao/telaCadastrar', 'DistribuicaoController@telaCadastrar')->name('/distribuicao/telaCadastrar')->middleware('adm');
Route::get('/distribuicao/cadastrar', function(Request $request) {
    return view('CadastrarDistribuicao');
})->name('/distribuicao/cadastrar')->middleware('adm');
Route::post('/distribuicao/cadastrar', 'DistribuicaoController@cadastrar')->name('/distribuicao/cadastrar')->middleware('adm');
Route::get('/distribuicao/listar', 'DistribuicaoController@listar')->name('/distribuicao/listar')->middleware('auth');
Route::get('/distribuicao/editar/{id}', 'DistribuicaoController@editar')->name('/distribuicao/editar')->middleware('adm');
Route::post('/distribuicao/salvar', 'DistribuicaoController@salvar')->name('/distribuicao/salvar')->middleware('adm');
Route::get('/distribuicao/remover/{id}', 'DistribuicaoController@remover')->name('/distribuicao/remover')->middleware('adm');
Route::post('/distribuicao/inserirItem', 'DistribuicaoController@inserirItemDistribuicao')->name('/distribuicao/inserirItem')->middleware('adm');
Route::get('/distribuicao/removerItem/{id}', 'DistribuicaoController@removerItemDistribuicao')->name('/distribuicao/removerItem')->middleware('adm');
Route::get('/distribuicao/finalizarDistribuicao/{id}', 'DistribuicaoController@finalizarDistribuicao')->name('/distribuicao/finalizarDistribuicao')->middleware('adm');
Route::get('/distribuicao/exibirItensDistribuicao/{id}', 'DistribuicaoController@exibirItensDistribuicao')->name('/distribuicao/exibirItensDistribuicao')->middleware('auth');
Route::get('/distribuicao/Relatorio_Distribuicoes/{token}', 'DistribuicaoController@gerarRelatorio')->name('/distribuicao/RelatorioDistribuicoes');
Route::get('/itemDistribuicao/editar/{id}', 'DistribuicaoController@editarItemDistribuicao')->name('/itemDistribuicao/editar')->middleware('adm');
Route::post('/itemDistribuicao/salvar', 'DistribuicaoController@salvarItemDistribuicao')->name('/itemDistribuicao/salvar')->middleware('adm');
Route::get('/distribuicao/novaBaixa/{id}', 'DistribuicaoController@buscarDistribuicao')->name('/distribuicao/novaBaixa')->middleware('adm');
Route::get('/distribuicao/baixaItem/{id}','DistribuicaoController@buscarItemDistribuicao')->name('/distribuicao/baixaItem')->middleware('adm');
Route::post('/distribuicao/baixaItemDistribuicao','DistribuicaoController@baixaItemDistribuicao')->name('/distribuicao/baixaItemDistribuicao')->middleware('adm');
Route::get('/distribuicao/concluirBaixa/{id}', 'DistribuicaoController@baixaDistribuicao')->name('/distribuicao/concluirBaixa')->middleware('adm');

//Contrato
Route::get('/contrato/telaCadastrar', 'ContratoController@telaCadastrar')->name('/contrato/telaCadastrar')->middleware('adm');
Route::get('/contrato/cadastrar', function(Request $request) {
    return view('CadastrarDistribuicao');
})->name('/contrato/cadastrar')->middleware('auth');
Route::post('/contrato/cadastrar', 'ContratoController@cadastrar')->name('/contrato/cadastrar')->middleware('adm');
Route::get('/contrato/listar', 'ContratoController@listar')->name('/contrato/listar')->middleware('auth');

Route::get('/contrato/listar_Falta', 'ContratoController@listar_Falta')->name('/contrato/listar_Falta')->middleware('adm');

Route::post('/contrato/inserirItem', 'ContratoController@inserirItemContrato')->name('/contrato/inserirItem')->middleware('adm');
Route::get('/contrato/inserirItemContrato/{id}', 'ContratoController@buscarContrato')->name('/contrato/inserirItemContrato')->middleware('adm');
Route::get('/contrato/removerItem/{id}', 'ContratoController@removerItemContrato')->name('/contrato/removerItem')->middleware('adm');
Route::get('/contrato/finalizarContrato/{id}', 'ContratoController@finalizarContrato')->name('/contrato/finalizarContrato')->middleware('adm');
Route::get('/contrato/exibirItensContrato/{id}', 'ContratoController@exibirItensContrato')->name('/contrato/exibirItensContrato')->middleware('auth');
Route::get('/contrato/Relatorio_Contratos', 'ContratoController@gerarRelatorio')->name('/contrato/RelatorioContratos')->middleware('auth');
Route::get('/contrato/buscar', function(Request $request) {
    return view('BuscarContratos');
})->name('/contrato/buscar')->middleware('auth');
Route::post('/contrato/buscarFornecedor', 'ContratoController@buscarContratosFornecedor')->name('/contrato/buscarFornecedor')->middleware('adm');
Route::post('/contrato/buscarData', 'ContratoController@buscarContratosData')->name('/contrato/buscarData')->middleware('adm');
Route::get('/contrato/editar/{id}', 'ContratoController@editar')->name('/contrato/editar')->middleware('adm');
Route::post('/contrato/salvar', 'ContratoController@salvar')->name('/contrato/salvar')->middleware('adm');
Route::get('/itemContrato/editar/{contrato_id}/{contrato_item_id}', 'ContratoController@editarItem')->name('/itemContrato/editar')->middleware('adm');
Route::post('/itemContrato/salvar', 'ContratoController@salvarItem')->name('/itemContrato/salvar')->middleware('adm');

//Item
Route::get('/item/telaCadastrar', 'ItemController@telaCadastrar')->name('/item/telaCadastrar')->middleware('adm');
Route::get('/item/cadastrar', function(Request $request) {
    return view('CadastrarItem');
})->name('/item/cadastrar')->middleware('adm');
Route::post('/item/cadastrar', 'ItemController@cadastrar')->name('/item/cadastrar')->middleware('adm');
Route::get('/item/listar', 'ItemController@listar')->name('/item/listar')->middleware('auth');
Route::get('/item/editar/{id}', 'ItemController@editar')->name('/item/editar')->middleware('adm');
Route::post('/item/salvar', 'ItemController@salvar')->name('/item/salvar')->middleware('adm');
Route::get('/item/remover/{id}', 'ItemController@remover')->name('/item/remover')->middleware('adm');
Route::get('/item/Relatorio_Itens', 'ItemController@gerarRelatorio')->name('/item/RelatorioItens')->middleware('auth');

//Estoque
Route::get('/estoque/cadastrar', function(Request $request) {
    return view('CadastrarEstoque');
})->name('/estoque/cadastrar')->middleware('adm');
Route::post('/estoque/cadastrar', 'EstoqueController@cadastrar')->name('/estoque/cadastrar')->middleware('adm');
Route::get('/estoque/listar', 'EstoqueController@listar')->name('/estoque/listar')->middleware('auth');
Route::get('/estoque/editar/{id}', 'EstoqueController@editar')->name('/estoque/editar')->middleware('adm');
Route::post('/estoque/salvar', 'EstoqueController@salvar')->name('/estoque/salvar')->middleware('adm');
Route::get('/estoque/remover/{id}', 'EstoqueController@remover')->name('/estoque/remover')->middleware('adm');
Route::get('/estoque/finalizarEstoque/{id}', 'EstoqueController@finalizarEstoque')->name('/estoque/finalizarEstoque')->middleware('adm');
Route::get('/estoque/exibirItensEstoque/{id}', 'EstoqueController@exibirItensEstoque')->name('/estoque/exibirItensEstoque')->middleware('auth');
Route::post('/estoque/novoItem', 'EstoqueController@novoItem')->name('/estoque/novoItem')->middleware('adm');
Route::get('/estoque/novoItemEstoque/{id}', 'EstoqueController@buscarEstoque')->name('/estoque/novoItemEstoque')->middleware('adm');
Route::get('/estoque/removerItem/{id}', 'EstoqueController@removerItem')->name('/estoque/removerItem')->middleware('adm');
Route::get('/estoque/inserirEntrada/{id}', 'EstoqueController@abrirEntradaItem')->name('/estoque/inserirEntrada')->middleware('adm');
Route::post('/estoque/abrirEntrada', 'EstoqueController@entradaItem')->name('/estoque/abrirEntrada')->middleware('adm');
Route::get('/estoque/inserirSaida/{id}', 'EstoqueController@abrirSaidaItem')->name('/estoque/inserirSaida')->middleware('adm');
Route::post('/estoque/abrirSaida', 'EstoqueController@saidaItem')->name('/estoque/abrirSaida')->middleware('adm');
Route::get('/estoque/historicoEstoque/{id}', 'EstoqueController@mostrarHistorico')->name('/estoque/historicoEstoque')->middleware('auth');
Route::get('/estoque/Relatorio_Estoques', 'EstoqueController@gerarRelatorio')->name('/estoque/RelatorioEstoques')->middleware('auth');

//Refeicao
Route::get('/refeicao/cadastrar', function(Request $request) {
    return view('CadastrarRefeicao');
})->name('/refeicao/cadastrar')->middleware('adm');
Route::post('/refeicao/cadastrar', 'RefeicaoController@cadastrar')->name('/refeicao/cadastrar')->middleware('adm');
Route::get('/refeicao/listar', 'RefeicaoController@listar')->name('/refeicao/listar')->middleware('auth');
//Route::get('/refeicao/editar/{id}', 'RefeicaoController@editar')->name('/refeicao/editar')->middleware('adm');
//Route::post('/refeicao/salvar', 'RefeicaoController@salvar')->name('/refeicao/salvar')->middleware('adm');
//Route::get('/refeicao/remover/{id}', 'RefeicaoController@remover')->name('/refeicao/remover')->middleware('adm');
Route::post('/refeicao/inserirItem', 'RefeicaoController@inserirItemRefeicao')->name('/refeicao/inserirItem')->middleware('adm');
Route::get('/refeicao/removerItem/{id}', 'RefeicaoController@removerItemRefeicao')->name('/refeicao/removerItem')->middleware('adm');
Route::get('/refeicao/inserirItemRefeicao/{id}', 'RefeicaoController@buscarRefeicao')->name('/refeicao/inserirItemRefeicao')->middleware('adm');
Route::get('/refeicao/finalizarRefeicao/{id}', 'RefeicaoController@finalizarRefeicao')->name('/refeicao/finalizarRefeicao')->middleware('adm');
Route::get('/refeicao/exibirItensRefeicao/{id}', 'RefeicaoController@exibirItensRefeicao')->name('/refeicao/exibirItensRefeicao')->middleware('auth');
Route::get('/refeicao/Relatorio_Refeicoes', 'RefeicaoController@gerarRelatorio')->name('/refeicao/RelatorioRefeicoes')->middleware('auth');
Route::get('/itemRefeicao/editar/{id}', 'RefeicaoController@editarItemRefeicao')->name('/itemRefeicao/editar')->middleware('adm');
Route::post('/itemRefeicao/salvar', 'RefeicaoController@salvarItemRefeicao')->name('/itemRefeicao/salvar')->middleware('adm');

//Cardapio
Route::get('/cardapio/cadastrar', function(Request $request) {
    return view('CadastrarCardapio');
})->name('/cardapio/cadastrar')->middleware('adm');
Route::get('/cardapioSemanal/cadastrar', function(Request $request) {
    return view('CadastrarCardapioSemanal');
})->name('/cardapioSemanal/cadastrar')->middleware('adm');
Route::post('/cardapio/salvar', 'CardapioController@cadastrar')->name('/cardapio/salvar')->middleware('adm');
Route::get('/cardapio/listar', 'CardapioController@listar')->name('/cardapio/listar')->middleware('auth');
Route::get('/cardapio/inserirRefeicao/{dia}/{cardapio_semanal}/{cardapio_mensal}/{refeicao}', 'CardapioController@inserirRefeicaoCardapio')->name('/cardapio/inserirRefeicao')->middleware('adm');
Route::post('/cardapio/inserirItem', 'CardapioController@inserirItemCardapio')->name('/cardapio/inserirItem')->middleware('adm');
Route::get('/cardapioDiario/finalizarCardapio/{id}', 'CardapioController@finalizarCardapioDiario')->name('/cardapioDiario/finalizarCardapio')->middleware('adm');
Route::get('/cardapioMensal/finalizarCardapio', 'CardapioController@finalizarCardapioMensal')->name('/cardapioMensal/finalizarCardapio')->middleware('adm');
Route::get('/cardapio/removerItem/{id}', 'CardapioController@removerItemCardapio')->name('/cardapio/removerItem')->middleware('adm');
Route::get('/cardapio/exibirItensCardapio/{id}', 'CardapioController@exibirCardapioMensal')->name('/cardapio/exibirItensCardapio')->middleware('auth');
Route::get('/cardapio/cadastrarCardapioSemanal/{id}', 'CardapioController@buscarCardapio')->name('/cardapio/cadastrarCardapioSemanal')->middleware('adm');

Route::get('/cardapio/inserirNovaRefeicao/{dia}/{cardapio_semanal}/{cardapio_mensal}','CardapioController@buscarInserirRefeicao')->name('/cardapio/inserirNovaRefeicao')->middleware('adm');
