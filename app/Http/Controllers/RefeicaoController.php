<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefeicaoController extends Controller
{
  public function cadastrar(Request $request) {
    $refeicao = new \App\Refeicao();
    $refeicao->nome = $request->nome;
    $refeicao->descricao = $request->descricao;
    $refeicao->quantidade_total = 0;
    $refeicao->save();

    //$itens = \App\Item::all();
    $itens = \App\Item::all()->unique('nome');

    session()->flash('success', 'Refeição cadastrada com sucesso. Insira seus itens.');
    return view("InserirItensRefeicao", ["refeicao" => $refeicao, "itens" => $itens]);
  }

  public function listar(){
    $refeicoes = \App\Refeicao::orderBy('nome')->paginate(10);
    return view("ListarRefeicoes", ["refeicoes" => $refeicoes]);
  }

  public function gerarRelatorio(){

    $refeicoes = \App\Refeicao::all();
      $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");    //return view("ListarRefeicoes", ["refeicoes" => $refeicoes]);

    return  \PDF::loadView('RelatorioRefeicoes', compact('refeicoes'))
      // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
      ->stream('relatorio_Refeicao_'.$data.'.pdf');
  }

  public function inserirItemRefeicao(Request $request) {
    $refeicao_item = new \App\Refeicao_item();
    $refeicao_item->quantidade = $request->quantidade;
    $refeicao_item->refeicao_id = $request->refeicao_id;
    $refeicao_item->item_id = $request->item_id;

    $refeicao_item->save();

    //$itens = \App\Item::all();
    $itens = \App\Item::all()->unique('nome');

    $refeicao = \App\Refeicao::find($request->refeicao_id);
    session()->flash('success', 'Item adicionado.');
    return view("InserirItensRefeicao", ["refeicao" => $refeicao, "itens" => $itens]);
  }

  public function removerItemRefeicao(Request $request) {
    $refeicao_item = \App\Refeicao_item::find($request->id);
    $itens = \App\Item::all();
    $refeicao = \App\Refeicao::find($refeicao_item->refeicao_id);

    $refeicao_item->delete();

    session()->flash('success', 'Item adicionado.');
    return view("InserirItensRefeicao", ["refeicao" => $refeicao, "itens" => $itens]);
  }

  public function finalizarRefeicao(Request $request) {
    $refeicao = \App\Refeicao::find($request->id);
    $itens_refeicao = \App\Refeicao_item::where('refeicao_id', '=', $refeicao->id)->get();
    $quantidade = 0;
    foreach ($itens_refeicao as $item_refeicao) {
      $quantidade = $quantidade + $item_refeicao->quantidade;
    }
    $refeicao->quantidade_total = $quantidade;
    $refeicao->save();

    session()->flash('success', 'Refeição cadastrada.');
    return redirect()->route('/refeicao/listar');
  }


  public function exibirItensRefeicao(Request $request){
    $itens = \App\Refeicao_item::where('refeicao_id', '=', $request->id)->get();
    return view("VisualizarItensRefeicao", ["itens" => $itens]);
  }

  public function editarItemRefeicao(Request $request){
    $item_refeicao = \App\Refeicao_item::find($request->id);

    if (isset($item_refeicao)) {
      return view("EditarItemRefeicao", [
        "item_refeicao" => $item_refeicao,
      ]);
    }

    $itens = \App\Refeicao_item::where('refeicao_id', '=', $item_refeicao->refeicao_id)->get();
    return view("VisualizarItensRefeicao", ["itens" => $itens]);
  }

  public function salvarItemRefeicao(Request $request){
    $item_refeicao = \App\Refeicao_item::find($request->id);

    $item_refeicao->quantidade = $request->quantidade;
    $item_refeicao->save();

    session()->flash('success', 'Item da distribuição modificado com sucesso.');
    $itens = \App\Refeicao_item::where('refeicao_id', '=', $item_refeicao->refeicao_id)->get();
    //return view("VisualizarItensRefeicao", ["itens" => $itens]);
    return redirect()->route('/refeicao/exibirItensRefeicao',[$item_refeicao->refeicao_id]);
  }

}
