@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Pessoa') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/pessoa/cadastrar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value= "{{ old('nome')}}">
                              @if ($errors->has('nome'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                            <div class="col-md-6">
                                <input id="cnpj" type="cpf" placeholder="Somente dígitos" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{ old('cpf') }}">
                                @if ($errors->has('cpf'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                            <div class="col-md-6">
                              <input name="telefone" id="telefone" type="text" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" placeholder="Somente dígitos, DDD sem zero" value= "{{ old('telefone')}}">
                              @if ($errors->has('telefone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefone') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sexo" class="col-md-4 col-form-label text-md-right">{{ __('Sexo') }}</label>

                              <div class="col-md-6">
                                <select class="form-control{{ $errors->has('sexo') ? ' is-invalid' : '' }}" id="sexo" name="sexo">
        								<option value="">Selecione o sexo</option>
        							    <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>M</option>
                                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>F</option>
                                </select>
                                @if ($errors->has('sexo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sexo') }}</strong>
                                    </span>
                                @endif
                              </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                              <input name="email" id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value= "{{ old('email')}}">
                              @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="endereco" class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>

                            <div class="col-md-6">
                              <textarea name="endereco" id="endereco" type="text" class="form-control{{ $errors->has('endereco') ? ' is-invalid' : '' }}" >{{ old('endereco')}}</textarea>
                              @if ($errors->has('endereco'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('endereco') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Observações') }}</label>

                            <div class="col-md-6">
                              <textarea name="descricao" id="descricao" type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" >{{ old('descricao')}}</textarea>
                              @if ($errors->has('descricao'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo_user" class="col-md-4 col-form-label text-md-right">{{ __('Usuário') }}</label>
                              <div class="col-md-6">
                                <select class="form-control{{ $errors->has('tipo_user') ? ' is-invalid' : '' }}" id="tipo_user" name="tipo_user">
        								<option value="">Selecione</option>
                                        <option value= '2'>Comum</option>
                                        <option value= '4'>Fiscal</option>
                                        <option value= '6'>Estoque</option>
                                        <option value= '3'>Nutrição</option>
                                        <option value= '5'>Financeiro</option>
        							    <option value= '1'>Administrador</option>
                                </select>
                                @if ($errors->has('tipo_user'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo_user') }}</strong>
                                    </span>
                                @endif
                              </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Cadastrar
                              </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
