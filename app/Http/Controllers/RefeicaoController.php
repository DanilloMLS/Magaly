<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefeicaoController extends Controller
{
  public function cadastrar(Request $request) {
    $refeicao = new \App\Refeicao();
    $refeicao->nome = $request->nome;
    $refeicao->descricao = $request->descricao;
    $refeicao->save();

    $itens = \App\Item::all();

    session()->flash('success', 'Refeição cadastrada com sucesso. Insira seus itens.');
    return view("InserirItensRefeicao", ["refeicao" => $refeicao, "itens" => $itens]);
  }

  public function listar(){
    $refeicoes = \App\Refeicao::all();
    return view("ListarRefeicoes", ["refeicoes" => $refeicoes]);
  }

    public function gerarRelatorio(){
        $refeicoes = \App\Refeicao::all();
        //return view("ListarRefeicoes", ["refeicoes" => $refeicoes]);

        return  \PDF::loadView('RelatorioRefeicoes', compact('refeicoes'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('relatorio_Refeicao.pdf');
    }

  public function inserirItemRefeicao(Request $request) {
    $refeicao_item = new \App\Refeicao_item();
    $refeicao_item->quantidade = $request->quantidade;
    $refeicao_item->refeicao_id = $request->refeicao_id;
    $refeicao_item->item_id = $request->item_id;

    $refeicao_item->save();

    $itens = \App\Item::all();
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
    $refeicoes = \App\Refeicao::all();

    session()->flash('success', 'Refeição cadastrada.');
    return view("ListarRefeicoes", ["refeicoes" => $refeicoes]);
  }


  public function exibirItensRefeicao(Request $request){
    $itens = \App\Refeicao_item::where('refeicao_id', '=', $request->id)->get();
    return view("VisualizarItensRefeicao", ["itens" => $itens]);
  }
}
