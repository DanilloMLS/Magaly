<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstoqueESController extends Controller
{
    public function insercaoItem(Request $request) {
        $estoque_es = new \App\EstoqueES();
        $estoque_es->quantidade_danificados = $request->quantidade_danificados;
        $estoque_es->quantidade = $request->quantidade;
        $estoque_es->operacao = "inserção";
        $estoque_es->item_id = $request->item_id;
        $estoque_es->estoque_id = $request->estoque_id;
        $estoque_es->save();
    
        session()->flash('success', 'Entrada feita com sucessso.');
        //return view("InserirNovoItemEstoque", ["estoque" => $estoque, "itens" => $itens]);  
    }

    public function entradaItem(Request $request) {
        $estoque_es = new \App\EstoqueES();
        $estoque_es->quantidade_danificados = $request->quantidade_danificados;
        $estoque_es->quantidade = $request->quantidade;
        $estoque_es->operacao = "entrada";
        $estoque_es->item_id = $request->item_id;
        $estoque_es->estoque_id = $request->estoque_id;
        $estoque_es->save();
    
        session()->flash('success', 'Entrada feita com sucessso.');
        //return view("InserirNovoItemEstoque", ["estoque" => $estoque, "itens" => $itens]);  
    }

    public function saidaItem(Request $request) {
        $estoque_es = new \App\EstoqueES();
        $estoque_es->quantidade_danificados = $request->quantidade_danificados;
        $estoque_es->quantidade = $request->quantidade;
        $estoque_es->operacao = "saida";
        $estoque_es->item_id = $request->item_id;
        $estoque_es->estoque_id = $request->estoque_id;
        $estoque_es->save();
    
        session()->flash('success', 'Entrada feita com sucessso.');
        //return view("InserirNovoItemEstoque", ["estoque" => $estoque, "itens" => $itens]);  
    }

    public function remocaoItem(Request $request) {
        $estoque_es = new \App\EstoqueES();
        $estoque_es->quantidade_danificados = $request->quantidade_danificados;
        $estoque_es->quantidade = $request->quantidade;
        $estoque_es->operacao = "removido";
        $estoque_es->item_id = $request->item_id;
        $estoque_es->estoque_id = $request->estoque_id;
        $estoque_es->save();
    
        session()->flash('success', 'Entrada feita com sucessso.');
        //return view("InserirNovoItemEstoque", ["estoque" => $estoque, "itens" => $itens]);  
    }

    
}
