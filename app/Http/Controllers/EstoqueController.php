<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function cadastrar(Request $request) {
    $estoque = new \App\Estoque();
    $estoque->nome = $request->nome;
    $estoque->save();

    $itens = \App\Item::all();

    session()->flash('success', 'Estoque cadastrado com sucesso. Insira seus itens.');
    return view("InserirItensEstoque", ["estoque" => $estoque, "itens" => $itens]);
  }

  public function listar(){
    $estoques = \App\Estoque::all();
    return view("ListarEstoques", ["estoques" => $estoques]);
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

  public function inserirItemEstoque(Request $request) {
    $estoque_item = new \App\Estoque_item();
    $estoque_item->quantidade = $request->quantidade;
    $estoque_item->quantidade_danificados = $request->quantidade_danificados;
    $estoque_item->item_id = $request->item_id;
    $estoque_item->estoque_id = $request->estoque_id;

    $estoque_item->save();

    $itens = \App\Item::all();
    $estoque = \App\Estoque::find($request->estoque_id);
    session()->flash('success', 'Item adicionado.');
    return view("InserirItensEstoque", ["estoque" => $estoque, "itens" => $itens]);
  }

  public function removerItemEstoque(Request $request) {
    $estoque_item = \App\Estoque_item::find($request->id);
    $itens = \App\Item::all();
    $estoque = \App\Estoque::find($estoque_item->estoque_id);

    $estoque_item->delete();

    session()->flash('success', 'Item adicionado.');
    return view("InserirItensEstoque", ["estoque" => $estoque, "itens" => $itens]);
  }

  public function finalizarEstoque(Request $request) {

    $estoques = \App\Estoque::all();

    session()->flash('success', 'Estoque cadastrado.');
    return view("ListarEstoques", ["estoques" => $estoques]);
  }
}