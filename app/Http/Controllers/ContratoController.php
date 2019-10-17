<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

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
    $validator = Validator::make($request->all(), [
      'data' =>                   ['required', 'date', 'after_or_equal:today'],
      'n_contrato' =>             ['required', 'string', 'unique:contratos,n_contrato'],
      'n_processo_licitatorio' => ['required', 'string'],
      'modalidade' =>             ['required', 'string'],
      'descricao' =>              ['nullable', 'string', 'max:1500'],
      'fornecedor_id' =>          ['required', 'numeric', 'exists:fornecedors,id'],
    ]);

    if ($validator->fails()) {
        return redirect('contrato/telaCadastrar')
                    ->withErrors($validator)
                    ->withInput();
    }

    $contrato = new \App\Contrato();
    $contrato->data = $request->data;
    $contrato->n_contrato = $request->n_contrato;
    $contrato->n_processo_licitatorio = $request->n_processo_licitatorio;
    $contrato->descricao = $request->descricao;
    $contrato->valor_total = $request->valor_total;
    $contrato->fornecedor_id = $request->fornecedor_id;
    $contrato->modalidade = $request->modalidade;
    $contrato->save();

    session()->flash('success', 'Contrato cadastrado com sucesso. Insira seus itens.');
    return redirect()->route('/contrato/inserirItemContrato',[$contrato->id]);
  }

  public function listar(){
    //$contratos = \App\Contrato::orderBy('id')->paginate(10);
    $contratos = \App\Contrato::orderBy('id')->get();
    return view("ListarContratos", ["contratos" => $contratos]);
  }

  public function gerarRelatorio(){
    $contratos = \App\Contrato::all();
      $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");    //return view("RelatorioContratos", ["contratos" => $contratos]);

    return  \PDF::loadView('RelatorioContratos', compact('contratos'))
          // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
          ->stream('relatorio_Contrato_'.$data.'.pdf');
  }

  //para inserir Itens em um Contrato
  public function buscarContrato(Request $request) {
    $contrato = \App\Contrato::find($request->id);

    if (isset($contrato)) {
      $itens = \App\Item::all();
      return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
    }
    return redirect()->back()->with('alert','O Contrato não existe.');
  }

  public function editarItem(Request $request) {
    $contrato = \App\Contrato::find($request->contrato_id);
    $contrato_item = \App\Contrato_item::find($request->contrato_item_id);

    if (isset($contrato_item)) {
      return view("EditarItemContrato", [
        "contrato" => $contrato,
        "contrato_item" => $contrato_item]);
    }
    return redirect()->back()->with('alert','O Item não existe.');
  }

  public function inserirItemContrato(Request $request) {
    $contrato = \App\Contrato::find($request->contrato_id);

    if (isset($contrato)) {
      $contrato_item = new \App\Contrato_item();
      $item = \App\Item::where('nome','=',$request->nome)
                        ->where('marca','=',$request->marca)
                        ->where('descricao','=',$request->descricao)
                        ->where('unidade','=',$request->unidade)
                        ->where('gramatura','=',$request->gramatura)
                        ->first();

      if (!isset($item)) {
        $item = new \App\Item();

        $item->nome = $request->nome;
        $item->marca = $request->marca;
        $item->descricao = $request->descricao;
        $item->unidade = $request->unidade;
        $item->gramatura = $request->gramatura;
        $item->save();
      }

      $item = \App\Item::where('nome','=',$request->nome)
                        ->first();

      $contrato_item->quantidade = $request->quantidade;
      $contrato_item->valor_unitario = $request->valor_unitario;
      $contrato_item->contrato_id = $request->contrato_id;
      $contrato_item->item_id = $item->id;
      $contrato_item->save();

      $contrato->valor_total += $request->quantidade * $request->valor_unitario;
      //$contrato->valor_total = $this->calcularTotal($contrato);
      $contrato->save();

      session()->flash('success', 'Item adicionado.');
      return redirect()->route('/contrato/inserirItemContrato',[$contrato->id]);
    }
    
    session()->flash('success', 'Contrato não existe.');
    return redirect()->route('/contrato/listar');
  }

  /* private function calcularTotal(Contrato $contrato) {
    $contrato_itens = \App\Contrato_item::where('contrato_id','=',$contrato->id)->get();
    $total = 0.0;

    foreach ($contrato_itens as $contrato_item) {
      $total += $contrato_item->valor_unitario * $contrato_item->quantidade;
    }

    return $total;
  } */

  //fora de circulação
  public function removerItemContrato(Request $request) {
    $contrato_item = \App\Contrato_item::find($request->id);
    $itens = \App\Item::all();
    $contrato = \App\Contrato::find($contrato_item->contrato_id);

    if (isset($contrato_item)) {
      if (isset($contrato)) {
        $contrato_item->delete();

        session()->flash('success', 'Item adicionado.');
        return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
      }
      $contratos = \App\Contrato::paginate(10);
      session()->flash('success', 'Contrato não existe.');
      return view("ListarContratos", ["contratos" => $contratos]);
    }
    session()->flash('success', 'Esse item não existe no Contrato.');
    return view("InserirItensContrato", ["contrato" => $contrato, "itens" => $itens]);
  }

  //fora de circulação
  public function finalizarContrato(Request $request) {
    $contrato = \App\Contrato::find($request->id);

    if (isset($contrato)) {
      $contrato_itens = \App\Contrato_item::where('contrato_id', '=', $contrato->id)->get();
      $valorTotal = 0;
      foreach ($contrato_itens as $contrato_item) {
        $valorTotal = $valorTotal + $contrato_item->valor_unitario * $contrato_item->quantidade;
      }
      //$contrato->valor_total = $this->calcularTotal($contrato);
      $contrato->valor_total = $valorTotal;
      $contrato->save();

      session()->flash('success', 'Contrato cadastrado.');
      return redirect()->route('/contrato/listar');
    }
    session()->flash('success', 'Contrato não existe.');
    return redirect()->route('/contrato/listar');
  }

  public function exibirItensContrato(Request $request){
    $contrato = \App\Contrato::find($request->id);
    
    if (isset($contrato)) {
      $itens = \App\Contrato_item::where('contrato_id', '=', $contrato->id)->get();
      if (isset($itens)) {
        return view("VisualizarItensContrato", ["itens" => $itens]);
      }
    }
    
    session()->flash('success', 'Contrato não existe.');
    return redirect()->route('/contrato/listar');
  }

  public function salvarItem(Request $request) {
    $item_contrato = \App\Contrato_item::find($request->contrato_item_id);

    if (isset($item_contrato)) {
      $contrato = \App\Contrato::find($item_contrato->contrato_id);
      if (isset($contrato)){

        $validator = Validator::make($request->all(), [
          'quantidade' =>      ['required', 'numeric', 'min:0', 'max:5000000'],
          'valor_unitario' =>  ['required', 'numeric', 'min:0', 'max:5000000'],
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('/itemContrato/editar',[$item_contrato->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $item_contrato->quantidade = $request->quantidade;
        $item_contrato->valor_unitario = $request->valor_unitario;
        $item_contrato->save();
        //$contrato->valor_total = $this->calcularTotal($contrato);
        //$contrato->save();
        session()->flash('success', 'Valores alterados com sucesso.');
        return redirect()->route('/contrato/exibirItensContrato', ["id" => $item_contrato->contrato_id]);
      }
      return redirect()->back()->with('alert','Esse Contrato não existe.');
    }
    return redirect()->back()->with('alert','Esse Item não existe.');
  }

  public function buscarContratosFornecedor(Request $request){
  		$fornecedor = \App\Fornecedor::where('nome', 'ilike', '%' . $request->termo . '%')
  													->first();
      $contratos = array();
      if(!empty($fornecedor)){
        $contratos = \App\Contrato::where('fornecedor_id', '=', $fornecedor->id)->paginate(10);
      }
      return view("ListarContratos", ["contratos" => $contratos]);
  }

  public function buscarContratosData(Request $request){
      $contratos =  \App\Contrato::where('data', '>=', $request->data_inicio)->where('data', '<=', $request->data_fim)->paginate(10);
      return view("ListarContratos", ["contratos" => $contratos]);
  }

  public function editar(Request $request){
    $contrato = \App\Contrato::find($request->id);

    if (isset($contrato)) {
      $fornecedores = \App\Fornecedor::all();
      return view("EditarContrato", ["contrato" => $contrato, "fornecedores" => $fornecedores]);
    }

    return redirect()->back()->with('alert','Esse Contrato não existe.');
  }

  public function salvar(Request $request){
    $contrato = \App\Contrato::find($request->id);

    if (isset($contrato)) {

      $validator = Validator::make($request->all(), [
        'data' =>                   ['required', 'date', 'after_or_equal:today'],
        'n_contrato' =>             ['required', 'string', 'unique:contratos,n_contrato,'.$contrato->id],
        'n_processo_licitatorio' => ['required', 'string'],
        'modalidade' =>             ['required', 'string'],
        'descricao' =>              ['nullable', 'string', 'max:1500'],
        'fornecedor_id' =>          ['required', 'numeric', 'exists:fornecedors,id'],
      ]);
  
      if ($validator->fails()) {
          return redirect()->route('/contrato/editar',[$contrato->id])
                      ->withErrors($validator)
                      ->withInput();
      }

      $contrato->data = $request->data;
      $contrato->n_contrato = $request->n_contrato;
      $contrato->n_processo_licitatorio = $request->n_processo_licitatorio;
      $contrato->descricao = $request->descricao;
      $contrato->valor_total = $request->valor_total;
      $contrato->fornecedor_id = $request->fornecedor_id;
      $contrato->modalidade = $request->modalidade;
      $contrato->save();

      session()->flash('success', 'Contrato editado com sucesso.');
      return redirect()->route('/contrato/listar');
    }

    return redirect()->back()->with('alert', 'Contrato não existe.');
  }
}
