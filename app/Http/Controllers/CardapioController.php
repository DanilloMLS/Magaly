<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardapioController extends Controller
{
  public function cadastrar(Request $request) {
    $cardapio_mensal = new \App\Cardapio_mensal();
    $cardapio_diario = new \App\Cardapio_diario();

    $cardapio_mensal->data_inicio = $request->data_inicio;
    $cardapio_mensal->data_fim = $request->data_fim;
    $cardapio_mensal->nome = $request->nome;

    switch ($request->modalidade_ensino) {
  		case "1":
  			$cardapio_mensal->modalidade_ensino = "Creche Infantil Integral";
   			break;
  		case "2":
  			$cardapio_mensal->modalidade_ensino = "Creche Infantil Parcial";
   			break;
      case "3":
    		$cardapio_mensal->modalidade_ensino = "Infantil (Pré-escola)";
   			break;
      case "4":
      	$cardapio_mensal->modalidade_ensino = "Ensino Fundamental";
     		break;
      case "5":
        $cardapio_mensal->modalidade_ensino = "EJA";
       	break;
      case "6":
        $cardapio_mensal->modalidade_ensino = "Quilombola";
        break;
   	}
    $cardapio_mensal->save();
    $i = 1;
    for($i=1; $i<=5; $i++){
      $this->cadastrar_cardapio_semanal($cardapio_mensal, $i);
    }
    session()->flash('success', 'Cardápio cadastrado com sucesso.');
    return view("CadastrarCardapioSemanal", ["cardapio" => $cardapio_mensal]);
  }

  public function cadastrar_cardapio_semanal($cardapio_mensal, $semana) {
    $cardapio_semanal = new \App\Cardapio_semanal();
    $cardapio_semanal->semana = $semana;
    $cardapio_semanal->cardapio_mensal_id = $cardapio_mensal->id;
    $cardapio_semanal->save();
  }

  public function listar(){
    $cardapios = \App\Cardapio_mensal::all();
    return view("ListarCardapios", ["cardapios" => $cardapios]);
  }

  public function inserirRefeicaoCardapio (Request $request){
    $dia = $request->dia;

    $cardapio_semanal = \App\Cardapio_semanal::where('cardapio_mensal_id', '=', $request->cardapio_mensal)->where('semana', '=', $request->cardapio_semanal)->first();

    $cardapio_diario = new \App\Cardapio_diario();
    $cardapio_diario->dia_semana = $dia;
    $cardapio_diario->refeicao = $request->refeicao;
    $cardapio_diario->cardapio_semanals_id = $cardapio_semanal->id;
    $cardapio_diario->save();
    $cardapio_mensal = \App\Cardapio_mensal::find($request->cardapio_mensal);
    $refeicoes = \App\Refeicao::all();
    return view("InserirRefeicaoCardapio", ["refeicao" => $request->refeicao, "cardapio_diario" => $cardapio_diario, "cardapio_mensal" => $cardapio_mensal, "cardapio_semanal" => $cardapio_semanal, "refeicoes" => $refeicoes]);
  }

  public function inserirItemCardapio(Request $request) {
    $cardapio_semanal = \App\Cardapio_semanal::find($request->cardapio_semanal);
    $cardapio_mensal = \App\Cardapio_mensal::find($request->cardapio_mensal);
    $cardapio_diario_refeicao = new \App\cardapio_diario_refeicao();
    $cardapio_diario_refeicao->cardapio_diario_id = $request->cardapio_diario;
    $cardapio_diario_refeicao->refeicao_id = $request->refeicao_id;
    $cardapio_diario_refeicao->save();
    $cardapio_diario = \App\Cardapio_diario::find($request->cardapio_diario);
    $refeicoes = \App\Refeicao::all();
    session()->flash('success', 'Refeição adicionada.');
    return view("InserirRefeicaoCardapio", ["cardapio_diario" => $cardapio_diario, "cardapio_mensal" => $cardapio_mensal, "cardapio_semanal" => $cardapio_semanal, "refeicoes" => $refeicoes]);
    //return view("CadastrarCardapioSemanal", ["cardapio" => $cardapio_mensal]);
  }


  public function removerItemCardapio(Request $request) {
    $cardapio_diario_refeicao = \App\cardapio_diario_refeicao::find($request->id);
    $refeicoes = \App\Refeicao::all();
    $cardapio_diario = \App\Cardapio_diario::find($cardapio_diario_refeicao->cardapio_diario_id);
    $cardapio_semanal = \App\Cardapio_semanal::find($cardapio_diario->cardapio_semanals_id);
    $cardapio_mensal = \App\Cardapio_mensal::find($cardapio_semanal->cardapio_mensal_id);
    $cardapio_diario_refeicao->delete();

    session()->flash('success', 'Item removido.');
    return view("InserirRefeicaoCardapio", ["cardapio_diario" => $cardapio_diario, "cardapio_mensal" => $cardapio_mensal, "cardapio_semanal" => $cardapio_semanal, "refeicoes" => $refeicoes]);
  }


  public function finalizarCardapioDiario(Request $request){
    $cardapio_mensal = \App\Cardapio_mensal::find($request->id);
    $cardapios = \App\Cardapio_mensal::all();
    session()->flash('success', 'Refeição cadastrada com sucesso.');
    return view("CadastrarCardapioSemanal", ["cardapio" => $cardapio_mensal]);

  }

  public function exibirCardapioMensal(Request $request){
    $cardapio_mensal = \App\Cardapio_mensal::find($request->id);
    return view("ExibirCardapioMensal", ["cardapio" => $cardapio_mensal]);

  }
}
