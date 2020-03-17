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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rotas de ADM

//Pessoa
Route::get('/pessoa/cadastrar', function(Request $request) {
    return view('CadastrarPessoa');
})->name('/pessoa/cadastrar')->middleware('adm');
Route::post('/pessoa/cadastrar', 'PessoaController@cadastrar')->name('/pessoa/cadastrar')->middleware('adm');
Route::get('/pessoa/listar', 'PessoaController@listar')->name('/pessoa/listar')->middleware('adm');
Route::get('/pessoa/editar/{id}', 'PessoaController@editar')->name('/pessoa/editar')->middleware('auth');
Route::post('/pessoa/salvar', 'PessoaController@salvar')->name('/pessoa/salvar')->middleware('auth');
Route::get('/pessoa/block/{id}', 'PessoaController@password_block')->name('/pessoa/block')->middleware('adm');
Route::get('/pessoa/password/{id}', 'PessoaController@view_password_to_change')->name('/pessoa/password')->middleware('auth');
Route::post('/pessoa/changepass', 'PessoaController@password_to_change')->name('/pessoa/changepass')->middleware('auth');
Route::get('/pessoa/resetpassword', 'PessoaController@password_reset')->name('/pessoa/resetpassword')->middleware('adm');



//Fornecedor
Route::get('/fornecedor/cadastrar', function(Request $request) {
    return view('CadastrarFornecedor');
})->name('/fornecedor/cadastrar')->middleware('adm');
Route::post('/fornecedor/cadastrar', 'FornecedorController@cadastrar')->name('/fornecedor/cadastrar')->middleware('adm');
Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('/fornecedor/listar')->middleware('auth');
Route::get('/fornecedor/editar/{id}', 'FornecedorController@editar')->name('/fornecedor/editar')->middleware('adm');
Route::post('/fornecedor/salvar', 'FornecedorController@salvar')->name('/fornecedor/salvar')->middleware('adm');
Route::get('/fornecedor/remover/{id}', 'FornecedorController@remover')->name('/fornecedor/remover')->middleware('adm');
Route::get('/fornecedor/Relatorio_Fornecedores', 'FornecedorController@gerarRelatorio')->name('/fornecedor/RelatorioFornecedores')->middleware('auth');
Route::get('/fornecedor/RelatorioContratos/{id}', 'FornecedorController@relatorioContratoItens')->name('/fornecedor/RelatorioContratos')->middleware('adm');


//Instituicao
Route::get('/instituicao/cadastrar', function(Request $request) {
    return view('CadastrarInstituicao');
})->name('/instituicao/cadastrar')->middleware('adm');
Route::post('/instituicao/cadastrar', 'InstituicaoController@cadastrar')->name('/instituicao/cadastrar')->middleware('adm');
Route::get('/instituicao/listar', 'InstituicaoController@listar')->name('/instituicao/listar')->middleware('auth');
Route::get('/instituicao/editar/{id}', 'InstituicaoController@editar')->name('/instituicao/editar')->middleware('adm');
Route::post('/instituicao/salvar', 'InstituicaoController@salvar')->name('/instituicao/salvar')->middleware('adm');
Route::get('/instituicao/remover/{id}', 'InstituicaoController@remover')->name('/instituicao/remover')->middleware('adm');
Route::get('/instituicao/Relatorio_Instituicaos', 'InstituicaoController@gerarRelatorio')->name('/instituicao/RelatorioInstituicaos')->middleware('auth');

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
Route::get('/estoque/abreCorrItem/{id}', 'EstoqueController@abreCorrItem')->name('/estoque/abreCorrItem')->middleware('adm');
Route::post('/estoque/correcaoItem', 'EstoqueController@correcaoItem')->name('/estoque/correcaoItem')->middleware('adm');
//Route::post('/estoque/novoItem', 'EstoqueController@novoItem')->name('/estoque/novoItem')->middleware('adm');
//Route::get('/estoque/novoItemEstoque/{id}', 'EstoqueController@buscarEstoque')->name('/estoque/novoItemEstoque')->middleware('adm'); //retirar de circulação
Route::get('/estoque/removerItem/{id}', 'EstoqueController@removerItem')->name('/estoque/removerItem')->middleware('adm');
//Route::get('/estoque/inserirEntrada/{id}', 'EstoqueController@abrirEntradaItem')->name('/estoque/inserirEntrada')->middleware('adm');
//Route::post('/estoque/abrirEntrada', 'EstoqueController@entradaItem')->name('/estoque/abrirEntrada')->middleware('adm');
Route::get('/estoque/inserirSaida/{id}', 'EstoqueController@abrirSaidaItem')->name('/estoque/inserirSaida')->middleware('adm');
Route::post('/estoque/abrirSaida', 'EstoqueController@saidaItem')->name('/estoque/abrirSaida')->middleware('adm');
//Route::get('/estoque/historicoEstoque/{id}', 'EstoqueController@mostrarHistorico')->name('/estoque/historicoEstoque')->middleware('auth');
Route::get('/estoque/Relatorio_Estoques', 'EstoqueController@gerarRelatorio')->name('/estoque/RelatorioEstoques')->middleware('auth');
Route::get('/estoque/Relatorio_EstoqueEsp/{id}', 'EstoqueController@gerarRelatorioEstoque')->name('/estoque/RelatorioEstoqueEsp')->middleware('auth');

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
Route::post('/cardapio/inserirItem', 'CardapioController@editarItemCardapio')->name('/cardapio/inserirItem')->middleware('adm');
Route::get('/cardapioDiario/finalizarCardapio/{id}', 'CardapioController@finalizarCardapioDiario')->name('/cardapioDiario/finalizarCardapio')->middleware('adm');
Route::get('/cardapioMensal/finalizarCardapio', 'CardapioController@finalizarCardapioMensal')->name('/cardapioMensal/finalizarCardapio')->middleware('adm');
Route::get('/cardapio/removerItem/{id}', 'CardapioController@removerItemCardapio')->name('/cardapio/removerItem')->middleware('adm');
Route::get('/cardapio/exibirItensCardapio/{id}', 'CardapioController@exibirCardapioMensal')->name('/cardapio/exibirItensCardapio')->middleware('auth');
Route::get('/cardapio/cadastrarCardapioSemanal/{id}', 'CardapioController@buscarCardapio')->name('/cardapio/cadastrarCardapioSemanal')->middleware('adm');
Route::get('/cardapio/inserirNovaRefeicao/{dia}/{cardapio_semanal}/{cardapio_mensal}','CardapioController@buscarInserirRefeicao')->name('/cardapio/inserirNovaRefeicao')->middleware('adm');
Route::get('/cardápio/editar/{id}', 'CardapioController@editar')->name('/cardapio/editar')->middleware('adm');
Route::get('/cardapio/editarCardapioSemanal/{id}', 'CardapioController@editarCardapio')->name('/cardapio/editarCardapioSemanal')->middleware('adm');
Route::get('/cardapio/editarRefeicao/{dia}/{cardapio_semanal}/{cardapio_mensal}/{refeicao}', 'CardapioController@editarRefeicaoCardapio')->name('/cardapio/editarRefeicao')->middleware('adm');
Route::get('/cardapio/editarNovaRefeicao/{dia}/{cardapio_semanal}/{cardapio_mensal}','CardapioController@editarInserirRefeicao')->name('/cardapio/editarNovaRefeicao')->middleware('adm');
Route::post('/cardapio/editarItem', 'CardapioController@editarItemCardapio')->name('/cardapio/editarItem')->middleware('adm');


//Ordem de fornecimento
Route::get('/ordemfornecimento/telaCadastrar/{id}', 'OrdemFornecimentoController@telaCadastrar')->name('/ordemfornecimento/telaCadastrar')->middleware('adm');
Route::post('/ordemfornecedor/store', 'OrdemFornecimentoController@cadastrar')->name('/ordemfornecimento/cadastrar')->middleware('adm');
Route::get('/ordemfornecimento/listar', 'OrdemFornecimentoController@listar')->name('/ordemfornecimento/listar')->middleware('adm');
Route::get('/ordemfornecimento/inserirItemOrdem/{id}', 'OrdemFornecimentoController@buscarOrdem')->name('/ordemfornecimento/inserirItemOrdem')->middleware('adm');
Route::post('/ordemfornecimento/inserirItem', 'OrdemFornecimentoController@inserirItem')->name('/ordemfornecimento/inserirItem')->middleware('adm');
Route::get('/ordemfornecimento/removerItem/{id}', 'OrdemFornecimentoController@removerItem')->name('/ordemfornecimento/removerItem')->middleware('adm');
Route::get('/ordemfornecimento/listarOrdemEstoque/{id}', 'OrdemFornecimentoController@listarOrdemEstoque')->name('/ordemfornecimento/listarOrdemEstoque')->middleware('adm');
Route::get('/ordemfornecimento/listarOrdemCont/{id}', 'OrdemFornecimentoController@listarOrdemCont')->name('/ordemfornecimento/listarOrdemCont')->middleware('adm');
Route::get('/ordemfornecimento/listarItensOrdem/{id}', 'OrdemFornecimentoController@listarItensOrdem')->name('/ordemfornecimento/listarItensOrdem')->middleware('adm');
Route::get('/ordemfornecimento/listarOrdemServ/{id}', 'OrdemFornecimentoController@listarOrdemServ')->name('/ordemfornecimento/listarOrdemServ')->middleware('adm');
Route::get('/ordemfornecimento/editarOrdemItem/{id}', 'OrdemFornecimentoController@editarOrdemItem')->name('/ordemfornecimento/editarOrdemItem')->middleware('adm');
Route::post('/ordemfornecimento/salvarItem', 'OrdemFornecimentoController@salvarItem')->name('/ordemfornecimento/salvarItem')->middleware('adm');
Route::get('/ordemfornecimento/novaBaixa/{id}', 'OrdemFornecimentoController@abreBaixa')->name('/ordemfornecimento/novaBaixa')->middleware('adm');
Route::get('/ordemfornecimento/baixaItem/{id}', 'OrdemFornecimentoController@abreItem')->name('/ordemfornecimento/baixaItem')->middleware('adm');
Route::post('/ordemfornecimento/revisaItem', 'OrdemFornecimentoController@revisaItem')->name('/ordemfornecimento/revisaItem')->middleware('adm');
Route::get('/ordemfornecimento/editarOrdem/{id}', 'OrdemFornecimentoController@editarOrdem')->name('/ordemfornecimento/editarOrdem')->middleware('adm');
Route::post('/ordemfornecimento/salvarOrdem', 'OrdemFornecimentoController@salvarOrdem')->name('/ordemfornecimento/salvarOrdem')->middleware('adm');
Route::get('/ordemfornecimento/baixaOrdem/{id}', 'OrdemFornecimentoController@baixaOrdem')->name('/ordemfornecimento/baixaOrdem')->middleware('adm');
Route::get('/ordemfornecimento/imprimir/{ordem_fornecimento_id}', 'OrdemFornecimentoController@geraPdfOrdemFornecimento')->name('/ordemfornecimento/imprimir')->middleware('adm');
