@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Escola') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/escola/salvar') }}">
                      <input type="hidden" name="id" value="{{ $escola->id}}" />
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" value="{{ $escola->nome}}" required value= {{ old('nome')}}> {{ $errors->first('nome')}}


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade de ensino') }}</label>

                            <div class="col-md-6">
                              <input name="modalidade_ensino" id="modalidade_ensino" type="text" class="form-control" value="{{ $escola->modalidade_ensino}}" required value= {{ old('modalidade_ensino')}}> {{ $errors->first('modalidade_ensino')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="endereco" class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>

                            <div class="col-md-6">
                              <input name="endereco" id="endereco" type="text" class="form-control" value="{{ $escola->endereco}}" required value= {{ old('endereco')}}> {{ $errors->first('endereco')}}
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="rota" class="col-md-4 col-form-label text-md-right">{{ __('Rota') }}</label>

                            <div class="col-md-6">
                              <input name="rota" id="rota" type="text" class="form-control" value="{{ $escola->rota}}" required value= {{ old('rota')}}> {{ $errors->first('rota')}}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="periodo_atendimento" class="col-md-4 col-form-label text-md-right">{{ __('Período de atendimento') }}</label>

                            <div class="col-md-6">
                              <input name="periodo_atendimento" id="periodo_atendimento" type="text" class="form-control" value="{{ $escola->periodo_atendimento}}" required value= {{ old('periodo_atendimento')}}> {{ $errors->first('periodo_atendimento')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qtde_alunos" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade de alunos') }}</label>

                            <div class="col-md-6">
                              <input name="qtde_alunos" id="qtde_alunos" type="text" class="form-control" value="{{ $escola->qtde_alunos}}" required value= {{ old('qtde_alunos')}}> {{ $errors->first('qtde_alunos')}}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Salvar
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
