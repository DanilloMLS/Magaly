<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FornecedorController extends Controller
{

  public function __construct () {
  }


  public function cadastrar(Request $request) {

    $validator = Validator::make($request->all(), [
      'cnpj' =>     ['required', 'max:18', 'unique:fornecedors,cnpj'],
      'email' =>    ['nullable', 'unique:fornecedors,email', 'email'],
      'telefone' => ['nullable', 'min:11','max:15'],
      'nome' =>     ['required', 'string', 'max:255', 'unique:fornecedors,nome'],
    ],[
      'cnpj.required' => 'O CNPJ é obrigatório',
      'cnpj.max' => 'Verifique se o CNPJ está no seguinte modelo: 00.000.000/0000-00',
      'cnpj.unique' => 'Esse CNPJ já está em uso',
      'email.unique' => 'Esse e-mail já está em uso',
      'email.email' => 'E-mail inválido',
      'telefone.digits_between' => 'Verifique se o telefone está no seguinte modelo: (00)90000-0000',
      'nome.required' => 'O nome é obrigatório',
      'nome.max' => 'O nome deve ter no máximo 255 caracteres',
      'nome.unique' => 'Esse nome já está em uso',
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

    Log::info('Cadastro_Fornecedor. User ['.$request->user()->id.
      ']. Method ['.$request->method().
      ']. Ip ['.$request->ip().
      ']. Agent ['.$request->header('user-agent').
      ']. Url ['.$request->path().']');

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
            ->setPaper('a4', 'landscape')// Se quiser que fique no formato a4 retrato: 
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
          'cnpj' =>     ['required', 'max:18', 'unique:fornecedors,cnpj,'.$fornecedor->id],
          'email' =>    ['nullable', 'unique:fornecedors,email,'.$fornecedor->id, 'email'],
          'telefone' => ['nullable', 'min:11','max:15'],
          'nome' =>     ['required', 'string', 'max:255', 'unique:fornecedors,nome,'.$fornecedor->id],
      ],[
        'cnpj.required' => 'O CNPJ é obrigatório',
        'cnpj.max' => 'Verifique se o CNPJ está no seguinte modelo: 00.000.000/0000-00',
        'cnpj.unique' => 'Esse CNPJ já está em uso',
        'email.unique' => 'Esse e-mail já está em uso',
        'email.email' => 'E-mail inválido',
        'telefone.digits_between' => 'O telefone deve ter entre 10 e 11 dígitos',
        'nome.required' => 'O nome é obrigatório',
        'nome.max' => 'O nome deve ter no máximo 255 caracteres',
        'nome.unique' => 'Esse nome já está em uso',
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
      Log::info('Edicao_Fornecedor. User ['.$request->user()->id.
      ']. Method ['.$request->method().
      ']. Ip ['.$request->ip().
      ']. Agent ['.$request->header('user-agent').
      ']. Url ['.$request->path().']');
			session()->flash('success', 'Fornecedor modificado com sucesso.');
 			return redirect()->route('/fornecedor/listar');
    }

    session()->flash('success', 'Fornecedor não existe.');
    return redirect()->route('/fornecedor/listar');
  }

  public function relatorioContratoItens(Request $request){
    $contratos = \App\Contrato::where('fornecedor_id', $request->id)->get();
    $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");

    return  \PDF::loadView('RelatorioFornecedoresItensContrato', compact('contratos'))
        ->setPaper('a4', 'landscape')// Se quiser que fique no formato a4 retrato: 
        ->stream('Lista de Contratos_'.$data.'.pdf');
  }

}
