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
    return redirect()->route('/cardapio/listar');
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
}
