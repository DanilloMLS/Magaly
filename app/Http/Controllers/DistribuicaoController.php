<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistribuicaoController extends Controller
{

  public function telaCadastrar() {
    $escolas = \App\Escola::all();
    $cardapios = \App\Cardapio_mensal::all();

    return view("CadastrarDistribuicao", [
        "escolas" => $escolas,
        "cardapios" => $cardapios,
    ]);
  }

  public function cadastrar(Request $request) {
    $distribuicao = new \App\Distribuicao();
    $distribuicao->observacao = $request->observacao;
    $distribuicao->escola_id = $request->escola_id;
    $distribuicao->cardapio_id = $request->cardapio_id;
    $distribuicao->save();


    $itens = \App\Item::all();

    session()->flash('success', 'Distribuição cadastrada com sucesso. Insira seus itens.');
    return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $itens]);
  }

  public function listar(){
    $distribuicoes = \App\Distribuicao::all();
    return view("ListarDistribuicoes", ["distribuicoes" => $distribuicoes]);
  }

    public function gerarRelatorio(){
        $distribuicoes = \App\Distribuicao::All();
        //return view("RelatorioDistribuicao", ["distribuicoes" => $distribuicoes]);

        return  \PDF::loadView('RelatorioDistribuicoes', compact('distribuicoes'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('relatorio_Distribuicao.pdf');
    }

  public function remover(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);

      if (isset($distribuicao)) {
        $distribuicao->delete();
        session()->flash('success', 'Distribuicao removida com sucesso.');
        return redirect()->route('/distribuicao/listar');
      }

      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
    }

  public function editar(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);
      if (isset($distribuicao)) {
        $escolas = \App\Escola::all();
        return view("EditarDistribuicao", [
            "distribuicao" => $distribuicao,
            "escolas" => $escolas,
        ]);
      }
      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
  }

  public function salvar(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);

      if (isset($distribuicao)) {
        $distribuicao->observacao = $request->observacao;
        $distribuicao->escola_id = $request->escola_id;
        $distribuicao->save();

        session()->flash('success', 'Distribuicao modificada com sucesso.');
        return redirect()->route('/distribuicao/listar');
      }

      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
  }

  public function inserirItemDistribuicao(Request $request) {
    $distribuicao_item = \App\Distribuicao_item::where('item_id','=',$request->item_id)
                                               ->where('distribuicao_id','=',$request->distribuicao_id)
                                               ->get()->first();

    $distribuicao = \App\Distribuicao::find($request->distribuicao_id);

    if (!isset($distribuicao_item)) {
      if (isset($distribuicao)) {
        $distribuicao_item = new \App\Distribuicao_item();
        $distribuicao_item->quantidade = $request->quantidade;
        $distribuicao_item->quantidade_falta = $request->quantidade_falta;
        $distribuicao_item->quantidade_danificados = $request->quantidade_danificados;
        $distribuicao_item->item_id = $request->item_id;
        $distribuicao_item->distribuicao_id = $request->distribuicao_id;
        $distribuicao_item->save();

        $itens = \App\Item::all();
        session()->flash('success', 'Item adicionado.');
        return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $itens]);
      }

      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
    }
    $itens = \App\Item::all();
    session()->flash('success', 'Esse item já existe.');
    return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $itens]);
  }

  public function removerItemDistribuicao(Request $request) {
    $distribuicao_item = \App\Distribuicao_item::find($request->id);
    $itens = \App\Item::all();


    if (isset($distribuicao_item)) {
      $distribuicao = \App\Distribuicao::find($distribuicao_item->distribuicao_id);

      if (isset($distribuicao)) {
        $distribuicao_item->delete();

        session()->flash('success', 'Item removido.');
        return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $itens]);
      }

      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
    }
    $distribuicao = \App\Distribuicao::find($distribuicao_item->distribuicao_id);
    session()->flash('success', 'Esse Item não existe na Distribuição.');
    return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $itens]);
  }

  public function finalizarDistribuicao(Request $request) {

    $distribuicoes = \App\Distribuicao::all();

    session()->flash('success', 'Distribuicao cadastrada.');
    return view("ListarDistribuicoes", ["distribuicoes" => $distribuicoes]);
  }

  public function exibirItensDistribuicao(Request $request){
    $itens = \App\Distribuicao_item::where('distribuicao_id', '=', $request->id)->get();
    return view("VisualizarItensDistribuicao", ["itens" => $itens]);
  }

}
