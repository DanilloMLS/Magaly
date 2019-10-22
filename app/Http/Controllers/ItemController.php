<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $itens = \App\Item::orderBy('nome')->get();
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

            $validator = Validator::make($request->all(), [
                'nome' =>       ['required', 'string', 'max:255'],
                'marca' =>      ['required', 'string', 'max:255'],
                'descricao' =>  ['nullable', 'string', 'max:1500'],
                'unidade' =>    ['required', 'string', 'max:2'],
                'gramatura' =>  ['required', 'integer', 'between:0,5000000'],
            ]);
      
            if ($validator->fails()) {
                return redirect()->route('/item/editar',[$item->id])
                            ->withErrors($validator)
                            ->withInput();
            }

            $item->nome = $request->nome;
            $item->marca = $request->marca;
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
