<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PessoaController extends Controller{
    public function cadastrar(Request $request){
        $user = new \App\User();
        $pessoa = new \App\Pessoa();
        $request->validate($pessoa::$rules, $pessoa::$messages);
        

        $user->name = $request->nome;  
        $user->email = $request->email; 
        $user->password = password_hash("12345678", PASSWORD_DEFAULT);
        $user->tipo_user = 'usr';
        if($request->tipo_user == '1') $user->tipo_user = 'adm';
        $user->save();
        $pessoa->nome = $request->nome;
        $pessoa->cpf = $request->cpf;
        $pessoa->telefone = $request->telefone;
        $pessoa->endereco = $request->endereco;
        $pessoa->descricao = $request->descricao;
        $pessoa->sexo = $request->sexo;
        $pessoa->usuario_id = $user->id;
        $pessoa->save();

        session()->flash('success', 'Cadastro realizado com sucesso.');
        return redirect()->route('/pessoa/listar');
    }

    public function listar(){
        $pessoas = \App\Pessoa::All();
        return view("ListarPessoas", ["pessoas" => $pessoas]);
    }

    public function editar(Request $request){
        $pessoa = \App\Pessoa::find($request->id);
        if (isset($pessoa)) {
            return view("EditarPessoa", ["pessoa" => $pessoa]);
        }  
        session()->flash('warning', 'Pessoa não existe.');
        return redirect()->route('/pessoa/listar');
    }

    public function password_reset(Request $request){
            $user = \App\User::where('id', $request->id)->first();
            $user->password = password_hash("12345678", PASSWORD_DEFAULT);
            $user->save();
            session()->flash('success', 'Senha alterada com sucesso.');
            return redirect()->route('/pessoa/listar');
    }

    public function view_password_to_change(Request $request){
        return view("EditarPassword",['id' => $request->id]);
    }

    public function password_to_change(Request $request){
        $user = \App\User::where('id', $request->id)->first();
        $pessoa = \App\Pessoa::where('usuario_id',$request->id)->first(); 
        if(!Hash::check($request->new_password, Hash::make($request->confirm_new_password))){
            session()->flash('warning', 'Não foi possível alterar a senha do usuário. Nova senha não confere.');
        }else if(Hash::check($request->new_password, $user->password)){
            session()->flash('warning', 'Não foi possível alterar a senha do usuário. Digite uma nova senha.');
        }else if(!Hash::check($request->old_password, $user->password)){
            session()->flash('warning', 'Não foi possível alterar a senha do usuário. Senha atual não confere');
        }else{            
            $user->password = password_hash($request->new_password, PASSWORD_DEFAULT);
            $user->save();
            session()->flash('success', 'Senha alterada com sucesso.');
        }                 
        return redirect()->route('/pessoa/editar',['id' => $pessoa->id]);
    }

    public function password_block(Request $request){
        $user_auth = \App\User::where('id', $request->user)->first();
        if($user_auth->tipo_user == 'adm'){
            $sffledStr= str_shuffle('abscdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_-+');
            $uniqueString = md5(time().$sffledStr).md5(time().$sffledStr);
            $user = \App\User::where('id', $request->id)->first();
            $user->password = password_hash($uniqueString, PASSWORD_DEFAULT);
            $user->save();
            session()->flash('success', 'Usuário bloqueado com sucesso.');
            return redirect()->route('/pessoa/listar');
        }
        session()->flash('warning', 'Não foi possível bloquear o usuário.');
        return redirect()->route('/pessoa/listar');
    }

    public function salvar(Request $request)
    {   
        $user_auth = \App\User::where('id', $request->us_au)->first();
        if($user_auth->tipo_user == 'adm' or $request->us_au == $request->usuario_id){
            $user = \App\User::where('id', $request->usuario_id)->first();
            $pessoa = \App\Pessoa::where('id', $request->pessoa_id)->first();
            $rules = [
                'nome' => 'required|max:100|string',
                'cpf' => 'required', 'unique:pessoas,cpf'.$pessoa->cpf, '|max:11|min:11',
                'endereco' => 'nullable|max:255|string',
                'descricao' => 'nullable|max:255|string',
                'email' => 'required', 'unique:users,email'.$user->email,
                'tipo_user' => 'required',
                'sexo' => 'required|max:1|string'
            ];    
            $request->validate($rules, $pessoa::$messages);
            $user->name = $request->nome;  
            $user->email = $request->email; 
            if($request->tipo_user == '1') $user->tipo_user = 'adm';
            else if($request->tipo_user == '2') $user->tipo_user = 'usr';
            else if($request->tipo_user == '3') $user->tipo_user = 'ntr';
            else if($request->tipo_user == '4') $user->tipo_user = 'fsc';
            else if($request->tipo_user == '5') $user->tipo_user = 'fnc';
            else if($request->tipo_user == '6') $user->tipo_user = 'stq';
            $user->save();

    
            $pessoa->nome = $request->nome;
            $pessoa->cpf = $request->cpf;
            $pessoa->telefone = $request->telefone;
            $pessoa->endereco = $request->endereco;
            $pessoa->descricao = $request->descricao;
            $pessoa->sexo = $request->sexo;
            $pessoa->save();

            session()->flash('success', 'Alterações realizadas com sucesso.');
        }else{
            session()->flash('warning', 'Você não é um administrador.');
        }
        return redirect()->route('/pessoa/listar');
    }

    public function remover(){

    }
}
