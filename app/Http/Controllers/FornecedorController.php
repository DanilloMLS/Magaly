<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FornecedorController extends Controller
{

  public function __construct () {
  }


  public function cadastrar(Request $request) {

    $validator = Validator::make($request->all(), [
            'cnpj' =>     ['required', 'digits:14', 'unique:fornecedors,cnpj'],
            'email' =>    ['nullable', 'unique:fornecedors,email', 'email'],
            'telefone' => ['nullable', 'digits_between:10,11'],
            'nome' =>     ['required', 'string', 'max:255', 'unique:fornecedors,nome'],
        ]);

        if ($validator->fails()) {
            return redirect('fornecedor/cadastrar')
                        ->withErrors($validator)
                        ->withInput();
        }

    $fornecedor = new \App\Fornecedor();
    $fornecedor->nome = $request->nome;
    $fornecedor->cnpj = $request->cnpj;
    $fornecedor->email = $request->email;
    $fornecedor->telefone = $request->telefone;
    $fornecedor->save();

    session()->flash('success', 'Fornecedor cadastrado com sucesso.');
    return redirect()->route('/fornecedor/listar');
  }

  public function listar(){
    $fornecedores = \App\Fornecedor::orderBy('nome')->get();
    return view("ListarFornecedores", ["fornecedores" => $fornecedores]);
  }

    public function gerarRelatorio(){
        $fornecedores = \App\Fornecedor::all();
        $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");        //return view("ListarFornecedores", ["fornecedores" => $fornecedores]);

        return  \PDF::loadView('RelatorioFornecedores', compact('fornecedores'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream('Lista de Fornecedor_'.$data.'.pdf');
    }

  public function remover(Request $request){
      $fornecedor = \App\Fornecedor::find($request->id);

      if (isset($fornecedor)) {
        $fornecedor->delete();
        session()->flash('success', 'Fornecedor removido com sucesso.');
        return redirect()->route('/fornecedor/listar');
      }

      session()->flash('success', 'Fornecedor não existe.');
      return redirect()->route('/fornecedor/listar');
		}

	public function editar(Request $request){
			$fornecedor = \App\Fornecedor::find($request->id);

      if (isset($fornecedor)) {
        return view("EditarFornecedor", [
					"fornecedor" => $fornecedor,
			  ]);
      }

      session()->flash('success', 'Fornecedor não existe.');
      return redirect()->route('/fornecedor/listar');
	}

	public function salvar(Request $request){
    $fornecedor = \App\Fornecedor::find($request->id);

    if (isset($fornecedor)) {
      $validator = Validator::make($request->all(), [
          'cnpj' =>     ['required', 'digits:14', 'unique:fornecedors,cnpj,'.$fornecedor->id],
          'email' =>    ['nullable', 'unique:fornecedors,email,'.$fornecedor->id, 'email'],
          'telefone' => ['nullable', 'digits_between:10,11'],
          'nome' =>     ['required', 'string', 'max:255', 'unique:fornecedors,nome,'.$fornecedor->id],
      ]);

      if ($validator->fails()) {
          return redirect()->route('/fornecedor/editar',[$fornecedor->id])
                      ->withErrors($validator)
                      ->withInput();
      }
      
      $fornecedor->nome = $request->nome;
      $fornecedor->cnpj = $request->cnpj;
      $fornecedor->email = $request->email;
      $fornecedor->telefone = $request->telefone;
 			$fornecedor->save();
			session()->flash('success', 'Fornecedor modificado com sucesso.');
 			return redirect()->route('/fornecedor/listar');
    }

    session()->flash('success', 'Fornecedor não existe.');
    return redirect()->route('/fornecedor/listar');
  }

}
