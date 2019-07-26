<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estoque;

class EscolaController extends Controller
{
  public function cadastrar(Request $request) {
    $estoque = new \App\Estoque();
    $estoque->nome = "Estoque da Escola ".$request->nome;
    $estoque->save();
    
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
    $escola->estoque_id = $estoque->id;
    
    $escola->save();

    session()->flash('success', 'Escola cadastrada com sucesso.');
    return redirect()->route('/escola/listar');
  }

  public function listar(){
    $escolas = \App\Escola::all();
    return view("ListarEscolas", ["escolas" => $escolas]);
  }

    public function gerarRelatorio(){
        $escolas = \App\Escola::all();
        //return view("ListarEscolas", ["escolas" => $escolas]);

        return  \PDF::loadView('RelatorioEscolas', compact('escolas'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('relatorio_Escolas.pdf');
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

      $estoque = \App\Estoque::find($escola->estoque_id);
      $estoque->nome = "Estoque da Escola ".$request->nome;
      $estoque->save();

      session()->flash('success', 'Escola modificada com sucesso.');
      return redirect()->route('/escola/listar');
      }
}
