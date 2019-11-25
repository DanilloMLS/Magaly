<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstoqueController extends Controller
{
  public function cadastrar(Request $request) {
    //$estoque = \App\Estoque::where('nome',$request->nome);

    $validator = Validator::make($request->all(), [
      'nome' => ['required', 'string', 'max:255', 'unique:estoques,nome'],
    ],[
      'nome.required' => 'O nome é obrigatório',
      'nome.max' => 'O nome deve ter no máximo 255 caracteres',
      'nome.unique' => 'O nome já está em uso'
    ]);

    if ($validator->fails()) {
        return redirect('estoque/cadastrar')
                    ->withErrors($validator)
                    ->withInput();
    }

    $estoque = new \App\Estoque();
    $estoque->nome = $request->nome;
    $estoque->save();

    Log::info('Cadastro_Estoque. User ['.$request->user()->id.
      ']. Method ['.$request->method().
      ']. Ip ['.$request->ip().
      ']. Agent ['.$request->header('user-agent').
      ']. Url ['.$request->path().']');

    session()->flash('success', 'Estoque cadastrado com sucesso. Insira seus itens.');
    return redirect()->route('/estoque/novoItemEstoque',[$estoque]);
  }

  public function listar(){
    $estoques = \App\Estoque::orderBy('nome')->get();
    return view("ListarEstoques", ["estoques" => $estoques]);
  }

    public function gerarRelatorio(){
        $estoques = \App\Estoque::all();
        $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");        //return view("VisualizarItensEstoque", ["itens" => $itens]);
        //return view("ListarEstoques", ["estoques" => $estoques]);

        return  \PDF::loadView('RelatorioEstoques', compact('estoques'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('relatorio_Estoque_'.$data.'.pdf');
    }

  public function remover(Request $request){
      $estoque = \App\Estoque::find($request->id);
      $escola = \App\Escola::where('estoque_id', $estoque->id)->get()->first();
      
      if (!isset($escola)) {
        if (isset($estoque)) {
          $estoque->delete();
          session()->flash('success', 'Estoque removido com sucesso.');
          return redirect()->route('/estoque/listar');
        }
        session()->flash('success', 'Estoque não existe.');
        return redirect()->route('/estoque/listar');
      }
      

      session()->flash('success', 'O Estoque pertence a uma Escola, remova a Escola.');
      return redirect()->route('/estoque/listar');
  }

  public function editar(Request $request){
      $estoque = \App\Estoque::find($request->id);
      $escola = \App\Escola::where('estoque_id', $estoque->id)->get()->first();

      if (!isset($escola)) {
        if (isset($estoque)) {
          return view("EditarEstoque", [
            "estoque" => $estoque,
          ]);
        }

        session()->flash('success', 'Estoque não existe.');
        return redirect()->route('/estoque/listar');
      }
      
      session()->flash('success', 'O Estoque pertence a uma Escola, renomeie a Escola.');
      return redirect()->route('/estoque/listar');    
  }

  public function salvar(Request $request){
    $estoque = \App\Estoque::find($request->id);

    if (isset($estoque)) {

      $validator = Validator::make($request->all(), [
        'nome' => ['required', 'string', 'max:255', 'unique:estoques,nome,'.$estoque->id],
      ],[
        'nome.required' => 'O nome é obrigatório',
        'nome.max' => 'O nome deve ter no máximo 255 caracteres',
        'nome.unique' => 'O nome já está em uso'
      ]);

      if ($validator->fails()) {
          return redirect()->route('/estoque/editar',[$estoque->id])
                      ->withErrors($validator)
                      ->withInput();
      }

      $estoque->nome = $request->nome;
      $estoque->save();

      Log::info('Edicao_Estoque. User ['.$request->user()->id.
      ']. Method ['.$request->method().
      ']. Ip ['.$request->ip().
      ']. Agent ['.$request->header('user-agent').
      ']. Url ['.$request->path().']');

      session()->flash('success', 'Estoque renomeado com sucesso.');
      return redirect()->route('/estoque/listar');
    }

    session()->flash('success', 'Estoque não existe.');
    return redirect()->route('/estoque/listar');     
  }

  public function finalizarEstoque(Request $request) {

    session()->flash('success', 'Estoque cadastrado.');
    return redirect()->route('/estoque/listar');
  }

  public function exibirItensEstoque(Request $request){
    $estoque = \App\Estoque::find($request->id);

    if (isset($estoque)) {
      $itens = \App\Estoque_item::where('estoque_id', '=', $request->id)->orderBy('id')->get();
      return view("VisualizarItensEstoque", ["itens" => $itens]);
    }

    session()->flash('success', 'Estoque não existe.');
    return redirect()->route('/estoque/listar');
  }

  //usado quando se insere itens no Estoque atráves do botão 'Inserir Itens'
  public function buscarEstoque(Request $request){
    $estoque = \App\Estoque::find($request->id);
    $itens_contrato = \App\Contrato_item::orderBy('id')->where('quantidade','>',0)->get();
    //$itens_contrato = \App\Contrato_item::all();

    if (isset($estoque)) {
      return view("InserirNovoItemEstoque", [
        "estoque" => $estoque,
        "itens_contrato" => $itens_contrato
      ]);
    }
    

    session()->flash('success', 'Estoque não existe.');
    return redirect()->route('/estoque/listar'); 
  }

  public function novoItem(Request $request){
    $estoque = \App\Estoque::find($request->estoque_id);

    if (isset($estoque)) {
      $contrato_item = \App\Contrato_item::find($request->item_contrato_id);

      $validator = Validator::make($request->all(), [
        'quantidade_danificados' => ['required', 'integer', 'between:0,99999'],
        'quantidade' => ['required', 'integer', 'between:0,99999'],
        'item_contrato_id' => ['required', 'integer', 'exists:items,id'],
        'n_lote' => ['required', 'string', 'max:255'],
        'data_validade' => ['required', 'date', 'after_or_equal:today'],
      ],[
        'quantidade_danificados.required' => 'A quantidade danificada é obrigatória',
        'quantidade_danificados.integer' => 'A quantidade danificada deve ser um número inteiro',
        'quantidade_danificados.between' => 'A quantidade danificada deve estar entre 0 e 99999',
        'quantidade.required' => 'A quantidade é obrigatória',
        'quantidade.integer' => 'A quantidade deve ser um número inteiro',
        'quantidade.between' => 'A quantidade deve estar entre 0 e 99999',
        'n_lote.required' => 'O lote é obrigatório',
        'n_lote.max' => 'O lote deve ter no máximo 255 caracteres',
        'data_validade.required' => 'A data é obrigatória',
        'data_validade.date' => 'Formato de data inválido',
        'data_validade.after_or_equal' => 'A data deve ser igual ou posterior a hoje',
      ]);

      if ($validator->fails()) {
          return redirect()->route('/estoque/novoItemEstoque',[$estoque->id])
                      ->withErrors($validator)
                      ->withInput();
      }
      
      $estoque_item = \App\Estoque_item::where('estoque_id','=',$request->estoque_id)
                                       ->where('item_id','=',$contrato_item->item_id)
                                       ->where('contrato_id','=',$contrato_item->contrato_id)
                                       ->first();


      //mudar para permitir a inserção com os Itens restantes
      if ($contrato_item->quantidade < $request->quantidade+$request->quantidade_danificados or $contrato_item->quantidade <= 0) {
        session()->flash('warning', 'Contrato não tem quantidade suficiente.');
        return redirect()->route('/estoque/listar');
      }

      //quantidade atualizada se o Item já existir
      /* if (isset($estoque_item)){
        $estoque_item->quantidade += $request->quantidade;
        $estoque_item->quantidade_danificados += $request->quantidade_danificados;
      } else {
        $estoque_item = new \App\Estoque_item();
        $estoque_item->quantidade = $request->quantidade;
        $estoque_item->quantidade_danificados = $request->quantidade_danificados;
        $estoque_item->item_id = $contrato_item->item_id;
        $estoque_item->estoque_id = $request->estoque_id;
        $estoque_item->contrato_id = $contrato_item->contrato_id;
        $estoque_item->n_lote = $request->n_lote;
        $estoque_item->data_validade = $request->data_validade;
      } */

      $estoque_item = new \App\Estoque_item();
      $estoque_item->quantidade = $request->quantidade;
      $estoque_item->quantidade_danificados = $request->quantidade_danificados;
      $estoque_item->item_id = $contrato_item->item_id;
      $estoque_item->estoque_id = $request->estoque_id;
      $estoque_item->contrato_id = $contrato_item->contrato_id;
      $estoque_item->n_lote = $request->n_lote;
      $estoque_item->data_validade = $request->data_validade;


      $contrato_item->quantidade -= ($request->quantidade + $request->quantidade_danificados);
      
      Log::info('Inserir_Item_Estoque. User ['.$request->user()->id.
      ']. Method ['.$request->method().
      ']. Ip ['.$request->ip().
      ']. Agent ['.$request->header('user-agent').
      ']. Url ['.$request->path().']');
      
      $estoque_item->save();
      $contrato_item->save();

      session()->flash('success', 'Inserção de novo item.');
      return redirect()->route('/estoque/novoItemEstoque',[$estoque->id]);
    }
    
    session()->flash('success', 'Estoque não existe.');
    return redirect()->route('/estoque/listar');
  }

  public function removerItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);
    

    if (isset($estoque_item)) {
      $estoque = \App\Estoque::find($estoque_item->estoque_id);

      if (isset($estoque)) {
        $estoque_item->delete();
        
        Log::info('Remover_Item_Estoque. User ['.$request->user()->id.
          ']. Method ['.$request->method().
          ']. Ip ['.$request->ip().
          ']. Agent ['.$request->header('user-agent').
          ']. Url ['.$request->path().']');

        session()->flash('success', 'Remoção de item.');
        return redirect()->route('/estoque/exibirItensEstoque',[$estoque]);
      }
      
      
      session()->flash('success', 'Estoque não existe.');
      return redirect()->route('/estoque/listar');
    }

    session()->flash('success', 'Item não existe.');
    return redirect()->route('/estoque/listar');
  }

  public function abrirEntradaItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);
    
    return view("EntradaItemEstoque", [
        "estoque_item" => $estoque_item
    ]);
  }

  public function entradaItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);

    if (isset($estoque_item)) {
      $estoque = \App\Estoque::find($estoque_item->estoque_id);
      if (isset($estoque)) {

        $contrato_item = \App\Contrato_item::find($estoque_item->contrato_id);

        $validator = Validator::make($request->all(), [
          'quantidade_danificados' => ['required', 'integer', 'between:0,99999'],
          'quantidade' =>             ['required', 'integer', 'between:0,99999'],
        ],[
          'quantidade_danificados.required' => 'A quantidade danificada é obrigatória',
          'quantidade_danificados.integer' => 'A quantidade danificada deve ser um número inteiro',
          'quantidade_danificados.between' => 'A quantidade danificada deve estar entre 0 e 99999',
          'quantidade.required' => 'A quantidade é obrigatória',
          'quantidade.integer' => 'A quantidade deve ser um número inteiro',
          'quantidade.between' => 'A quantidade deve estar entre 0 e 99999',
        ]);
  
        if ($validator->fails()) {
            return redirect()->route('/estoque/inserirEntrada',[$estoque_item->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($contrato_item->quantidade < $request->quantidade+$request->quantidade_danificados or $contrato_item->quantidade <= 0) {
          session()->flash('success', 'Contrato não tem quantidade suficiente.');
          return redirect()->route('/estoque/listar');
        }

        $estoque_item->quantidade += $request->quantidade;
        $estoque_item->quantidade_danificados += $request->quantidade_danificados;
        //$estoque_item->item_id = $request->item_id;
        //$estoque_item->estoque_id = $request->estoque_id;
        //$estoque_item->contrato_id = $request->contrato_id;
        
        $contrato_item = \App\Contrato_item::where('contrato_id','=',$estoque_item->contrato_id)
                                           ->where('item_id','=',$estoque_item->item_id)
                                           ->first();
        $contrato_item->quantidade -= ($request->quantidade + $request->quantidade_danificados);
  
        
        $estoque_item->save();
        $contrato_item->save();
        
        Log::info('Entrada_Item_Estoque. User ['.$request->user()->id.
          ']. Method ['.$request->method().
          ']. Ip ['.$request->ip().
          ']. Agent ['.$request->header('user-agent').
          ']. Url ['.$request->path().']');
        
          session()->flash('success', 'Entrada de item.');
        return redirect()->route('/estoque/exibirItensEstoque',[$estoque]);
      }
      
  
      session()->flash('success', 'Estoque não existe.');
      return redirect()->route('/estoque/listar');
    }
  
    session()->flash('success', 'Item não existe.');
    return redirect()->route('/estoque/listar');
  }

  public function abrirSaidaItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);
    
    return view("SaidaItemEstoque", [
        "estoque_item" => $estoque_item
    ]);
  }

  public function saidaItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);

    if (isset($estoque_item)) {
      $estoque = \App\Estoque::find($estoque_item->estoque_id);
      if (isset($estoque)) {

        $validator = Validator::make($request->all(), [
          'quantidade_danificados' => ['required', 'integer', 'between:0,99999'],
          'quantidade' =>             ['required', 'integer', 'between:0,'.$estoque_item->quantidade],
        ],[
          'quantidade_danificados.required' => 'A quantidade danificada é obrigatória',
          'quantidade_danificados.integer' => 'A quantidade danificada deve ser um número inteiro',
          'quantidade_danificados.between' => 'A quantidade danificada deve estar entre 0 e 99999',
          'quantidade.required' => 'A quantidade é obrigatória',
          'quantidade.integer' => 'A quantidade deve ser um número inteiro',
          'quantidade.between' => 'A quantidade deve estar entre 0 e '.$estoque_item->quantidade,
        ]);
  
        if ($validator->fails()) {
            return redirect()->route('/estoque/inserirSaida',[$estoque_item->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->quantidade >= 0 && $request->quantidade_danificados >= 0) {
          if ($request->quantidade <= $estoque_item->quantidade &&
              $request->quantidade_danificados <= $estoque_item->quantidade_danificados) {
                
                $estoque_item->quantidade -= $request->quantidade;
                $estoque_item->quantidade_danificados -= $request->quantidade_danificados;
                $estoque_item->item_id = $request->item_id;
                $estoque_item->estoque_id = $request->estoque_id;
                
                
                $estoque_item->save();
                
                Log::info('Saida_Item_Estoque. User ['.$request->user()->id.
                  ']. Method ['.$request->method().
                  ']. Ip ['.$request->ip().
                  ']. Agent ['.$request->header('user-agent').
                  ']. Url ['.$request->path().']');

          }
          elseif ($request->quantidade > $estoque_item->quantidade) {
            return redirect()->back() ->with('alert', 'Quantidade insuficiente');
          }
          else {
            return redirect()->back() ->with('alert', 'Quantidade de itens danificados insuficiente');
          }
        }
    
        session()->flash('success', 'Saída de item.');
        return redirect()->route('/estoque/exibirItensEstoque',[$estoque]);
      }

      return redirect()->back() ->with('alert', 'Estoque não existe.');
    }
    

    //session()->flash('success', 'Item não existe.');
    return redirect()->back() ->with('alert', 'Item não existe.');
    //return redirect()->route('/estoque/listar');
  }

  /* public function mostrarHistorico(Request $request){
    $itens_historico = \App\Estoque_es::where('estoque_id', '=', $request->id)->get();

    return view("HistoricoEstoque", ["itens_historico" => $itens_historico]);
  } */
}
