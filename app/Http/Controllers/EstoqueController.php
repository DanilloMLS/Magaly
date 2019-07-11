<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estoque_item;

class EstoqueController extends Controller
{
  public function cadastrar(Request $request) {
    $estoque = new \App\Estoque();
    $estoque->nome = $request->nome;
    $estoque->save();

    $itens = \App\Item::all();

    session()->flash('success', 'Estoque cadastrado com sucesso. Insira seus itens.');
    return view("InserirNovoItemEstoque", ["estoque" => $estoque, "itens" => $itens]);
  }

  public function listar(){
    $estoques = \App\Estoque::all();
    return view("ListarEstoques", ["estoques" => $estoques]);
  }

    public function gerarRelatorio(){
        $estoques = \App\Estoque::all();
        //return view("VisualizarItensEstoque", ["itens" => $itens]);
        //return view("ListarEstoques", ["estoques" => $estoques]);

        return  \PDF::loadView('RelatorioEstoques', compact('estoques'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('relatorio_Estoque.pdf');
    }

  public function remover(Request $request){
      $estoque = \App\Estoque::find($request->id);
      $estoque->delete();
      session()->flash('success', 'Estoque removido com sucesso.');
      return redirect()->route('/estoque/listar');
  }

  public function editar(Request $request){
      $estoque = \App\Estoque::find($request->id);
      return view("EditarEstoque", [
          "estoque" => $estoque,
      ]);
  }

  public function salvar(Request $request){
    $estoque = \App\Estoque::find($request->id);

    $estoque->nome = $request->nome;
    $estoque->save();
    session()->flash('success', 'Estoque modificado com sucesso.');
    return redirect()->route('/estoque/listar');
  }

  public function finalizarEstoque(Request $request) {

    $estoques = \App\Estoque::all();

    session()->flash('success', 'Estoque cadastrado.');
    return view("ListarEstoques", ["estoques" => $estoques]);
  }

  public function exibirItensEstoque(Request $request){
    $itens = \App\Estoque_item::where('estoque_id', '=', $request->id)->get();
    return view("VisualizarItensEstoque", ["itens" => $itens]);
  }

  //usado quando se insere itens no Estoque atráves do botão 'Inserir Itens'
  public function buscarEstoque(Request $request){
    $estoque = \App\Estoque::find($request->id);
    $itens = \App\Item::all();
    return view("InserirNovoItemEstoque", [
        "estoque" => $estoque, "itens" => $itens
    ]);
  }

  public function novoItem(Request $request){
    //$estoque_item = \App\Estoque_item::find($request->id);

    $estoque_item = new \App\Estoque_item();
    $estoque_item->quantidade = $request->quantidade;
    $estoque_item->quantidade_danificados = $request->quantidade_danificados;
    $estoque_item->item_id = $request->item_id;
    $estoque_item->estoque_id = $request->estoque_id;

    $estoque_es = new \App\Estoque_es();
    $estoque_es->quantidade_danificados = $request->quantidade_danificados;
    $estoque_es->quantidade = $request->quantidade;
    $estoque_es->operacao = "inserção";
    $estoque_es->item_id = $request->item_id;
    $estoque_es->estoque_id = $request->estoque_id;

    $estoque_item->save();
    $estoque_es->save();

    $itens = \App\Item::all();
    $estoque = \App\Estoque::find($request->estoque_id);
    session()->flash('success', 'Inserção de novo item.');
    return view("InserirNovoItemEstoque", ["estoque" => $estoque, "itens" => $itens]);
  }

  public function removerItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);

    $estoque_es = new \App\Estoque_es();
    $estoque_es->quantidade_danificados = $request->quantidade_danificados;
    $estoque_es->quantidade = $request->quantidade;
    $estoque_es->operacao = "removido";
    $estoque_es->item_id = $request->item_id;
    $estoque_es->estoque_id = $request->estoque_id;
    
    $estoque_es->save();
    $estoque_item->delete();
    
    $itens = \App\Estoque_item::where('estoque_id', '=', $estoque_item->estoque_id)->get();
    
    session()->flash('success', 'Remoção de item.');
    return view("VisualizarItensEstoque", ["itens" => $itens]);
  }

  public function abrirEntradaItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);
    
    return view("EntradaItemEstoque", [
        "estoque_item" => $estoque_item
    ]);
  }

  public function entradaItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);

    $estoque_item->quantidade += $request->quantidade;
    $estoque_item->quantidade_danificados += $request->quantidade_danificados;
    $estoque_item->item_id = $request->item_id;
    $estoque_item->estoque_id = $request->estoque_id;
    $estoque_item->save();
    $itens = \App\Estoque_item::where('estoque_id', '=', $estoque_item->estoque_id)->get();

    $estoque_es = new \App\Estoque_es();
    $estoque_es->quantidade_danificados = $request->quantidade_danificados;
    $estoque_es->quantidade = $request->quantidade;
    $estoque_es->operacao = "entrada";
    $estoque_es->item_id = $request->item_id;
    $estoque_es->estoque_id = $request->estoque_id;
    $estoque_es->save();
    
    session()->flash('success', 'Entrada de item.');
    return view("VisualizarItensEstoque", ["itens" => $itens]);
  }

  public function abrirSaidaItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);
    
    return view("SaidaItemEstoque", [
        "estoque_item" => $estoque_item
    ]);
  }

  public function saidaItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);

    if ($request->quantidade >= 0 && $request->quantidade_danificados >= 0) {
      if ($request->quantidade <= $estoque_item->quantidade &&
          $request->quantidade_danificados <= $estoque_item->quantidade_danificados) {
            
            $estoque_item->quantidade -= $request->quantidade;
            $estoque_item->quantidade_danificados -= $request->quantidade_danificados;

            $estoque_es = new \App\Estoque_es();
            $estoque_es->quantidade_danificados = $request->quantidade_danificados;
            $estoque_es->quantidade = $request->quantidade;
            $estoque_es->operacao = "saida";
            $estoque_es->item_id = $request->item_id;
            $estoque_es->estoque_id = $request->estoque_id;
            $estoque_es->save();
      }
      elseif ($request->quantidade > $estoque_item->quantidade) {
        return redirect()->back() ->with('alert', 'Quantidade insuficiente');
      }
      else {
        return redirect()->back() ->with('alert', 'Quantidade de itens danificados insuficiente');
      }
    }

    $estoque_item->item_id = $request->item_id;
    $estoque_item->estoque_id = $request->estoque_id;
    $estoque_item->save();
    $itens = \App\Estoque_item::where('estoque_id', '=', $estoque_item->estoque_id)->get();
    
    session()->flash('success', 'Saída de item.');
    return view("VisualizarItensEstoque", ["itens" => $itens]);
  }

  public function mostrarHistorico(Request $request){
    //$itens_historico = \App\Estoque_es::find($request->id);
    $itens_historico = \App\Estoque_es::where('estoque_id', '=', $request->id)->get();

    return view("HistoricoEstoque", ["itens_historico" => $itens_historico]);
  }
}
