<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class InstituicaoController extends Controller
{
  public function cadastrar(Request $request) {

    $validator = Validator::make($request->all(), [
      'nome' =>                 ['required', 'string', 'max:255', 'unique:instituicaos,nome'],
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
        return redirect('instituicao/cadastrar')
                    ->withErrors($validator)
                    ->withInput();
    }

    $estoque = new \App\Estoque();
    $estoque->nome = "Estoque da Instituicao ".$request->nome;
    $estoque->save();

    Log::info('Cadastro_Estoque_Instituicao. User ['.$request->user()->id.
      ']. Method ['.$request->method().
      ']. Ip ['.$request->ip().
      ']. Agent ['.$request->header('user-agent').
      ']. Url ['.$request->path().']');

    $instituicao = new \App\Instituicao();
    $instituicao->nome = $request->nome;

    switch ($request->modalidade_ensino) {
  		case "1":
  			$instituicao->modalidade_ensino = "Creche Infantil Integral";
   			break;
  		case "2":
  			$instituicao->modalidade_ensino = "Creche Infantil Parcial";
   			break;
      case "3":
    		$instituicao->modalidade_ensino = "Infantil";
   			break;
      case "4":
      	$instituicao->modalidade_ensino = "Ensino Fundamental";
     		break;
      case "5":
        $instituicao->modalidade_ensino = "EJA";
       	break;
      case "6":
        $instituicao->modalidade_ensino = "Quilombola";
        break;
   	}

    $instituicao->rota = $request->rota;
    $instituicao->periodo_atendimento = $request->periodo_atendimento;
    $instituicao->qtde_alunos = $request->qtde_alunos;
    $instituicao->endereco = $request->endereco;

    $instituicao->gestor = $request->gestor;
    $instituicao->telefone = $request->telefone;
    $instituicao->estoque_id = $estoque->id;

    $instituicao->save();

    Log::info('Cadastro_Instituicao. User ['.$request->user()->id.
      ']. Method ['.$request->method().
      ']. Ip ['.$request->ip().
      ']. Agent ['.$request->header('user-agent').
      ']. Url ['.$request->path().']');

    session()->flash('success', 'Instituicao cadastrada com sucesso.');
    return redirect()->route('/instituicao/listar');
  }

  public function listar(){
    $instituicaos = \App\Instituicao::orderBy('id')->get();
    return view("ListarInstituicaos", ["instituicaos" => $instituicaos]);
  }

  public function gerarRelatorio(){
      $instituicaos = \App\Instituicao::all();
      //return view("ListarInstituicaos", ["instituicaos" => $instituicaos]);

      $data = date("d") . "-" . date("m") . "-" . date("y").'_' . date("H") . "-" . date("i") . "-" . date("s");      return  \PDF::loadView('RelatorioInstituicaos', compact('instituicaos'))
          ->setPaper('a4', 'landscape')// Se quiser que fique no formato a4 retrato: 
          ->stream('relatorio_Instituicaos_'.$data.'.pdf');
  }

  //fora de circulação
  public function remover(Request $request){
      $instituicao = \App\Instituicao::find($request->id);
      $estoque = \App\Estoque::find($request->id);

      if (isset($instituicao)) {
        $instituicao->delete();
        //LogActivity::addToLog('Remoção de Instituicao.');
        $estoque->delete();
        //LogActivity::addToLog('Remoção de Estoque.');
        session()->flash('success', 'Instituicao removida com sucesso.');
        return redirect()->route('/instituicao/listar');
      }

      session()->flash('success', 'Instituicao não existe.');
      return redirect()->route('/instituicao/listar');
  }

  public function editar(Request $request){
      $instituicao = \App\Instituicao::find($request->id);

      if (isset($instituicao)) {
        return view("EditarInstituicao", [
          "instituicao" => $instituicao,
        ]);
      }

      session()->flash('success', 'Instituicao não existe.');
      return redirect()->route('/instituicao/listar');
  }

  public function salvar(Request $request){
      $instituicao = \App\Instituicao::find($request->id);

            
      if (isset($instituicao)) {

        $validator = Validator::make($request->all(), [
          'nome' =>                 ['required', 'string', 'max:255', 'unique:instituicaos,nome,'.$instituicao->id],
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
            return redirect()->route('/instituicao/editar',[$instituicao->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $instituicao->nome = $request->nome;
        $instituicao->modalidade_ensino = $request->modalidade_ensino;

        switch ($request->modalidade_ensino) {
          case "1":
            $instituicao->modalidade_ensino = "Creche Infantil Integral";
            break;
          case "2":
            $instituicao->modalidade_ensino = "Creche Infantil Parcial";
            break;
          case "3":
            $instituicao->modalidade_ensino = "Infantil";
            break;
          case "4":
            $instituicao->modalidade_ensino = "Ensino Fundamental";
            break;
          case "5":
            $instituicao->modalidade_ensino = "EJA";
            break;
          case "6":
            $instituicao->modalidade_ensino = "Quilombola";
            break;
        }

        $instituicao->rota = $request->rota;
        $instituicao->periodo_atendimento = $request->periodo_atendimento;
        $instituicao->qtde_alunos = $request->qtde_alunos;
        $instituicao->endereco = $request->endereco;
        $instituicao->gestor = $request->gestor;
        $instituicao->telefone = $request->telefone;
        $instituicao->save();

        $estoque = \App\Estoque::find($instituicao->estoque_id);
        $estoque->nome = "Estoque da Instituicao ".$request->nome;
        $estoque->save();

        Log::info('Edicao_Instituicao. User ['.$request->user()->id.
          ']. Method ['.$request->method().
          ']. Ip ['.$request->ip().
          ']. Agent ['.$request->header('user-agent').
          ']. Url ['.$request->path().']');

        session()->flash('success', 'Instituicao modificada com sucesso.');
        return redirect()->route('/instituicao/listar');
      }

      session()->flash('success', 'Instituicao não existe.');
      return redirect()->route('/instituicao/listar');
  }
}
