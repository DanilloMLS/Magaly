<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

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
        $item->nome = $request->nome;
        $item->data_validade = $request->data_validade;
        $item->descricao = $request->descricao;
        $item->unidade = $request->unidade;
        $item->gramatura = $request->gramatura;
        $item->save();


        if (isset($item)) {
            $item->nome = $request->nome;
            $item->marca = $request->marca;

            $dateObj= DateTime::createFromFormat('Y-m-d', $request->data_validade);
            $item->data_validade = $dateObj->format('d/m/Y');

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
