@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  Buscar Contratos</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/contrato/buscarFornecedor') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row" >
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Nome do Fornecedor') }}</label>

                            <div class="col-md-6" >
                              <input name="termo" termo="termo" type="text" class="form-control{{ $errors->has('termo') ? ' is-invalid' : '' }}" placeholder="Buscar por fornecedor" value= "{{ old('termo')}}">
                              @if ($errors->has('termo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('termo') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0" >
                            <div class="col-md-6 offset-md-4" >
                              <button type="submit" class="btn btn-primary">
                                  <img src="/img/search.png" height="21" width="19" align = "right">
                              </button>
                            </div>
                        </div>
                    </form>
                    <br>

                    <form method="POST" action="{{ route('/contrato/buscarData') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Data de Início:') }}</label>

                            <div class="col-md-6">
                              <input name="data_inicio" type="date" class="form-control{{ $errors->has('data_inicio') ? ' is-invalid' : '' }}" value= "{{ old('data_inicio')}}">
                              @if ($errors->has('data_inicio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('data_inicio') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Data de Fim:') }}</label>

                            <div class="col-md-6">
                              <input name="data_fim" type="date" class="form-control{{ $errors->has('data_fim') ? ' is-invalid' : '' }}" value= "{{ old('data_fim')}}">
                              @if ($errors->has('data_fim'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('data_fim') }}</strong>
                                    </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  <img src="/img/search.png" height="21" width="19" align = "right">
                              </button>
                            </div>
                            <a class="btn-cancelar btn btn-primary" href="{{route ('/contrato/listar')}}">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
