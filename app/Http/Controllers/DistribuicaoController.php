<?php

namespace App\Http\Controllers;

use App\Distribuicao;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    
    $validator = Validator::make($request->all(), [
      'observacao' =>   ['nullable', 'string', 'max:1500'],
      'escola_id' =>    ['required', 'integer', 'exists:escolas,id'],
      'cardapio_id' =>  ['required', 'integer', 'exists:cardapio_mensals,id'],
      'estoque_id' =>   ['required', 'integer', 'exists:estoques,id'],
      'token' => ['integer', 'required', 'unique:distribuicao,token','min:0'],
    ],[
      'observacao.max' => 'Observação deve ter no máximo 1500 caracteres',
      'escola_id.required' => 'Escolha uma escola',
      'cardapio_id.required' => 'Escolha um cardápio',
      'estoque_id.required' => 'Escolha um estoque',
    ]);

    if ($validator->fails()) {
        return redirect('distribuicao/telaCadastrar')
                    ->withErrors($validator)
                    ->withInput();
    }

    $sffledStr= str_shuffle('abscdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_-+');
    $uniqueString = md5(time().$sffledStr).md5(time().$sffledStr);

    $distribuicao = new \App\Distribuicao();
    $distribuicao->observacao = $request->observacao;
    $distribuicao->escola_id = $request->escola_id;
    $distribuicao->cardapio_id = $request->cardapio_id;
    $distribuicao->estoque_id = $request->estoque_id;
    $distribuicao->token =$uniqueString;
    $distribuicao->save();
    //LogActivity::addToLog('Cadastro de Distribuição.');
    
    Log::info('Cadastro_Distribuicao. User ['.$request->user()->id.
        ']. Method ['.$request->method().
        ']. Ip ['.$request->ip().
        ']. Agent ['.$request->header('user-agent').
        ']. Url ['.$request->path().']');

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
            $distribuicao_item->quantidade_falta = intval(ceil($distribuicao_item->quantidade_total));
            $distribuicao_item->quantidade_danificados = 0;
            $distribuicao_item->save();

          } else {
            $distribuicao_item = \App\Distribuicao_item::where('item_id', '=', $i->item_id)->where('distribuicao_id', '=', $distribuicao->id)->first();
            $distribuicao_item->quantidade = $distribuicao_item->quantidade + $i->quantidade;
            //quantidade_total
            $distribuicao_item->quantidade_total = ($distribuicao_item->quantidade * $escola->qtde_alunos) / ($item->gramatura);
            $distribuicao_item->quantidade_falta = intval(ceil($distribuicao_item->quantidade_total));
            $distribuicao_item->quantidade_danificados = 0;
            $distribuicao_item->save();
          }
          Log::info('Inserir_Itens_Distribuicao. User ['.$request->user()->id.
            ']. Method ['.$request->method().
            ']. Ip ['.$request->ip().
            ']. Agent ['.$request->header('user-agent').
            ']. Url ['.$request->path().']');
        }
    }

    //$distribuicao_itens = \App\Distribuicao_item::where('distribuicao_id', '=', $distribuicao->id)->get();

    session()->flash('success', 'Distribuição cadastrada com sucesso. Confira seus itens.');
    return redirect()->route('/distribuicao/exibirItensDistribuicao',[$distribuicao]);
  }

  //puxa distribuição para dar baixa
  public function buscarDistribuicao(Request $request){
    $distribuicao = \App\Distribuicao::find($request->id);
    $distribuicao_itens = \App\Distribuicao_item::where('distribuicao_id','=',$request->id)->get();

    if (isset($distribuicao)) {
      return view("BaixaDistribuicao", [
        "distribuicao" => $distribuicao,
        "distribuicao_itens" => $distribuicao_itens]);
    }
  }

  public function buscarItemDistribuicao(Request $request){
    $distribuicao_item = \App\Distribuicao_item::find($request->id);

    if (isset($distribuicao_item)) {
      return view("BaixaItemDistribuicao", [
        "distribuicao_item" => $distribuicao_item
      ]);
    }

    return redirect()->route('/distribuicao/listar')->with('Esse item não existe.');
  }

  public function baixaDistribuicao(Request $request){
    $distribuicao = \App\Distribuicao::find($request->id);
    $distribuicao_itens = \App\Distribuicao_item::where('distribuicao_id', '=', $distribuicao->id)->get();

    foreach ($distribuicao_itens as $distribuicao_item) {
      //procurar o Item pelo id, com isso acho o nome dele
      $item_nome = \App\Item::find($distribuicao_item->item_id);
      
      //procuro outros Itens com o mesmo nome e,
      $itens_nome = \App\Item::select('id')->where('nome','=',$item_nome->nome)->get();
      
      //com os ids acho os Itens no Estoque que tenham o mesmo nome
      $estoque_central_itens = \App\Estoque_item::whereIn('item_id',$itens_nome)
                                                ->where('estoque_id','=',$distribuicao->estoque_id)
                                                ->get();
                                              
      
      //condição para Item inexistente no Estoque
      if (isset($estoque_central_itens)){
        //quantidade de itens que devem sair do estoque_central
        $qtde_restante = $distribuicao_item->quantidade_aceita;
        //cada item será retirado do estoque
        foreach ($estoque_central_itens as $estoque_central_item) {
          //subtrair do estoque_central (origem)
          if ($estoque_central_item->quantidade >= $qtde_restante) {
            $estoque_central_item->quantidade -= $qtde_restante;
            $estoque_central_item->save();
            $qtde_restante = 0;
            //$distribuicao_item->quantidade_falta += $qtde_restante;
            $distribuicao_item->quantidade_falta = intval(ceil($distribuicao_item->quantidade_total - $distribuicao_item->quantidade_aceita));
            $distribuicao_item->save();
          } else {
            $temp = $estoque_central_item->quantidade;
            $estoque_central_item->quantidade = 0;
            $estoque_central_item->save();
            $qtde_restante -= $temp;
            //$distribuicao_item->quantidade_falta += $qtde_restante;
            $distribuicao_item->quantidade_falta = intval(ceil($distribuicao_item->quantidade_total - $distribuicao_item->quantidade_aceita));
            $distribuicao_item->save();
          }
          if ($qtde_restante <= 0) {
            break;
          }
        }

        $escola = \App\Escola::find($distribuicao->escola_id);
        //adicionar ao estoque_escola (destino)
        $estoque_escola_item = \App\Estoque_item::where('estoque_id','=',$escola->estoque_id)
                                                ->where('item_id','=',$distribuicao_item->item_id)
                                                ->first();
        if (isset($estoque_escola_item)) {
          $estoque_escola_item->quantidade += $distribuicao_item->quantidade_aceita;
          $estoque_escola_item->save();
        } else {
          $estoque_escola_item = new \App\Estoque_item();
          $estoque_escola_item->quantidade = $distribuicao_item->quantidade_aceita;
          $estoque_escola_item->quantidade_danificados = 0;
          $estoque_escola_item->item_id = $distribuicao_item->item_id;
          $estoque_escola_item->estoque_id = $escola->estoque_id;
          $estoque_escola_item->contrato_id = $estoque_central_item->contrato_id;
          $estoque_escola_item->n_lote = $estoque_central_item->n_lote;
          $estoque_escola_item->data_validade = $estoque_central_item->data_validade;
          $estoque_escola_item->save();
        }
      } else {
        $distribuicao_item->quantidade_falta += $qtde_restante;
        $distribuicao_item->save();
      }
    }


    $sffledStr= str_shuffle('abscdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_-+');
    $uniqueString = md5(time().$sffledStr).md5(time().$sffledStr);

    $this->gerarDistribuicaoRest($distribuicao);
    $distribuicao->baixada = true;
    $distribuicao->token =$uniqueString;
    $distribuicao->save();
    
    Log::info('Baixa_Distribuicao. User ['.$request->user()->id.
        ']. Method ['.$request->method().
        ']. Ip ['.$request->ip().
        ']. Agent ['.$request->header('user-agent').
        ']. Url ['.$request->path().']');

    session()->flash('success', 'Baixa cadastrada. Movimentações nos estoques feitas automaticamente.');
    return redirect()->route('/distribuicao/listar');
  }

  //atualiza as quantidades do item da distribuicação
  public function baixaItemDistribuicao(Request $request){
    $distribuicao_item = \App\Distribuicao_item::find($request->id);

    $validator = Validator::make($request->all(), [
      'quantidade_danificados' => ['required', 'integer', 'between:0,5000000'],
      'quantidade_aceita' =>      ['required', 'integer', 'between:0,5000000'],
    ]);

    if ($validator->fails()) {
        return redirect()->route('/distribuicao/baixaItem',[$distribuicao_item->id])
                    ->withErrors($validator)
                    ->withInput();
    }

    $distribuicao_item->quantidade_aceita = $request->quantidade_aceita;
    $distribuicao_item->quantidade_falta = intval(ceil($distribuicao_item->quantidade_total - $request->quantidade_aceita));
    $distribuicao_item->quantidade_danificados = $request->quantidade_danificados;
    $distribuicao_item->baixado = true;
    $distribuicao_item->save();
    
    Log::info('Baixa_Item_Distribuicao. User ['.$request->user()->id.
        ']. Method ['.$request->method().
        ']. Ip ['.$request->ip().
        ']. Agent ['.$request->header('user-agent').
        ']. Url ['.$request->path().']');

    return redirect()->route('/distribuicao/novaBaixa',[$distribuicao_item->distribuicao_id]);
  }

  //gera uma nova distribuição com os itens em falta
  private function gerarDistribuicaoRest(Distribuicao $distribuicao){
    //$distribuicao = \App\Distribuicao::find($ris->id);
    $distribuicao_itens = \App\Distribuicao_item::where('distribuicao_id','=',$distribuicao->id)
                                                ->where('quantidade_falta','>',0)
                                                ->get();

    if (count($distribuicao_itens) > 0) {
      $nova_distribuicao = new \App\Distribuicao();
      $nova_distribuicao->observacao = '#'.$distribuicao->id;
      $nova_distribuicao->escola_id = $distribuicao->escola_id;
      $nova_distribuicao->cardapio_id = $distribuicao->cardapio_id;
      $nova_distribuicao->estoque_id = $distribuicao->estoque_id;
      $nova_distribuicao->save();
      $distribuicao->proxima = $nova_distribuicao->id;
      $distribuicao->save();
      foreach ($distribuicao_itens as $distribuicao_item) {
        $novo_distribuicao_item = new \App\Distribuicao_item();
        $novo_distribuicao_item->item_id = $distribuicao_item->item_id;
        $novo_distribuicao_item->distribuicao_id = $nova_distribuicao->id;
        $novo_distribuicao_item->quantidade = $distribuicao_item->quantidade;
        $novo_distribuicao_item->quantidade_danificados = $distribuicao_item->quantidade_danificados;
        $novo_distribuicao_item->quantidade_falta = $distribuicao_item->quantidade_falta;
        $novo_distribuicao_item->quantidade_total = $distribuicao_item->quantidade_total;
        $novo_distribuicao_item->save();
      }
    }
    //LogActivity::addToLog('Criação de Distribuição com base em faltas de outra.');
  }

  public function listar(){
    $distribuicoes = \App\Distribuicao::orderBy('baixada')->orderBy('observacao')->get();
    return view("ListarDistribuicoes", ["distribuicoes" => $distribuicoes]);
  }

    public function gerarRelatorio(Request $request){
        $distribuicoes = \App\Distribuicao::where('token', '=', $request->token)->get();
        $production = "";
        if($_SERVER['SERVER_NAME'] == "127.0.0.1"){
          $production = ":8000";
        }
        $url = $_SERVER['SERVER_NAME'].$production.$_SERVER["REQUEST_URI"];
        if(count($distribuicoes) > 0){
          //return view("RelatorioDistribuicao", ["distribuicoes" => $distribuicoes]);
          $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");

          return  \PDF::loadView('RelatorioDistribuicoes', compact('distribuicoes', 'url'))
              // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
              ->stream('relatorio_Distribuicao_'.$data.'.pdf');
        }
        return abort(404); 
    }

  public function remover(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);

      if (isset($distribuicao)) {
        $distribuicao->delete();
        //LogActivity::addToLog('Remoção de Distribuição.');
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

  //fora de circulação
  public function salvar(Request $request){
      $distribuicao = \App\Distribuicao::find($request->id);

      if (isset($distribuicao)) {
        $validator = Validator::make($request->all(), [
          'observacao' =>   ['nullable', 'string', 'max:1500'],
          'escola_id' =>    ['required', 'numeric', 'exists:escolas,id'],
          'cardapio_id' =>  ['required', 'numeric', 'exists:cardapio,id'],
          'proxima' =>      ['nullable', 'numeric', 'exists:distribuicaos,id'],
          'estoque_id' =>   ['required', 'numeric', 'exists:estoques,id'],
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('/distribuicao/editar',[$distribuicao->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $distribuicao->observacao = $request->observacao;
        $distribuicao->escola_id = $request->escola_id;
        $distribuicao->save();
        //LogActivity::addToLog('Alteração em Distribuição.');

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

    //$itens = \App\Distribuicao_item::where('distribuicao_id', '=', $item_distribuicao->distribuicao_id)->get();
    //return view("VisualizarItensDistribuicao", ["itens" => $itens]);
    return redirect()->back()->with('alert', 'Item não existe.');
  }

  public function salvarItemDistribuicao(Request $request){
    $item_distribuicao = \App\Distribuicao_item::find($request->id);
    
    if (isset($item_distribuicao)) {

      $validator = Validator::make($request->all(), [
        'quantidade_total' => ['required', 'integer', 'between:0,5000000'],
        
      ]);
  
      if ($validator->fails()) {
          return redirect()->route('/itemDistribuicao/editar',[$item_distribuicao->id])
                      ->withErrors($validator)
                      ->withInput();
      }

      $item_distribuicao->quantidade_total = $request->quantidade_total;
      $item_distribuicao->save();
      //LogActivity::addToLog('Alteração da quantidade total de Item de Distribuição.');

      session()->flash('success', 'Item da distribuição modificado com sucesso.');
      return redirect()->route('/distribuicao/exibirItensDistribuicao', [
        "distribuicao" => $item_distribuicao->distribuicao_id
        ]);
    }
    
    return redirect()->back()->with('alert','Item não existe.');
  }
}
