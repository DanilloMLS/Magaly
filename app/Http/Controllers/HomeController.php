<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function index()
    {
        $data_nada_03 = [["Nada", 1, "#fe9363"], ["Nada", 1, "#fed948"],["Nada", 1, "#24fe8f"], ["Nada", 1, "#8a70b8"],["Nada", 1, "#8ad1fe"]];
        $data_nada_02 = [["Nada", 1], ["Nada", 1],["Nada", 1], ["Nada", 1],["Nada", 1]];
        $data01 = [];
        $data02 = [];
        $data03 = [];
        $cores = ["#fe9363","#fed948","#24fe8f", "#8a70b8", "#8ad1fe"];


        $contratos_itens = \App\Contrato_item::orderBy('quantidade')->where('quantidade', '>', 0)->get();
        $refeicoes = \App\Refeicao::orderBy('nome')->get();
        $estoques = \App\Estoque::orderBy('nome')->get();


        $aleatorio = 0;
        $refeicao = 0;
        $refeicao_itens = [];
        $porcent = 0;
        $nome_refeicao = "Dados Insuficientes";

        /*Início da coleta de dados do gráfico 01*/
        $cont = 0;
        if(count($contratos_itens) >= 5) {
            foreach ($contratos_itens as $C_item) {
                $vall = [];
                $item = \App\Item::find($C_item->item_id);
                array_push($vall, (string)$item->nome);
                array_push($vall, (int)$C_item->quantidade);
                array_push($vall, (string)$cores[$cont]);
                array_push($data01, $vall);
                $cont++;
                if ($cont >= 5) {
                    break;
                }
            }
        }else{
            $data01 = $data_nada_03;
        }

        /*Início da coleta de dados do gráfico 02*/
        if(count($refeicoes) > 0){
            $aleatorio = rand(0, count($refeicoes));
            $refeicao = $refeicoes[$aleatorio];
            $refeicao_itens = \App\Refeicao_item::where('refeicao_id', '=', $refeicao->id)->get();
            $porcent = 0;
            $nome_refeicao = $refeicao->nome;
            $refeicao = $refeicoes[$aleatorio];
            $refeicao_itens = \App\Refeicao_item::where('refeicao_id', '=', $refeicao->id)->get();
            $nome_refeicao = $refeicao->nome;
            $tot = 0;
            foreach($refeicao_itens as $it){
                $item = \App\Item::find($it->item_id);
                $tot += $item->gramatura;
            }

            foreach($refeicao_itens as $it){
                $vall = [];
                $item = \App\Item::find($it->item_id);
                array_push($vall, (string) $item->nome);
                array_push($vall, (int) $item->gramatura);
                array_push($data02, $vall);
            }
        }else{
            $data02 = $data_nada_02;
        }

        /*Início da coleta de dados do gráfico 03*/
        if(count($estoques) > 0){
            $aleatorio = rand(0, count($estoques));
            $estoque = $estoques[$aleatorio];
            $itens_estoque = \App\Estoque_item::where('estoque_id', '=', $estoque->id)->get();
            foreach($itens_estoque as $it){
                $vall = [];
                $item = \App\Item::find($it->item_id);
                array_push($vall, (string) $item->nome);
                array_push($vall, (int) $item->gramatura);
                array_push($data03, $vall);
            }
        }else{
            $data03 = $data_nada_03;
        }



        /*Início da coleta de dados do gráfico 04*/

        return view('home', ['data01' => $data01, 'data02' => $data02, 'data03' => $data03, 'nome_ref' => $nome_refeicao]);
    }
}
