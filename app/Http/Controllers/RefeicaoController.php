<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Refeicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RefeicaoController extends Controller
{
  public function cadastrar(Request $request) {
    $validator = Validator::make($request->all(), [
      'nome' =>      ['required', 'string', 'max:255', 'unique:refeicaos,nome'],
      'descricao' => ['nullable', 'string', 'max:255'],
    ],[
      'nome.required' => 'O nome é obrigatório',
      'nome.max' => 'O nome deve ter no máximo 255 caracteres',
      'nome.unique' => 'O nome já está em uso',
      'descricao.max' => 'A descrição deve ter no máximo 255 caracteres',
    ]);

    if ($validator->fails()) {
        return redirect('refeicao/cadastrar')
                    ->withErrors($validator)
                    ->withInput();
    }

    $refeicao = new \App\Refeicao();
    $refeicao->nome = $request->nome;
    $refeicao->descricao = $request->descricao;
    $refeicao->quantidade_total = 0;
    $refeicao->save();

    Log::info('Cadastro_Refeicao. User ['.$request->user()->id.
        ']. Method ['.$request->method().
        ']. Ip ['.$request->ip().
        ']. Agent ['.$request->header('user-agent').
        ']. Url ['.$request->path().']');

    session()->flash('success', 'Refeição cadastrada com sucesso. Insira seus itens.');
    return redirect()->route('/refeicao/inserirItemRefeicao',[$refeicao]);
  }

  //Obter uma refeição específica para edição, inserção e remoção de itens
  public function buscarRefeicao(Request $request){
    $refeicao = \App\Refeicao::find($request->id);
    $itens = \App\Item::all()->unique('nome');

    if (isset($refeicao)) {
      return view("InserirItensRefeicao", [
        "refeicao" => $refeicao,
        "itens" => $itens
      ]);
    }

    return redirect()->back()->with('alert', 'Refeição não existe.');
  }

  public function listar(){
    $refeicoes = \App\Refeicao::orderBy('nome')->get();
    return view("ListarRefeicoes", ["refeicoes" => $refeicoes]);
  }

  public function gerarRelatorio(){

    $refeicoes = \App\Refeicao::all();
      $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");    //return view("ListarRefeicoes", ["refeicoes" => $refeicoes]);

    return  \PDF::loadView('RelatorioRefeicoes', compact('refeicoes'))
      ->setPaper('a4', 'landscape')// Se quiser que fique no formato a4 retrato: 
      ->stream('relatorio_Refeicao_'.$data.'.pdf');
  }

  public function inserirItemRefeicao(Request $request) {
    $refeicao = \App\Refeicao::find($request->refeicao_id);

    $validator = Validator::make($request->all(), [
      'quantidade' =>  ['required', 'integer', 'between:0,99999'],
      'item_id' =>     ['required', 'integer', 'exists:items,id'],
      'refeicao_id' => ['required', 'integer', 'exists:refeicaos,id'],
    ],[
      'quantidade.required' => 'A quantidade é obrigatória',
      'quantidade.integer' => 'A quantidade deve ser um número inteiro',
      'quantidade.between' => 'A quantidade deve estar entre 0 e 99999',
      'item_id.required' => 'O item é obrigatório',
    ]);

    if ($validator->fails()) {
        return redirect()->route('/refeicao/inserirItemRefeicao',[$refeicao->id])
                    ->withErrors($validator)
                    ->withInput();
    }

    $refeicao_item = new \App\Refeicao_item();
    $refeicao_item->quantidade = $request->quantidade;
    $refeicao_item->refeicao_id = $request->refeicao_id;
    $refeicao_item->item_id = $request->item_id;

    $refeicao_item->save();

    Log::info('Inserir_Item_Refeicao. User ['.$request->user()->id.
        ']. Method ['.$request->method().
        ']. Ip ['.$request->ip().
        ']. Agent ['.$request->header('user-agent').
        ']. Url ['.$request->path().']');

    session()->flash('success', 'Item adicionado.');
    return redirect()->route('/refeicao/inserirItemRefeicao',[$refeicao]);
  }

  public function removerItemRefeicao(Request $request) {
    $refeicao_item = \App\Refeicao_item::find($request->id);
    $refeicao = \App\Refeicao::find($refeicao_item->refeicao_id);

    $refeicao_item->delete();
    
    Log::info('Remover_Item_Refeicao. User ['.$request->user()->id.
        ']. Method ['.$request->method().
        ']. Ip ['.$request->ip().
        ']. Agent ['.$request->header('user-agent').
        ']. Url ['.$request->path().']');

    session()->flash('success', 'Item adicionado.');
    return redirect()->route('/refeicao/inserirItemRefeicao',[$refeicao]);
  }

  public function finalizarRefeicao(Request $request) {
    $refeicao = \App\Refeicao::find($request->id);
    
    $this->calcularPeso($refeicao);

    Log::info('Calculo_Peso_Refeicao. User ['.$request->user()->id.
        ']. Method ['.$request->method().
        ']. Ip ['.$request->ip().
        ']. Agent ['.$request->header('user-agent').
        ']. Url ['.$request->path().']');

    session()->flash('success', 'Refeição cadastrada.');
    return redirect()->route('/refeicao/listar');
  }

  public function calcularPeso(Refeicao $refeicao){
    $refeicao = \App\Refeicao::find($refeicao->id);
    $itens_refeicao = \App\Refeicao_item::where('refeicao_id', '=', $refeicao->id)->get();
    $quantidade = 0;
    foreach ($itens_refeicao as $item_refeicao) {
      $quantidade = $quantidade + $item_refeicao->quantidade;
    }
    $refeicao->quantidade_total = $quantidade;
    $refeicao->save();
  }

  public function exibirItensRefeicao(Request $request){
    $itens = \App\Refeicao_item::where('refeicao_id', '=', $request->id)->get();
    return view("VisualizarItensRefeicao", ["itens" => $itens]);
  }

  public function editarItemRefeicao(Request $request){
    $item_refeicao = \App\Refeicao_item::find($request->id);

    if (isset($item_refeicao)) {
      return view("EditarItemRefeicao", [
        "item_refeicao" => $item_refeicao,
      ]);
    }

    $itens = \App\Refeicao_item::where('refeicao_id', '=', $item_refeicao->refeicao_id)->get();
    return view("VisualizarItensRefeicao", ["itens" => $itens]);
  }

  public function salvarItemRefeicao(Request $request){
    $item_refeicao = \App\Refeicao_item::find($request->id);

    if (isset($item_refeicao)) {
      $validator = Validator::make($request->all(), [
        'quantidade' => ['required', 'integer', 'between:0,99999'],
        'id' =>         ['required', 'integer', 'exists:refeicao_items,id'],
      ],[
        'quantidade.required' => 'A quantidade é obrigatória',
        'quantidade.integer' => 'A quantidade deve ser um número inteiro',
        'quantidade.between' => 'A quantidade deve estar entre 0 e 99999',
      ]);
  
      if ($validator->fails()) {
          return redirect()->route('/itemRefeicao/editar',[$item_refeicao->id])
                      ->withErrors($validator)
                      ->withInput();
      }
  
      $item_refeicao->quantidade = $request->quantidade;
      $item_refeicao->save();

      $refeicao = Refeicao::find($item_refeicao->refeicao_id);
      $this->calcularPeso($refeicao);

      Log::info('Edicao_Item_Refeicao. User ['.$request->user()->id.
        ']. Method ['.$request->method().
        ']. Ip ['.$request->ip().
        ']. Agent ['.$request->header('user-agent').
        ']. Url ['.$request->path().']');

      session()->flash('success', 'Item da distribuição modificado com sucesso.');
      //return redirect()->route('/refeicao/finalizarRefeicao',[$item_refeicao->refeicao_id]);
      return redirect()->route('/refeicao/exibirItensRefeicao',[$item_refeicao->refeicao_id]);
    }
    
    return redirect()->back()->with('alert','Refeição não existe.');
  }

}
