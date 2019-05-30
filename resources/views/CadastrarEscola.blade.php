@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Escola') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/escola/cadastrar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" required value= {{ old('nome')}}> {{ $errors->first('nome')}}


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade de ensino') }}</label>

                            <div class="col-md-6">
                              <input name="modalidade_ensino" id="modalidade_ensino" type="text" class="form-control" required value= {{ old('modalidade_ensino')}}> {{ $errors->first('modalidade_ensino')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>

                            <div class="col-md-6">
                              <input name="bairro" id="bairro" type="text" class="form-control" required value= {{ old('bairro')}}> {{ $errors->first('bairro')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rua" class="col-md-4 col-form-label text-md-right">{{ __('Rua') }}</label>

                            <div class="col-md-6">
                              <input name="rua" id="rua" type="text" class="form-control" required value= {{ old('rua')}}> {{ $errors->first('rua')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Número') }}</label>

                            <div class="col-md-6">
                              <input name="numero" id="numero" type="text" class="form-control" required value= {{ old('numero')}}> {{ $errors->first('numero')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cep" class="col-md-4 col-form-label text-md-right">{{ __('CEP') }}</label>

                            <div class="col-md-6">
                              <input name="cep" id="cep" type="text" class="form-control" required value= {{ old('cep')}}> {{ $errors->first('cep')}}
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="rota" class="col-md-4 col-form-label text-md-right">{{ __('Rota') }}</label>

                            <div class="col-md-6">
                              <textarea name="rota" id="rota" type="text" class="form-control" required value= {{ old('rota')}}> {{ $errors->first('rota')}}</textarea>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="periodo_atendimento" class="col-md-4 col-form-label text-md-right">{{ __('Período de atendimento') }}</label>

                            <div class="col-md-6">
                              <input name="periodo_atendimento" id="periodo_atendimento" type="text" class="form-control" required value= {{ old('periodo_atendimento')}}> {{ $errors->first('periodo_atendimento')}}</input>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qtde_alunos" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade de alunos') }}</label>

                            <div class="col-md-6">
                              <input name="qtde_alunos" id="qtde_alunos" type="text" class="form-control" required value= {{ old('qtde_alunos')}}> {{ $errors->first('qtde_alunos')}}</input>

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
