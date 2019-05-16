@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Fornecedor') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/fornecedor/cadastrar') }}">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome ') }}</label>

                            <div class="col-md-6">
                              <input name="nome" id="nome" type="text" class="form-control" required value= {{ old('nome')}}> {{ $errors->first('nome')}}


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cnpj" class="col-md-4 col-form-label text-md-right">{{ __('CNPJ') }}</label>

                            <div class="col-md-6">
                              <input name="cnpj" id="cnpj" type="text" class="form-control" required value= {{ old('cnpj')}}> {{ $errors->first('cnpj')}}
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="n_contrato" class="col-md-4 col-form-label text-md-right">{{ __('Nº Contrato') }}</label>

                            <div class="col-md-6">
                              <input name="n_contrato" id="n_contrato" type="text" class="form-control" required value= {{ old('n_contrato')}}> {{ $errors->first('n_contrato')}}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="n_processo_licitatorio" class="col-md-4 col-form-label text-md-right">{{ __('Nº processo licitatório') }}</label>

                            <div class="col-md-6">
                              <input name="n_processo_licitatorio" id="n_processo_licitatorio" type="text" class="form-control" required value= {{ old('n_processo_licitatorio')}}> {{ $errors->first('n_processo_licitatorio')}}

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
