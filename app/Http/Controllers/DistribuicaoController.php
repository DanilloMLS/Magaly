<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistribuicaoController extends Controller
{

  public function telaCadastrar() {
    $escolas = \App\Escola::all();

    return view("CadastrarDistribuicao", [
        "escolas" => $escolas,
    ]);
  }

  public function cadastrar(Request $request) {
    $distribuicao = new \App\Distribuicao();
    $distribuicao->observacao = $request->observacao;
    $distribuicao->escola_id = $request->escola_id;
    $distribuicao->save();


    session()->flash('success', 'Distribuicao cadastrada com sucesso.');
    return redirect()->route('/distribuicao/listar');
  }

  public function listar(){
    $distribuicoes = \App\Distribuicao::all();
    return view("ListarDistribuicoes", ["distribuicoes" => $distribuicoes]);
  }

  public function remover(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);
      $distribuicao->delete();
      session()->flash('success', 'Distribuicao removida com sucesso.');
      return redirect()->route('/distribuicao/listar');
    }

  public function editar(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);
      $escolas = \App\Escola::all();
      return view("EditarDistribuicao", [
          "distribuicao" => $distribuicao,
          "escolas" => $escolas,
      ]);
  }

  public function salvar(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);

      $distribuicao->observacao = $request->observacao;
      $distribuicao->escola_id = $request->escola_id;
      $distribuicao->save();

      session()->flash('success', 'Distribuicao modificada com sucesso.');
      return redirect()->route('/distribuicao/listar');
      }
}
