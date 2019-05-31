<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratoController extends Controller
{
  public function telaCadastrar() {
    $fornecedores = \App\Fornecedor::all();
    $itens = \App\Item::all();

    return view("CadastrarContrato", [
        "fornecedores" => $fornecedores,
        "itens" => $itens,
    ]);
  }

  public function cadastrar(Request $request) {
    $contrato = new \App\Contrato();
    $contrato->data = $request->data;
    $contrato->n_contrato = $request->n_contrato;
    $contrato->n_processo_licitatorio = $request->n_processo_licitatorio;
    $contrato->descricao = $request->descricao;
    $contrato->valor_total = $request->valor_total;
    $contrato->fornecedor_id = $request->fornecedor_id;
    $contrato->save();

    $itens = \App\Item::all();

    session()->flash('success', 'Contrato cadastrado com sucesso. Insira seus itens.');
    return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
  }

  public function listar(){
    $contratos = \App\Contrato::all();
    return view("ListarContratos", ["contratos" => $contratos]);
  }

  public function inserirItemContrato(Request $request) {
    dd("entrou");
    $contrato_item = new \App\Contrato_item();
    $contrato_item->quantidade = $request->quantidade;
    $contrato_item->valor = $request->valor;
    $contrato_item->contrato_id = $request->contrato_id;
    $contrato_item->item_id = $request->item_id;

    $contrato_item->save();

    $itens = \App\Item::all();
    $contrato = \App\Contrato::find($request->contrato_id);
     session()->flash('success', 'Item adicionado.');
     return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
  }
}
