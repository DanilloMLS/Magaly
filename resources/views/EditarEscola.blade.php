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
                            <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>

                            <div class="col-md-6">
                              <input name="bairro" id="bairro" type="text" class="form-control" value="{{ $escola->endereco->bairro}}" required value= {{ old('bairro')}}> {{ $errors->first('bairro')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rua" class="col-md-4 col-form-label text-md-right">{{ __('Rua') }}</label>

                            <div class="col-md-6">
                              <input name="rua" id="rua" type="text" class="form-control" value="{{ $escola->endereco->rua}}" required value= {{ old('rua')}}> {{ $errors->first('rua')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Número') }}</label>

                            <div class="col-md-6">
                              <input name="numero" id="numero" type="text" class="form-control" value="{{ $escola->endereco->numero}}" required value= {{ old('numero')}}> {{ $errors->first('numero')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cep" class="col-md-4 col-form-label text-md-right">{{ __('CEP') }}</label>

                            <div class="col-md-6">
                              <input name="cep" id="cep" type="text" class="form-control" value="{{ $escola->endereco->cep}}" required value= {{ old('cep')}}> {{ $errors->first('cep')}}
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="rota" class="col-md-4 col-form-label text-md-right">{{ __('Rota') }}</label>

                            <div class="col-md-6">
                              <input name="rota" id="rota" type="text" class="form-control" value="{{ $escola->rota}}" required value= {{ old('rota')}}> {{ $errors->first('rota')}}

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
