<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaidaItemAvulsoController extends Controller
{
    public function telaCadastrar(Request $request)
    {
        $contrato = \App\Contrato::find($request->contrato_id);

        if (isset($contrato)) {
            return view("CadastrarSaidaAvulsa", ["contrato" => $contrato]);
        }
    }

    public function cadastrar(Request $request)
    {
        $contrato = \App\Contrato::find($request->contrato_id);

        if (isset($contrato)) {
            $saida_avulsa = new \App\SaidaAvulsa();
            $saida_avulsa->observacao = $request->observacao;
            $saida_avulsa->contrato_id = $contrato->id;
            $saida_avulsa->origem_id = $request->origem_id;
            $saida_avulsa->destino_id = $request->destino_id;
            $saida_avulsa->save();
        }


    }

    
}
