@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Pessoa') }}</div>

                <div class="card-body">
                    @if (\Session::has('success'))
                    <br>
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    @if (\Session::has('warning'))
                        <div class="alert alert-warning" role="alert">
                            {!! \Session::get('warning') !!}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('/pessoa/salvar') }}">
                      {{ csrf_field() }}
                        @csrf
                        <input type="hidden" name="usuario_id" value="{{ $pessoa->usuario_id}}" />
                        <input type="hidden" name="pessoa_id" value="{{ $pessoa->id}}" />
                        <input type="hidden" name="us_au" value="{{ Auth::user()->id }}" />
                        <?php $user = \App\user::where('id',$pessoa->usuario_id)->first()?>

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value= "{{ $pessoa->nome}}">
                              @if ($errors->has('nome'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        @if (Auth::user()->tipo_user == 'adm')
                            <div class="form-group row">
                                <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                                <div class="col-md-6">
                                    <input id="cnpj" type="cpf" placeholder="Somente dígitos" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{ $pessoa->cpf }}">
                                    @if ($errors->has('cpf'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cpf') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                            <div class="col-md-6">
                              <input name="telefone" id="telefone" type="text" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" placeholder="Somente dígitos, DDD sem zero" value= "{{ $pessoa->telefone}}">
                              @if ($errors->has('telefone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefone') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        @if (Auth::user()->tipo_user == 'adm')
                            <div class="form-group row">
                                <label for="sexo" class="col-md-4 col-form-label text-md-right">{{ __('Sexo') }}</label>

                                <div class="col-md-6">
                                <select class="form-control{{ $errors->has('sexo') ? ' is-invalid' : '' }}" id="sexo" name="sexo">
                                        <option value="">Selecione o sexo</option>

                                        <option value="M" @if(strcasecmp($pessoa->sexo, 'M') == 0) selected="selected" @endif>M</option>
                                        <option value="F" @if(strcasecmp($pessoa->sexo, 'F') == 0) selected="selected" @endif>F</option>
                                </select>
                                @if ($errors->has('sexo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sexo') }}</strong>
                                        </span>
                                @endif
                                </div>
                            </div>
                        @endif

                        @if (Auth::user()->tipo_user == 'adm')
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                <input name="email" id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value= "{{ $user->email}}">
                                @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="endereco" class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>

                            <div class="col-md-6">
                              <textarea name="endereco" id="endereco" type="text" class="form-control{{ $errors->has('endereco') ? ' is-invalid' : '' }}" >{{ $pessoa->endereco}}</textarea>
                              @if ($errors->has('endereco'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('endereco') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        @if (Auth::user()->tipo_user == 'adm')
                            <div class="form-group row">
                                <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Observações') }}</label>

                                <div class="col-md-6">
                                <textarea name="descricao" id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" >{{ $pessoa->descricao}}</textarea>
                                @if ($errors->has('descricao'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descricao') }}</strong>
                                        </span>
                                @endif
                                </div>
                            </div>
                        @endif

                        @if (Auth::user()->tipo_user == 'adm' and (Auth::user()->id != $pessoa->usuario_id))
                            <div class="form-group row">
                                <label for="tipo_user" class="col-md-4 col-form-label text-md-right">{{ __('Usuário') }}</label>
                                <div class="col-md-6">
                                <select class="form-control{{ $errors->has('tipo_user') ? ' is-invalid' : '' }}" id="tipo_user" name="tipo_user">
                                        <option value="">Selecione</option>

                                        <option value='adm' @if(strcasecmp($user->tipo_user, 'adm') == 0) selected="selected" @endif>Administrator</option>
                                        <option value='usr' @if(strcasecmp($user->tipo_user, 'usr') == 0) selected="selected" @endif>Comum</option>
                                </select>
                                @if ($errors->has('tipo_user'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tipo_user') }}</strong>
                                        </span>
                                @endif
                                </div>
                            </div>
                        @endif
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Atualizar
                              </button>
                              @if (Auth::user()->tipo_user == 'adm' and (Auth::user()->id != $pessoa->usuario_id))
                                <a class="btn btn-primary" href="{{route('/pessoa/block',['id' => $pessoa->usuario_id, 'user' => Auth::user()->id])}}">
                                    Bloquear
                                </a>
                                <a class="btn btn-primary" href="{{route('/pessoa/resetpassword',['id' => $pessoa->usuario_id])}}">
                                    Resetar Senha
                                </a>
                              @endif
                              @if (Auth::user()->id == $pessoa->usuario_id)
                                <a class="btn btn-primary" href="{{route('/pessoa/password',['id' => Auth::user()->id])}}">
                                    Alterar Senha
                                </a>
                              @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
