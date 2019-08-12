<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratoController extends Controller
{
  public function telaCadastrar() {
    $fornecedores = \App\Fornecedor::all();
    $itens = \App\Item::all();

    return view("CadastrarContrato", [
        "fornecedores" => $fornecedores,
        "itens" => $itens,
    ]);
  }

  public function cadastrar(Request $request) {
    $contrato = new \App\Contrato();
    $contrato->data = $request->data;
    $contrato->n_contrato = $request->n_contrato;
    $contrato->n_processo_licitatorio = $request->n_processo_licitatorio;
    $contrato->descricao = $request->descricao;
    $contrato->valor_total = $request->valor_total;
    $contrato->fornecedor_id = $request->fornecedor_id;
    $contrato->save();

    $itens = \App\Item::all();

    session()->flash('success', 'Contrato cadastrado com sucesso. Insira seus itens.');
    return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
  }

  public function listar(){
    $contratos = \App\Contrato::all();
    return view("ListarContratos", ["contratos" => $contratos]);
  }

  public function gerarRelatorio(){
    $contratos = \App\Contrato::all();
    //return view("RelatorioContratos", ["contratos" => $contratos]);

    return  \PDF::loadView('RelatorioContratos', compact('contratos'))
          // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
          ->stream('relatorio_Contrato.pdf');
  }

  public function inserirItemContrato(Request $request) {
    $contrato_item = \App\Contrato_item::where('contrato_id','=',$request->contrato_id)
                                       ->where('item_id','=',$request->item_id)
                                       ->first();

    $contrato = \App\Contrato::find($request->contrato_id);

    if (!isset($contrato_item)) {
      if (isset($contrato)) {
        $contrato_item = new \App\Contrato_item();
        $contrato_item->quantidade = $request->quantidade;
        $contrato_item->valor_unitario = $request->valor;
        $contrato_item->n_lote = $request->n_lote;
        $contrato_item->contrato_id = $request->contrato_id;
        $contrato_item->item_id = $request->item_id;

        $contrato_item->save();

        $itens = \App\Item::all();

        session()->flash('success', 'Item adicionado.');
        return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
      }
      $contratos = \App\Contrato::all();
      session()->flash('success', 'Contrato não existe.');
      return view("ListarContratos", ["contratos" => $contratos]);
    }
    $itens = \App\Item::all();

    session()->flash('success', 'Esse item já existe no Contrato.');
    return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
  }

  public function removerItemContrato(Request $request) {
    $contrato_item = \App\Contrato_item::find($request->id);
    $itens = \App\Item::all();
    $contrato = \App\Contrato::find($contrato_item->contrato_id);

    if (isset($contrato_item)) {
      if (isset($contrato)) {
        $contrato_item->delete();

        session()->flash('success', 'Item adicionado.');
        return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
      }
      $contratos = \App\Contrato::all();
      session()->flash('success', 'Contrato não existe.');
      return view("ListarContratos", ["contratos" => $contratos]);
    }
    session()->flash('success', 'Esse item não existe no Contrato.');
    return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
  }

  public function finalizarContrato(Request $request) {
    $contrato = \App\Contrato::find($request->id);

    if (isset($contrato)) {
      $contrato_itens = \App\Contrato_item::where('contrato_id', '=', $contrato->id)->get();
      $valorTotal = 0;
      foreach ($contrato_itens as $key => $contrato_itens) {
        $valorTotal = $valorTotal + $contrato_itens->valor_unitario * $contrato_itens->quantidade;
      }
      $contrato->valor_total = $valorTotal;
      $contrato->save();
      $contratos = \App\Contrato::all();

      session()->flash('success', 'Contrato cadastrado.');
      return view("ListarContratos", ["contratos" => $contratos]);
    }
    $contratos = \App\Contrato::all();
    session()->flash('success', 'Contrato não existe.');
    return view("ListarContratos", ["contratos" => $contratos]);
  }

  public function exibirItensContrato(Request $request){
    $itens = \App\Contrato_item::where('contrato_id', '=', $request->id)->get();
    return view("VisualizarItensContrato", ["itens" => $itens]);
  }

  public function buscarContratosFornecedor(Request $request){
  		$fornecedor = \App\Fornecedor::where('nome', 'ilike', '%' . $request->termo . '%')
  													->first();
      $contratos = array();
      if(!empty($fornecedor)){
        $contratos =  \App\Contrato::where('fornecedor_id', '=', $fornecedor->id)->get();
      }
      return view("ListarContratos", ["contratos" => $contratos]);
  }

  public function buscarContratosData(Request $request){
      $contratos =  \App\Contrato::where('data', '>=', $request->data_inicio)->where('data', '<=', $request->data_fim)->get();
      return view("ListarContratos", ["contratos" => $contratos]);
  }
}
