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
                              <input name="termo" termo="termo" type="text" class="form-control" placeholder="Buscar por fornecedor" required value= {{ old('termo')}}> {{ $errors->first('termo')}}

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
                              <input name="data_inicio" type="date" class="form-control" required value= {{ old('data_inicio')}}> {{ $errors->first('data_inicio')}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Data de Fim:') }}</label>

                            <div class="col-md-6">
                              <input name="data_fim" type="date" class="form-control" required value= {{ old('data_fim')}}> {{ $errors->first('data_fim')}}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  <img src="/img/search.png" height="21" width="19" align = "right">
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
