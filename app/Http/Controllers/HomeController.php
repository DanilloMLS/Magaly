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
        $data04 = [];
        $cores = ["#2F4F4F","#696969","#708090","#778899","#BEBEBE","#1C1C1C","#363636","#4F4F4F","#696969","#828282","#9C9C9C",
        "#A9A9A9","#00008B","#008B8B","#8B008B","#8B0000","#90EE90","#000080","#6495ED","#483D8B","#6A5ACD","#8470FF","#0000CD",
        "#4169E1","#0000FF","#1E90FF","#00BFFF","#87CEEB","#87CEFA","#4682B4","#ADD8E6","#00CED1","#48D1CC","#00FFFF","#5F9EA0",
        "#66CDAA","#006400","#556B2F","#8FBC8F","#2E8B57","#3CB371","#20B2AA","#98FB98","#00FF7F","#7CFC00","#00FF00","#7FFF00",
        "#00FA9A","#ADFF2F","#32CD32","#9ACD32","#228B22","#6B8E23","#BDB76B","#EEE8AA","#FFFF00","#FFD700","#DAA520","#B8860B",
        "#BC8F8F","#CD5C5C","#8B4513","#A0522D","#CD853F","#DEB887","#F4A460","#D2B48C","#D2691E","#B22222","#A52A2A","#E9967A",
        "#FA8072","#FFA07A","#FFA500","#FF8C00","#FF7F50","#F08080","#FF6347","#FF4500","#FF0000","#FF69B4","#FF1493","#DB7093",
        "#B03060","#C71585","#D02090","#FF00FF","#EE82EE","#DA70D6","#BA55D3","#9932CC","#9400D3","#8A2BE2","#A020F0","#9370DB",
        "#8B8989","#8B8682","#8B7D6B","#CDAF95","#8B7765","#CDB38B","#8B795E","#FFFACD","#8B8878","#8B8B83","#838B83","#8B8386",
        "#8B7D7B","#838B8B","#3A5FCD","#27408B","#0000CD","#00008B","#1E90FF","#1C86EE","#1874CD","#104E8B","#4F94CD","#36648B",
        "#009ACD","#00688B","#6CA6CD","#4A708B","#8DB6CD","#607B8B","#9FB6CD","#6C7B8B","#9AC0CD","#B4CDCD","#7A8B8B","#668B8B",
        "#7AC5CD","#53868B","#00C5CD","#00868B","#00CDCD","#008B8B","#528B8B","#66CDAA","#458B74","#698B69","#2E8B57","#548B54",
        "#00CD66","#008B45","#008B00","#66CD00","#458B00","#9ACD32","#698B22","#BCEE68","#A2CD5A","#6E8B3D","#CDC673","#8B864E",
        "#8B814C","#8B8B7A","#CDCD00","#8B8B00","#FFD700","#EEC900","#CDAD00","#8B7500","#CD9B1D","#8B6914","#CD950C","#8B658B",
        "#CD9B9B","#8B6969","#CD5555","#8B3A3A","#8B4726","#CDAA7D","#8B7355","#8B7E66","#CD853F","#8B5A2B","#CD661D","#8B4513",
        "#FF3030","#EE2C2C","#CD2626","#8B1A1A","#FF4040","#EE3B3B","#CD3333","#8B2323","#CD7054","#8B4C39","#CD8500","#8B5A00",
        "#CD6600","#8B4500","#CD5B45","#8B3E2F","#CD4F39","#8B3626","#FF4500","#EE4000","#CD3700","#8B2500","#8B0000","#FF1493",
        "#EE1289","#CD1076","#8B0A50","#CD6090","#8B3A62","#CD919E","#8B636C","#CD8C95","#8B5F65","#CD6889","#8B475D","#FF34B3",
        "#EE30A7","#CD2990","#8B1C62","#FF3E96","#EE3A8C","#CD3278","#8B2252","#FF00FF","#EE00EE","#CD00CD","#8B008B","#CD69C9",
        "#8B4789","#8B668B","#E066FF","#D15FEE","#B452CD","#7A378B","#9A32CD","#7D26CD","#551A8B","#8968CD","#5D478B","#CDB5CD",
        "#8B7B8B"];

        
        $quantidade_cores = count($cores)-1;

        $contratos_itens = \App\Contrato_item::orderBy('quantidade')->where('quantidade', '>', 0)->get();
        $refeicoes = \App\Refeicao::orderBy('nome')->get();
        $estoques = \App\Estoque::orderBy('nome')->get();
        $nome_estoque = 'Nada';
        $nome_estoque_cent = 'Estoque Central';


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
                array_push($vall, (string)$cores[rand(0, $quantidade_cores)]);
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
            $aleatorio = rand(0, count($refeicoes)-1);
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
        if(count($estoques) > 1){
            $aleatorio = rand(0, count($estoques)-1);
            $estoque = $estoques[$aleatorio];
            $itens_estoque = \App\Estoque_item::orderBy('data_validade')->where('estoque_id', '=', $estoque->id)->get();
            $cont = 1;
            foreach($itens_estoque as $it){
                if($cont <= 6 and $it->quantidade > 0){
                    $vall = [];
                    $item = \App\Item::find($it->item_id);
                    array_push($vall, (string)($item->nome));
                    array_push($vall, (string)($item->gramatura." ".$item->unidade));
                    array_push($vall, (string)($it->quantidade));
                    array_push($vall, (string)(date('d/m/Y', strtotime($it->data_validade))));
                    array_push($data03, $vall);
                    $cont++;
                }
            }
            $nome_estoque = $estoque->nome;
        }else{
            $data03 = $data_nada_03;
        }

        /*Início da coleta de dados do gráfico 04*/
        if(count($estoques) >= 1){
            $estoque = \App\Estoque::find(1)->get()->first();
            $itens_estoque= \App\Estoque_item::orderBy('quantidade')->where('estoque_id', '=', $estoque->id)->paginate(50);
            $cont = 1;
            foreach($itens_estoque as $it){
                $vall = [];
                $item = \App\Item::find($it->item_id);
                array_push($vall, (string) $item->nome);
                array_push($vall, (int) $item->gramatura);
                array_push($vall, (string)$cores[rand(0, $quantidade_cores)]);
                array_push($data04, $vall);
                $cont++;

            }
            $nome_estoque_cent = $estoque->nome;
        }else{
            $data04 = $data_nada_03;
        }

        /*Início da coleta de dados do gráfico 04*/

        return view('home', ['data01' => $data01, 'data02' => $data02, 'data03' => $data03, 'data04' => $data04, 'nome_ref' => $nome_refeicao, 'nome_stq' => $nome_estoque, 'nome_stq_cent' => $nome_estoque_cent]);
    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    /* public function myTestAddToLog() {

        \LogActivity::addToLog('My Testing Add To Log.');
        dd('log insert successfully.');

    } */


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    /* public function logActivity() {

        $logs = \LogActivity::logActivityLists();
        return view('LogActivity',compact('logs'));

    } */
}
