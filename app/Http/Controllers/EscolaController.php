<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EscolaController extends Controller
{
  public function cadastrar(Request $request) {

    $validator = Validator::make($request->all(), [
      'nome' =>                 ['required', 'string', 'max:255', 'unique:escolas,nome'],
      'modalidade_ensino' =>    ['required', 'between:1,6'],
      'rota' =>                 ['nullable', 'string', 'max:255'],
      'periodo_atendimento' =>  ['nullable', 'string', 'max:255'],
      'qtde_alunos' =>          ['required', 'integer', 'between:0,9999'],
      'endereco' =>             ['nullable', 'string', 'max:255'],
      'gestor' =>               ['nullable', 'string', 'max:255'],
      'telefone' =>             ['nullable', 'digits_between:10,11'],
    ],[
      'nome.required' => 'O nome é obrigatório',
      'nome.max' => 'O nome deve ter no máximo 255 caracteres',
      'nome.unique' => 'O nome já está em uso',
      'modalidade_ensino.required' => 'A modalidade de ensino é obrigatória',
      'modalidade_ensino.between' => 'Modalidade inválida',
      'rota.max' => 'A rota deve ter no máximo 255 caracteres',
      'periodo_atendimento.max' => 'O período de atendimento deve ter no máximo 255 caracteres',
      'qtde_alunos.required' => 'A quantidade de alunos é obrigatória',
      'qtde_alunos.integer' => 'A quantidade de alunos deve ser um número inteiro',
      'qtde_alunos.between' => 'A quantidade de alunos deve estar entre 0 e 9999',
      'endereco.max' => 'O endereço deve ter no máximo 255 caracteres',
      'gestor.max' => 'O nome do gestor deve ter no máximo 255 caracteres',
      'telefone.digits_between' => 'O telefone deve ter entre 10 e 11 dígitos',
    ]);

    if ($validator->fails()) {
        return redirect('escola/cadastrar')
                    ->withErrors($validator)
                    ->withInput();
    }

    $estoque = new \App\Estoque();
    $estoque->nome = "Estoque da Escola ".$request->nome;
    $estoque->save();

    Log::info('Cadastro_Estoque_Escola. User ['.$request->user()->id.
      ']. Method ['.$request->method().
      ']. Ip ['.$request->ip().
      ']. Agent ['.$request->header('user-agent').
      ']. Url ['.$request->path().']');

    $escola = new \App\Escola();
    $escola->nome = $request->nome;

    switch ($request->modalidade_ensino) {
  		case "1":
  			$escola->modalidade_ensino = "Creche Infantil Integral";
   			break;
  		case "2":
  			$escola->modalidade_ensino = "Creche Infantil Parcial";
   			break;
      case "3":
    		$escola->modalidade_ensino = "Infantil";
   			break;
      case "4":
      	$escola->modalidade_ensino = "Ensino Fundamental";
     		break;
      case "5":
        $escola->modalidade_ensino = "EJA";
       	break;
      case "6":
        $escola->modalidade_ensino = "Quilombola";
        break;
   	}

    $escola->rota = $request->rota;
    $escola->periodo_atendimento = $request->periodo_atendimento;
    $escola->qtde_alunos = $request->qtde_alunos;
    $escola->endereco = $request->endereco;

    $escola->gestor = $request->gestor;
    $escola->telefone = $request->telefone;
    $escola->estoque_id = $estoque->id;

    $escola->save();

    Log::info('Cadastro_Escola. User ['.$request->user()->id.
      ']. Method ['.$request->method().
      ']. Ip ['.$request->ip().
      ']. Agent ['.$request->header('user-agent').
      ']. Url ['.$request->path().']');

    session()->flash('success', 'Escola cadastrada com sucesso.');
    return redirect()->route('/escola/listar');
  }

  public function listar(){
    $escolas = \App\Escola::orderBy('id')->get();
    return view("ListarEscolas", ["escolas" => $escolas]);
  }

  public function gerarRelatorio(){
      $escolas = \App\Escola::all();
      //return view("ListarEscolas", ["escolas" => $escolas]);

      $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");      return  \PDF::loadView('RelatorioEscolas', compact('escolas'))
          ->setPaper('a4', 'landscape')// Se quiser que fique no formato a4 retrato: 
          ->stream('relatorio_Escolas_'.$data.'.pdf');
  }

  //fora de circulação
  public function remover(Request $request){
      $escola = \App\Escola::find($request->id);
      $estoque = \App\Estoque::find($request->id);

      if (isset($escola)) {
        $escola->delete();
        //LogActivity::addToLog('Remoção de Escola.');
        $estoque->delete();
        //LogActivity::addToLog('Remoção de Estoque.');
        session()->flash('success', 'Escola removida com sucesso.');
        return redirect()->route('/escola/listar');
      }

      session()->flash('success', 'Escola não existe.');
      return redirect()->route('/escola/listar');
  }

  public function editar(Request $request){
      $escola = \App\Escola::find($request->id);

      if (isset($escola)) {
        return view("EditarEscola", [
          "escola" => $escola,
        ]);
      }

      session()->flash('success', 'Escola não existe.');
      return redirect()->route('/escola/listar');
  }

  public function salvar(Request $request){
      $escola = \App\Escola::find($request->id);

            
      if (isset($escola)) {

        $validator = Validator::make($request->all(), [
          'nome' =>                 ['required', 'string', 'max:255', 'unique:escolas,nome,'.$escola->id],
          'modalidade_ensino' =>    ['required', 'between:1,6'],
          'rota' =>                 ['nullable', 'string', 'max:255'],
          'periodo_atendimento' =>  ['nullable', 'string:255'],
          'qtde_alunos' =>          ['required', 'integer', 'between:0,9999'],
          'endereco' =>             ['nullable', 'string', 'max:255'],
          'gestor' =>               ['nullable', 'string', 'max:255'],
          'telefone' =>             ['nullable', 'digits_between:10,11'],
        ],[
          'nome.required' => 'O nome é obrigatório',
          'nome.max' => 'O nome deve ter no máximo 255 caracteres',
          'nome.unique' => 'O nome já está em uso',
          'modalidade_ensino.required' => 'A modalidade de ensino é obrigatória',
          'modalidade_ensino.between' => 'Modalidade inválida',
          'rota.max' => 'A rota deve ter no máximo 255 caracteres',
          'periodo_atendimento.max' => 'O período de atendimento deve ter no máximo 255 caracteres',
          'qtde_alunos.required' => 'A quantidade de alunos é obrigatória',
          'qtde_alunos.integer' => 'A quantidade de alunos deve ser um número inteiro',
          'qtde_alunos.between' => 'A quantidade de alunos deve estar entre 0 e 9999',
          'endereco.max' => 'O endereço deve ter no máximo 255 caracteres',
          'gestor.max' => 'O nome do gestor deve ter no máximo 255 caracteres',
          'telefone.digits_between' => 'O telefone deve ter entre 10 e 11 dígitos',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('/escola/editar',[$escola->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $escola->nome = $request->nome;
        $escola->modalidade_ensino = $request->modalidade_ensino;

        switch ($request->modalidade_ensino) {
          case "1":
            $escola->modalidade_ensino = "Creche Infantil Integral";
            break;
          case "2":
            $escola->modalidade_ensino = "Creche Infantil Parcial";
            break;
          case "3":
            $escola->modalidade_ensino = "Infantil";
            break;
          case "4":
            $escola->modalidade_ensino = "Ensino Fundamental";
            break;
          case "5":
            $escola->modalidade_ensino = "EJA";
            break;
          case "6":
            $escola->modalidade_ensino = "Quilombola";
            break;
        }

        $escola->rota = $request->rota;
        $escola->periodo_atendimento = $request->periodo_atendimento;
        $escola->qtde_alunos = $request->qtde_alunos;
        $escola->endereco = $request->endereco;
        $escola->gestor = $request->gestor;
        $escola->telefone = $request->telefone;
        $escola->save();

        $estoque = \App\Estoque::find($escola->estoque_id);
        $estoque->nome = "Estoque da Escola ".$request->nome;
        $estoque->save();

        Log::info('Edicao_Escola. User ['.$request->user()->id.
          ']. Method ['.$request->method().
          ']. Ip ['.$request->ip().
          ']. Agent ['.$request->header('user-agent').
          ']. Url ['.$request->path().']');

        session()->flash('success', 'Escola modificada com sucesso.');
        return redirect()->route('/escola/listar');
      }

      session()->flash('success', 'Escola não existe.');
      return redirect()->route('/escola/listar');
  }
}
