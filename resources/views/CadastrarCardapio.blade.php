@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Cardápio') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/cardapio/salvar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade de ensino') }}</label>
                            <div class="col-md-6">
                              <select class="form-control{{ $errors->has('modalidade_ensino') ? ' is-invalid' : '' }}" id="modalidade_ensino" name="modalidade_ensino">
                                    <option value="">Selecione uma Modalidade de ensino</option>
                                    <option value="1" {{ old('modalidade_ensino') == 1 ? 'selected' : '' }}>Creche Infantil Integral</option>
                                    <option value="2" {{ old('modalidade_ensino') == 2 ? 'selected' : '' }}>Creche Infantil Parcial</option>
                                    <option value="3" {{ old('modalidade_ensino') == 3 ? 'selected' : '' }}>Infantil (pré-instituicao)</option>
                                    <option value="4" {{ old('modalidade_ensino') == 4 ? 'selected' : '' }}>Ensino Fundamental</option>
                                    <option value="5" {{ old('modalidade_ensino') == 5 ? 'selected' : '' }}>EJA</option>
                                    <option value="6" {{ old('modalidade_ensino') == 6 ? 'selected' : '' }}>Quilombola</option>
                              </select>
                              @if ($errors->has('modalidade_ensino'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('modalidade_ensino') }}</strong>
                                    </span>
                              @endif
                            </div>
                         </div>

                         <div class="form-group row">
                             <label for="data_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Data de início') }}</label>
                             <div class="col-md-2">
                               <input type="date" id="data_inicio" class="form-control{{ $errors->has('data_inicio') ? ' is-invalid' : '' }}"  name="data_inicio" value="{{ old('data_inicio') }}">
                               @if ($errors->has('data_inicio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('data_inicio') }}</strong>
                                    </span>
                               @endif
                             </div>
                          </div>

                          <div class="form-group row">
                              <label for="data_fim" class="col-md-4 col-form-label text-md-right">{{ __('Data de fim') }}</label>
                              <div class="col-md-2">
                                <input type="date" id="data_fim" class="form-control{{ $errors->has('data_fim') ? ' is-invalid' : '' }}"  name="data_fim" value="{{ old('data_fim') }}">
                                @if ($errors->has('data_fim'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('data_fim') }}</strong>
                                    </span>
                                @endif
                              </div>
                           </div>

                           <div class="form-group row">
                               <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
                               <div class="col-md-6">
                                 <input id="nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') }}">
                                 @if ($errors->has('nome'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                 @endif
                               </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                              <button type="submit" class="btn btn-primary">
                                  Inserir Refeições
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
