<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EscolaController extends Controller
{
  public function cadastrar(Request $request) {
    $escola = new \App\Escola();
    $escola->nome = $request->nome;

    switch ($request->modalidade_ensino) {
  		case "1":
  			$escola->modalidade_ensino = "Creche Infantil Integral";
   			break;
  		case "2":
  			$escola->modalidade_ensino = "Creche Infantil Parcial";
   			break;
      case "3":
    		$escola->modalidade_ensino = "Infantil (Pré-escola)";
   			break;
      case "4":
      	$escola->modalidade_ensino = "Ensino Fundamental";
     		break;
      case "5":
        $escola->modalidade_ensino = "EJA";
       	break;
      case "6":
        $escola->modalidade_ensino = "Quilombola";
        break;
   	}

    $escola->rota = $request->rota;
    $escola->periodo_atendimento = $request->periodo_atendimento;
    $escola->qtde_alunos = $request->qtde_alunos;
    $escola->endereco = $request->endereco;
    $escola->save();

    /*$endereco = new \App\Endereco();
    $endereco->rua = $request->rua;
    $endereco->bairro = $request->bairro;
    $endereco->cep = $request->cep;
    $endereco->numero = $request->numero;*/

    // $escola->endereco()->save($endereco);

    session()->flash('success', 'Escola cadastrada com sucesso.');
    return redirect()->route('/escola/listar');
  }

  public function listar(){
    $escolas = \App\Escola::all();
    return view("ListarEscolas", ["escolas" => $escolas]);
  }

  public function remover(Request $request){
      $escola = \App\Escola::find($request->id);
      $escola->delete();
      session()->flash('success', 'Escola removida com sucesso.');
      return redirect()->route('/escola/listar');
    }

  public function editar(Request $request){
      $escola = \App\Escola::find($request->id);
      return view("EditarEscola", [
          "escola" => $escola,
      ]);
  }

  public function salvar(Request $request){
      $escola = \App\Escola::find($request->id);

      $escola->nome = $request->nome;
      $escola->modalidade_ensino = $request->modalidade_ensino;
      $escola->rota = $request->rota;
      $escola->periodo_atendimento = $request->periodo_atendimento;
      $escola->qtde_alunos = $request->qtde_alunos;
      $escola->endereco = $request->endereco;
      $escola->save();
      //disciplina
      /*$endereco = \App\Endereco::where('escola_id', '=', $request->id)->first();
      $endereco->rua = $request->rua;
      $endereco->bairro = $request->bairro;
      $endereco->cep = $request->cep;
      $endereco->numero = $request->numero;
      $endereco->save();*/
      session()->flash('success', 'Escola modificada com sucesso.');
      return redirect()->route('/escola/listar');
      }
}
