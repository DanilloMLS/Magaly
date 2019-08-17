<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estoque_item;

class EstoqueController extends Controller
{
  public function cadastrar(Request $request) {
    $estoque = \App\Estoque::where('nome',$request->nome);

    $estoque = new \App\Estoque();
    $estoque->nome = $request->nome;
    $estoque->save();

    $itens_contrato = \App\Contrato_item::all();
    //$itens = \App\Item::all();

    session()->flash('success', 'Estoque cadastrado com sucesso. Insira seus itens.');
    return view("InserirNovoItemEstoque", [
      "estoque" => $estoque,
      "itens_contrato" => $itens_contrato
    ]);
  }

  public function listar(){
    $estoques = \App\Estoque::all();
    return view("ListarEstoques", ["estoques" => $estoques]);
  }

    public function gerarRelatorio(){
        $estoques = \App\Estoque::all();
        //return view("VisualizarItensEstoque", ["itens" => $itens]);
        //return view("ListarEstoques", ["estoques" => $estoques]);

        return  \PDF::loadView('RelatorioEstoques', compact('estoques'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('relatorio_Estoque.pdf');
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
      
      $estoques = \App\Estoque::all();

      session()->flash('success', 'O Estoque pertence a uma Escola, remova a Escola.');
      return view("ListarEstoques", ["estoques" => $estoques]);
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
        $estoques = \App\Estoque::all();

        session()->flash('success', 'Estoque não existe.');
        return view("ListarEstoques", ["estoques" => $estoques]); 
      }
      
      $estoques = \App\Estoque::all();

      session()->flash('success', 'O Estoque pertence a uma Escola, renomeie a Escola.');
      return view("ListarEstoques", ["estoques" => $estoques]);     
  }

  public function salvar(Request $request){
    $estoque = \App\Estoque::find($request->id);

    if (isset($estoque)) {
      $estoque->nome = $request->nome;
      $estoque->save();
      session()->flash('success', 'Estoque renomeado com sucesso.');
      return redirect()->route('/estoque/listar');
    }

    $estoques = \App\Estoque::all();

    session()->flash('success', 'Estoque não existe.');
    return view("ListarEstoques", ["estoques" => $estoques]);       
  }

  public function finalizarEstoque(Request $request) {

    $estoques = \App\Estoque::all();

    session()->flash('success', 'Estoque cadastrado.');
    return view("ListarEstoques", ["estoques" => $estoques]);
  }

  public function exibirItensEstoque(Request $request){
    $estoque = \App\Estoque::find($request->id);

    if (isset($estoque)) {
      $itens = \App\Estoque_item::where('estoque_id', '=', $request->id)->get();
      return view("VisualizarItensEstoque", ["itens" => $itens]);
    }
    
    $estoques = \App\Estoque::all();

    session()->flash('success', 'Estoque não existe.');
    return view("ListarEstoques", ["estoques" => $estoques]);
  }

  //usado quando se insere itens no Estoque atráves do botão 'Inserir Itens'
  public function buscarEstoque(Request $request){
    $estoque = \App\Estoque::find($request->id);
    $itens_contrato = \App\Contrato_item::all();
    //$contratos = \App\Contrato::all();
    //$fornecedores = \App\Fornecedor::all();

    if (isset($estoque)) {
      //$itens = \App\Item::all();
      return view("InserirNovoItemEstoque", [
        "estoque" => $estoque,
        "itens_contrato" => $itens_contrato
      ]);
    }
    
    $estoques = \App\Estoque::all();

    session()->flash('success', 'Estoque não existe.');
    return view("ListarEstoques", ["estoques" => $estoques]); 
  }

  public function novoItem(Request $request){
    $estoque = \App\Estoque::find($request->estoque_id);

    //impede a inserção de um Item se já tem um com o mesmo Id no Estoque
    if (isset($estoque)) {
      $estoque_item = \App\Estoque_item::where('estoque_id','=',$request->estoque_id)
                                       ->where('item_id','=',$request->item_id)
                                       ->first();
      if (isset($estoque_item)){
        //$itens = \App\Item::all();
      
        session()->flash('success', "Esse Item já existe no estoque.");
        $itens = \App\Estoque_item::where('estoque_id', '=', $request->estoque_id)->get();
        return view("VisualizarItensEstoque", ["itens" => $itens]);
      }

      $estoque_item = new \App\Estoque_item();
      $estoque_item->quantidade = $request->quantidade;
      $estoque_item->quantidade_danificados = $request->quantidade_danificados;
      $estoque_item->item_id = $request->item_id;
      $estoque_item->estoque_id = $request->estoque_id;

      $estoque_es = new \App\Estoque_es();
      $estoque_es->quantidade_danificados = $request->quantidade_danificados;
      $estoque_es->quantidade = $request->quantidade;
      $estoque_es->operacao = "inserção";
      $estoque_es->item_id = $request->item_id;
      $estoque_es->estoque_id = $request->estoque_id;
      
      $estoque_item->save();
      $estoque_es->save();

      //$itens = \App\Item::all();
      $itens_contrato = \App\Contrato_item::all();
      //$contratos = \App\Contrato::all();
      //$fornecedores = \App\Fornecedor::all();
      session()->flash('success', 'Inserção de novo item.');
      return view("InserirNovoItemEstoque", [
        "estoque" => $estoque, 
        "itens_contrato" => $itens_contrato,
      ]);
    }
    $estoques = \App\Estoque::all();

    session()->flash('success', 'Estoque não existe.');
    return view("ListarEstoques", ["estoques" => $estoques]); 
  }

  public function removerItem(Request $request){
    $estoque_item = \App\Estoque_item::find($request->id);
    

    if (isset($estoque_item)) {
      $estoque = \App\Estoque::find($estoque_item->estoque_id);

      if (isset($estoque)) {
        $estoque_es = new \App\Estoque_es();
        $estoque_es->quantidade_danificados = 0;
        $estoque_es->quantidade = 0;
        $estoque_es->operacao = "removido";
        $estoque_es->item_id = $estoque_item->item_id;
        $estoque_es->estoque_id = $estoque_item->estoque_id;
      
      
        $estoque_es->save();
        $estoque_item->delete();

        $itens = \App\Estoque_item::where('estoque_id', '=', $estoque_es->estoque_id)->get();
        //$request->id = null;
        session()->flash('success', 'Remoção de item.');
        return view("VisualizarItensEstoque", ["itens" => $itens]);
      }
      
      $estoques = \App\Estoque::all();

      session()->flash('success', 'Estoque não existe.');
      return view("ListarEstoques", ["estoques" => $estoques]);
    }
    $estoques = \App\Estoque::all();

    session()->flash('success', 'Item não existe.');
    return view("ListarEstoques", ["estoques" => $estoques]); 
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
        $estoque_item->quantidade += $request->quantidade;
        $estoque_item->quantidade_danificados += $request->quantidade_danificados;
        $estoque_item->item_id = $request->item_id;
        $estoque_item->estoque_id = $request->estoque_id;
        $estoque_item->save();
        $itens = \App\Estoque_item::where('estoque_id', '=', $estoque_item->estoque_id)->get();
  
        $estoque_es = new \App\Estoque_es();
        $estoque_es->quantidade_danificados = $request->quantidade_danificados;
        $estoque_es->quantidade = $request->quantidade;
        $estoque_es->operacao = "entrada";
        $estoque_es->item_id = $request->item_id;
        $estoque_es->estoque_id = $request->estoque_id;
        $estoque_es->save();
        
        session()->flash('success', 'Entrada de item.');
        return view("VisualizarItensEstoque", ["itens" => $itens]);
      }
      
      $estoques = \App\Estoque::all();
  
      session()->flash('success', 'Estoque não existe.');
      return view("ListarEstoques", ["estoques" => $estoques]);
    }
    $estoques = \App\Estoque::all();
  
    session()->flash('success', 'Item não existe.');
    return view("ListarEstoques", ["estoques" => $estoques]);
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
        if ($request->quantidade >= 0 && $request->quantidade_danificados >= 0) {
          if ($request->quantidade <= $estoque_item->quantidade &&
              $request->quantidade_danificados <= $estoque_item->quantidade_danificados) {
                
                $estoque_item->quantidade -= $request->quantidade;
                $estoque_item->quantidade_danificados -= $request->quantidade_danificados;
                $estoque_item->item_id = $request->item_id;
                $estoque_item->estoque_id = $request->estoque_id;
                
                $estoque_es = new \App\Estoque_es();
                $estoque_es->quantidade_danificados = $request->quantidade_danificados;
                $estoque_es->quantidade = $request->quantidade;
                $estoque_es->operacao = "saida";
                $estoque_es->item_id = $request->item_id;
                $estoque_es->estoque_id = $request->estoque_id;
                
                $estoque_item->save();
                $estoque_es->save();
          }
          elseif ($request->quantidade > $estoque_item->quantidade) {
            return redirect()->back() ->with('alert', 'Quantidade insuficiente');
          }
          else {
            return redirect()->back() ->with('alert', 'Quantidade de itens danificados insuficiente');
          }
        }
    
        $itens = \App\Estoque_item::where('estoque_id', '=', $estoque_item->estoque_id)->get();
        
        session()->flash('success', 'Saída de item.');
        return view("VisualizarItensEstoque", ["itens" => $itens]);
      }
      $estoques = \App\Estoque::all();

      session()->flash('success', 'Estoque não existe.');
      return view("ListarEstoques", ["estoques" => $estoques]);
    }
    
    $estoques = \App\Estoque::all();

    session()->flash('success', 'Item não existe.');
    return view("ListarEstoques", ["estoques" => $estoques]);
  }

  public function mostrarHistorico(Request $request){
    //$itens_historico = \App\Estoque_es::find($request->id);
    $itens_historico = \App\Estoque_es::where('estoque_id', '=', $request->id)->get();

    return view("HistoricoEstoque", ["itens_historico" => $itens_historico]);
  }
}
