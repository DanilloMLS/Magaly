<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller{
    public function telaCadastrar() {
        $contratos = \App\Contrato::all();

        return view("CadastrarItem", [
            "contratos" => $contratos,
        ]);
    }

    //fora de circulação
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
                'descricao' =>  ['nullable', 'string', 'max:255'],
                'unidade' =>    ['required', 'string', 'max:2'],
                'gramatura' =>  ['required', 'integer', 'between:0,5000000'],
            ],[
                'nome.required' => 'O nome é obrigatório',
                'nome.max' => 'O nome deve ter no máximo 255 caracteres',
                'marca.required' => 'A marca é obrigatória',
                'marca.max' => 'A marca deve ter no máximo 255 caracteres',
                'descricao.max' => 'A descriçao deve ter no máximo 255 caracteres',
                'unidade.required' => 'A unidade é obrigatória',
                'unidade.max' => 'Unidade inválida',
                'gramatura.required' => 'A gramatura é obrigatória',
                'gramatura.integer' => 'A gramatura deve ser um número inteiro',
                'gramatura.between' => 'A gramatura deve estar entre 0 e 5000000',
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
            
            Log::info('Edicao_Item. User ['.$request->user()->id.
                ']. Method ['.$request->method().
                ']. Ip ['.$request->ip().
                ']. Agent ['.$request->header('user-agent').
                ']. Url ['.$request->path().']');
            
            session()->flash('success', 'Item modificado com sucesso.');
            return redirect()->route('/item/listar');
        }
        
        session()->flash('success', 'Item não existe.');
        return redirect()->route('/item/listar');
    }
}
