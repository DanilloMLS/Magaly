<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistribuicaoController extends Controller
{

  public function telaCadastrar() {
    $escolas = \App\Escola::all();
    $cardapios = \App\Cardapio_mensal::all();

    $ids_escolas = [];
    foreach ($escolas as $escola) {
      $ids_escolas[] = $escola->estoque_id;
    }
    $estoques = \App\Estoque::whereNotIn('id',$ids_escolas)->get();

    return view("CadastrarDistribuicao", [
        "escolas" => $escolas,
        "cardapios" => $cardapios,
        "estoques" => $estoques
    ]);
  }

  public function cadastrar(Request $request) {

    $distribuicao = new \App\Distribuicao();
    $distribuicao->observacao = $request->observacao;
    $distribuicao->escola_id = $request->escola_id;
    $distribuicao->cardapio_id = $request->cardapio_id;
    $distribuicao->save();
    $escola = \App\Escola::find($request->escola_id);

    //todos os cardapios diários
    $cardapios_diarios = \App\Cardapio_diario::where('cardapio_mensal_id', '=', $request->cardapio_id)->get();
    $cardapios_refeicoes = array();
    foreach ($cardapios_diarios as $cardapio) {
      //todas as refeicoes de todos os cardápios diários
      $cardapio_refeicao = \App\cardapio_diario_refeicao::where('cardapio_diario_id', '=', $cardapio->id)->get();
      foreach ($cardapio_refeicao as $c) {
        $refeicao = \App\Refeicao::find($c->refeicao_id);
        array_push($cardapios_refeicoes, $refeicao);
      }

    }

    $itens_dist = array();
    foreach ($cardapios_refeicoes as $cr) {
        //todos os itens de todas as refeições
        $item_refeicao = \App\Refeicao_item::where('refeicao_id', '=', $cr->id)->get();
        foreach ($item_refeicao as $i) {
          $item = \App\Item::find($i->item_id);
          if(!in_array($item, $itens_dist)){
            array_push($itens_dist, $item);
            //cria nova distribuicao_item
            $distribuicao_item = new \App\Distribuicao_item();
            $distribuicao_item->quantidade = $i->quantidade;
            $distribuicao_item->quantidade_total = ($i->quantidade * $escola->qtde_alunos) / ($item->gramatura);
            $distribuicao_item->item_id = $i->item_id;
            $distribuicao_item->distribuicao_id = $distribuicao->id;
            $distribuicao_item->quantidade_falta = $distribuicao_item->quantidade_total;
            $distribuicao_item->quantidade_danificados = 0;
            $distribuicao_item->save();

          } else {
            $distribuicao_item = \App\Distribuicao_item::where('item_id', '=', $i->item_id)->where('distribuicao_id', '=', $distribuicao->id)->first();
            $distribuicao_item->quantidade = $distribuicao_item->quantidade + $i->quantidade;
            //quantidade_total
            $distribuicao_item->quantidade_total = ($distribuicao_item->quantidade * $escola->qtde_alunos) / ($item->gramatura);
            $distribuicao_item->quantidade_falta = $distribuicao_item->quantidade_total;
            $distribuicao_item->quantidade_danificados = 0;
            $distribuicao_item->save();
          }
        }
    }

    //$distribuicao_itens = \App\Distribuicao_item::where('distribuicao_id', '=', $distribuicao->id)->get();

    session()->flash('success', 'Distribuição cadastrada com sucesso.');
    //return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $distribuicao_itens]);
    //return redirect()->route('/distribuicao/novaBaixa',[$distribuicao]);
    return redirect()->route('/distribuicao/listar');
  }

  public function buscarDistribuicao(Request $request){
    $distribuicao = \App\Distribuicao::find($request->distribuicao_id);
    $distribuicao_itens = \App\Distribuicao_item::where('distribuicao_id','=',$request->distribuicao_id)->get();

    if (isset($distribuicao)) {
      return view("BaixaDistribuicao", [
        "distribuicao" => $distribuicao,
        "distribuicao_itens" => $distribuicao_itens]);
    }
  }

  public function baixaDistribuicao(Request $request){
    $distribuicao = \App\Distribuicao::find($request->distribuicao_id);
    $distribuicao_itens = \App\Distribuicao_item::where('distribuicao_id', '=', $distribuicao->id)->get();

    /* foreach ($distribuicao_itens as $distribuicao_item) {
      //procurar o Item pelo id, com isso acho o nome dele
      $item_nome = \App\Item::find($distribuicao_item->item_id);

      //procuro outros Itens com o mesmo nome e,
      $itens_nome = \App\Item::select('id')->where('nome','=',$item_nome->nome)->get();

      //com os ids acho os Itens no Estoque que tenham o mesmo nome
      $estoque_central_itens = \App\Estoque_item::whereIn('item_id',$itens_nome)
                                                ->where('estoque_id','=',$request->estoque_id)
                                                ->get();
      //condição para Item inexistente no Estoque
      if (isset($estoque_central_itens)){
        //quantidade de itens que devem sair do estoque_central
        $qtde_restante = intval(ceil($distribuicao_item->quantidade_total));
        //cada item será retirado do estoque
        foreach ($estoque_central_itens as $estoque_central_item) {
          //subtrair do estoque_central (origem)
          if ($estoque_central_item->quantidade >= $qtde_restante) {
            $estoque_central_item->quantidade -= $qtde_restante;
            $estoque_central_item->save();
            $qtde_restante = 0;
            $distribuicao_item->quantidade_falta = $qtde_restante;
            $distribuicao_item->save();
          } else {
            $temp = $estoque_central_item->quantidade;
            $estoque_central_item->quantidade = 0;
            $estoque_central_item->save();
            $qtde_restante -= $temp;
            $distribuicao_item->quantidade_falta = $qtde_restante;
            $distribuicao_item->save();
          }
          if ($qtde_restante <= 0) {
            break;
          }
        }

        $escola = \App\Escola::find($request->escola_id);
        //adicionar ao estoque_escola (destino)
        $estoque_escola_item = \App\Estoque_item::where('estoque_id','=',$escola->estoque_id)
                                                ->where('item_id','=',$distribuicao_item->item_id)
                                                ->first();
        if (isset($estoque_escola_item)) {
          $estoque_escola_item->quantidade += intval(ceil($distribuicao_item->quantidade_total));
          $estoque_escola_item->save();
        } else {
          $estoque_escola_item = new \App\Estoque_item();
          $estoque_escola_item->quantidade = intval(ceil($distribuicao_item->quantidade_total));
          $estoque_escola_item->quantidade_danificados = 0;
          $estoque_escola_item->item_id = $distribuicao_item->item_id;
          $estoque_escola_item->estoque_id = $escola->estoque_id;
          $estoque_escola_item->contrato_id = $estoque_central_item->contrato_id;
          $estoque_escola_item->save();
        }
      } else {
        $distribuicao_item->quantidade_falta = $qtde_restante;
        $distribuicao_item->save();
      }
    } */
  }

  public function listar(){
    $distribuicoes = \App\Distribuicao::orderBy('id')->paginate(10);
    return view("ListarDistribuicoes", ["distribuicoes" => $distribuicoes]);
  }

    public function gerarRelatorio(){
        $distribuicoes = \App\Distribuicao::All();
        //return view("RelatorioDistribuicao", ["distribuicoes" => $distribuicoes]);
        $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");
        return  \PDF::loadView('RelatorioDistribuicoes', compact('distribuicoes'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('relatorio_Distribuicao_'.$data.'.pdf');
    }

  public function remover(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);

      if (isset($distribuicao)) {
        $distribuicao->delete();
        session()->flash('success', 'Distribuicao removida com sucesso.');
        return redirect()->route('/distribuicao/listar');
      }

      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
    }

  public function editar(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);
      if (isset($distribuicao)) {
        $escolas = \App\Escola::all();
        return view("EditarDistribuicao", [
            "distribuicao" => $distribuicao,
            "escolas" => $escolas,
        ]);
      }
      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
  }

  public function salvar(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);

      if (isset($distribuicao)) {
        $distribuicao->observacao = $request->observacao;
        $distribuicao->escola_id = $request->escola_id;
        $distribuicao->save();

        session()->flash('success', 'Distribuicao modificada com sucesso.');
        return redirect()->route('/distribuicao/listar');
      }

      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
  }

  //fora de circulação
  public function inserirItemDistribuicao(Request $request) {
    $distribuicao_item = \App\Distribuicao_item::where('item_id','=',$request->item_id)
                                               ->where('distribuicao_id','=',$request->distribuicao_id)
                                               ->get()->first();

    $distribuicao = \App\Distribuicao::find($request->distribuicao_id);

    if (!isset($distribuicao_item)) {
      if (isset($distribuicao)) {
        $distribuicao_item = new \App\Distribuicao_item();
        $distribuicao_item->quantidade = $request->quantidade;
        $distribuicao_item->quantidade_falta = $request->quantidade_falta;
        $distribuicao_item->quantidade_danificados = $request->quantidade_danificados;
        $distribuicao_item->item_id = $request->item_id;
        $distribuicao_item->distribuicao_id = $request->distribuicao_id;
        $distribuicao_item->save();

        $itens = \App\Item::all();
        session()->flash('success', 'Item adicionado.');
        return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $itens]);
      }

      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
    }
    $itens = \App\Item::all();
    session()->flash('success', 'Esse item já existe.');
    return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $itens]);
  }

  //Fora de circulação
  public function removerItemDistribuicao(Request $request) {
    $distribuicao_item = \App\Distribuicao_item::find($request->id);
    $itens = \App\Item::all();


    if (isset($distribuicao_item)) {
      $distribuicao = \App\Distribuicao::find($distribuicao_item->distribuicao_id);

      if (isset($distribuicao)) {
        $distribuicao_item->delete();

        session()->flash('success', 'Item removido.');
        return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $itens]);
      }

      session()->flash('success', 'Distribuicao não existe.');
      return redirect()->route('/distribuicao/listar');
    }
    $distribuicao = \App\Distribuicao::find($distribuicao_item->distribuicao_id);
    session()->flash('success', 'Esse Item não existe na Distribuição.');
    return view("InserirItensDistribuicao", ["distribuicao" => $distribuicao, "itens" => $itens]);
  }

  public function finalizarDistribuicao(Request $request) {

    $distribuicoes = \App\Distribuicao::all();

    session()->flash('success', 'Distribuicao cadastrada.');
    return view("ListarDistribuicoes", ["distribuicoes" => $distribuicoes]);
  }

  public function exibirItensDistribuicao(Request $request){
    $itens = \App\Distribuicao_item::where('distribuicao_id', '=', $request->id)->get();
    return view("VisualizarItensDistribuicao", ["itens" => $itens]);
  }
  public function editarItemDistribuicao(Request $request){
    $item_distribuicao = \App\Distribuicao_item::find($request->id);

    if (isset($item_distribuicao)) {
      return view("EditarItemDistribuicao", [
        "item_distribuicao" => $item_distribuicao,
      ]);
    }

    $itens = \App\Distribuicao_item::where('distribuicao_id', '=', $item_distribuicao->distribuicao_id)->get();
    return view("VisualizarItensDistribuicao", ["itens" => $itens]);
  }

  public function salvarItemDistribuicao(Request $request){
    $item_distribuicao = \App\Distribuicao_item::find($request->id);

    $item_distribuicao->quantidade_total = $request->quantidade_total;
    $item_distribuicao->save();

    session()->flash('success', 'Item da distribuição modificado com sucesso.');
    $itens = \App\Distribuicao_item::where('distribuicao_id', '=', $item_distribuicao->distribuicao_id)->get();
    return view("VisualizarItensDistribuicao", ["itens" => $itens]);
  }
}
