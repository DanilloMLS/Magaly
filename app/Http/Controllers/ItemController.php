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
        $item->marca = $request->marca;
        $item->descricao = $request->descricao;
        $item->unidade = $request->unidade;
        $item->gramatura = $request->gramatura;
        $item->save();

        session()->flash('success', 'Item cadastrado com sucesso.');
        return redirect()->route('/item/listar');
    }

    public function listar() {
        $itens = \App\Item::orderBy('nome')->paginate(100);
        return view("ListarItens", ["itens" => $itens]);
    }

    public function gerarRelatorio(){
        $itens = \App\Item::All();
        $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");        //return view("RelatorioItens", ["itens" => $itens]);

        return  \PDF::loadView('RelatorioItens', compact('itens'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('relatorio_Itens_'.$data.'.pdf');
    }

    public function remover(Request $request) {
        $item = \App\Item::find($request->id);

        if (isset($item)) {
            $item->delete();
            session()->flash('success', 'Item removido com sucesso');
            return redirect()->route('/item/listar');
        }
        
        session()->flash('success', 'Item não existe.');
        return redirect()->route('/item/listar');
    }

    public function editar(Request $request) {
        $item = \App\Item::find($request->id);

        if (isset($item)) {
            return view("EditarItem", [
                "item" => $item,
            ]);
        }
        
        session()->flash('success', 'Item não existe.');
        return redirect()->route('/item/listar');
    }

    public function salvar(Request $request) {
        $item = \App\Item::find($request->id);

        if (isset($item)) {
            $item->nome = $request->nome;
            $item->marca = $request->marca;
            $item->n_lote = $request->n_lote;
            $item->descricao = $request->descricao;
            $item->unidade = $request->unidade;
            $item->gramatura = $request->gramatura;
            $item->save();

            session()->flash('success', 'Item modificado com sucesso.');
            return redirect()->route('/item/listar');
        }
        
        session()->flash('success', 'Item não existe.');
        return redirect()->route('/item/listar');
    }
}
