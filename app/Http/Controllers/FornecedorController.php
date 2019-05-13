<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{

  public function __construct () {
  }

  public function cadastrar(Request $request) {
    $fornecedor = new \App\Fornecedor();
    $fornecedor->nome = $request->nome;
    $fornecedor->cnpj = $request->cnpj;
    $fornecedor->n_contrato = $request->n_contrato;
    $fornecedor->n_processo_licitatorio = $request->n_processo_licitatorio;
    $fornecedor->save();

    session()->flash('success', 'Fornecedor cadastrado com sucesso.');
    return redirect()->route('/fornecedor/listar');
  }

  public function listar(){
    $fornecedores = \App\Fornecedor::all();
    return view("ListarFornecedores", ["fornecedores" => $fornecedores]);
  }

  public function remover(Request $request){
			$fornecedor = \App\Fornecedor::find($request->id);
			$fornecedor->delete();
			session()->flash('success', 'Fornecedor removido com sucesso.');
			return redirect()->route('/fornecedor/listar');
		}

	public function editar(Request $request){
			$fornecedor = \App\Fornecedor::find($request->id);
			return view("EditarFornecedor", [
					"fornecedor" => $fornecedor,
			]);
	}

	public function salvar(Request $request){
			$fornecedor = \App\Fornecedor::find($request->id);
      $fornecedor->nome = $request->nome;
      $fornecedor->cnpj = $request->cnpj;
      $fornecedor->n_contrato = $request->n_contrato;
      $fornecedor->n_processo_licitatorio = $request->n_processo_licitatorio;
 			$fornecedor->save();
			session()->flash('success', 'Fornecedor modificado com sucesso.');
 			return redirect()->route('/fornecedor/listar');
		}

}
