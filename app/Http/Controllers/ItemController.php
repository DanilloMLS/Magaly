<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function telaCadastrar() {
        $contratos = \App\Contrato::all();

        return view("CadastrarItem", [
            "contratos" => $contratos,
        ]);
    }

    public function cadastrar(Request $request) {
        $item = new \App\Item();
        $item->nome = $request->nome;
        $item->data_validade = $request->data_validade;
        $item->descricao = $request->descricao;
        $item->unidade = $request->unidade;
        $item->gramatura = $request->gramatura;
        $item->save();

        session()->flash('success', 'Item cadastrado com sucesso.');
        return redirect()->route('/item/listar');
    }

    public function listar() {
        $itens = \App\Item::All();
        return view("ListarItens", ["itens" => $itens]);
    }

    public function gerarRelatorio(){
        $itens = \App\Item::All();
        //return view("RelatorioItens", ["itens" => $itens]);

        return  \PDF::loadView('RelatorioItens', compact('itens'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('relatorio_Itens.pdf');
    }

    public function remover(Request $request) {
        $item = \App\Item::find($request->id);
        $item->delete();
        session()->flash('success', 'Item removido com sucesso');
        return redirect()->route('/item/listar');
    }

    public function editar(Request $request) {
        $item = \App\Item::find($request->id);
        return view("EditarItem", [
            "item" => $item,
        ]);
    }

    public function salvar(Request $request) {
        $item = \App\Item::find($request->id);
        $item->nome = $request->nome;
        $item->data_validade = $request->data_validade;
        $item->descricao = $request->descricao;
        $item->unidade = $request->unidade;
        $item->gramatura = $request->gramatura;
        $item->save();

        session()->flash('success', 'Item modificado com sucesso.');
        return redirect()->route('/item/listar');
    }
}
