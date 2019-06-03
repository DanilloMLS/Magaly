<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function cadastrar(Request $request) {
    $estoque = new \App\Estoque();
    $estoque->nome = $request->nome;
    $estoque->save();

    session()->flash('success', 'Estoque cadastrado com sucesso.');
    return redirect()->route('/estoque/listar');
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
}
