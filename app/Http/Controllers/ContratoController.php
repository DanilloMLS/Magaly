<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratoController extends Controller
{
  public function telaCadastrar() {
    $fornecedores = \App\Fornecedor::all();

    return view("CadastrarContrato", [
        "fornecedores" => $fornecedores,
    ]);
  }

  public function cadastrar(Request $request) {
    $contrato = new \App\Contrato();
    $contrato->valor_total = $request->valor_total;
    $contrato->fornecedor_id = $request->fornecedor_id;
    $contrato->save();


    session()->flash('success', 'Contrato cadastrado com sucesso.');
    return redirect()->route('/contrato/listar');
  }

  public function listar(){
    $contratos = \App\Contrato::all();
    return view("ListarContratos", ["contratos" => $contratos]);
  }
}
